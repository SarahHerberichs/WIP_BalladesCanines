<?php
namespace Repositories;

use PDO;
use Models\Walk; // Assurez-vous d'importer la classe Walk si elle est dans Models
use Models\Region; // Assurez-vous d'importer la classe Region si elle est dans Models


class WalkRepository {
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
    
    
    public function insertWalk(Walk $walk, $cityId) : Walk {
        $stmt = $this->_connexion->prepare('
            INSERT INTO walks (walk_id,title,date,text, city_id, user_id)
            VALUES (UUID(), :title, :date, :text, :city_id , :user_id)
        ');
       
        $stmt->bindValue('date', $walk->getDate()->format('Y-m-d H:i:s'));
        $stmt->bindValue('title', $walk->getTitle());
        $stmt->bindValue('text', $walk->getText());
        $stmt->bindValue('city_id', $cityId);
        $stmt->bindValue('user_id',$_SESSION['User']['id']);

        $stmt->execute();
        return $walk;
    }

    public function consultWalks(): array {
        $stmt = $this->_connexion->prepare('
            SELECT w.*, c.latitude, c.longitude, c.name as cityName, r.region_id, r.name  as regionName
            FROM walks w
            INNER JOIN cities c ON w.city_id = c.city_id
            INNER JOIN departments d ON d.department_number = c.department_number
            INNER JOIN regions r ON r.region_id = d.region_id
            ORDER BY w.date 
        ');
     

        $stmt->execute();
        $walkList = [];
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $walk = new Walk();
            $walk->setWalkId($row['walk_id']);
            $walk->setTitle($row['title']);
            $walk->setText($row['text']);
            $walk->setDate($row['date']);
            $walk->setCityId($row['city_id']);
            $walk->setLatitude($row['latitude']);
            $walk->setLongitude($row['longitude']);
            $walk-> setRegionId($row['region_id']);
            $walk-> setCityName($row['cityName']);
            array_push($walkList, $walk);
        }
    
        return $walkList;
    }
    public function consultWalksById($region_id): array {
        $stmt = $this->_connexion->prepare('
            SELECT w.*, c.latitude, c.longitude, c.name as cityName, r.region_id, r.name as regionName
            FROM walks w
            INNER JOIN cities c ON w.city_id = c.city_id
            INNER JOIN departments d ON d.department_number = c.department_number
            INNER JOIN regions r ON r.region_id = d.region_id
            where r.region_id = :regionId
            ORDER BY w.date 
        ');
        $stmt->bindValue('regionId', $region_id);
        $stmt->execute();
        $walkList = [];
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $walk = new Walk();
            $walk->setWalkId($row['walk_id']);
            $walk->setTitle($row['title']);
            $walk->setText($row['text']);
            $walk->setDate($row['date']);
            $walk->setCityId($row['city_id']);
            $walk->setLatitude($row['latitude']);
            $walk->setLongitude($row['longitude']);
            $walk->setCityName($row['cityName']);
            $walk-> setRegionId($region_id);
            array_push($walkList, $walk);
        }
    
        return $walkList;
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