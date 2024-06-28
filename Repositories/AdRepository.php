<?php

class AdRepository {
    private PDO $_connexion;

    public function __construct() {
        $this ->_connexion = DataBase::getConnexion();
    }
 
    public function getCityId($name) {
        $stmt= $this->_connexion->prepare('
        SELECT city_id from cities where name= :name');
        $stmt->bindValue('name', $name);
        $stmt->execute() ;
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['city_id'] ?? null;
    }
    
    
    public function insertAd(Ad $ad, $cityId) : Ad {
        $stmt = $this->_connexion->prepare('
            INSERT INTO ads (ad_id,title,date,text, city_id, user_id)
            VALUES (UUID(), :title, :date, :text, :city_id , :user_id)
        ');
       
        $stmt->bindValue('date', $ad->getDate()->format('Y-m-d H:i:s'));
        $stmt->bindValue('title', $ad->getTitle());
        $stmt->bindValue('text', $ad->getText());
        $stmt->bindValue('city_id', $cityId);
        $stmt->bindValue('user_id',$_SESSION['User']['id']);

        $stmt->execute();
        return $ad;
    }
    //City id OK
    //joindre departement la ou city.department_number === department.department_number
    //joindre region la ou department.region_id = region.region_id
    public function consultAd(): array {
        $stmt = $this->_connexion->prepare('
            SELECT a.*, c.latitude, c.longitude, r.region_id, r.name 
            FROM ads a
            INNER JOIN cities c ON a.city_id = c.city_id
            INNER JOIN departments d ON d.department_number = c.department_number
            INNER JOIN regions r ON r.region_id = d.region_id
            ORDER BY a.date 
        ');
    
        $stmt->execute();
        $adList = [];
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $ad = new Ad();
            $ad->setId($row['ad_id']);
            $ad->setTitle($row['title']);
            $ad->setText($row['text']);
            $ad->setDate($row['date']);
            $ad->setCityId($row['city_id']);
            $ad->setLatitude($row['latitude']);
            $ad->setLongitude($row['longitude']);
            $ad-> setRegionId($row['region_id']);
            array_push($adList, $ad);
        }
    
        return $adList;
    }
    public function getRegions(): array {
        $stmt = $this-> _connexion->prepare ('
        SELECT * from regions
        ');
        $stmt->execute();
        $regions = [];

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $region = new Region();
            $region->setId($row['region_id']);
            $region->setName($row['name']);
            array_push($regions,$region);
        }
        return $regions;
    }
}
?>