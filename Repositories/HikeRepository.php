<?php

namespace Repositories;

use PDO;
use Models\Hike;



class HikeRepository {
    private PDO $_connexion;

    public function __construct() {
        $this->_connexion = DataBase::getConnexion();
    }
    public function insertHike(Hike $hike, $cityId) : Hike {
        $stmt = $this->_connexion->prepare('
            INSERT INTO hikes (
            hike_id,
            user_id,
            city_id,
            title,
            text ,
            elevation_gain ,
            distance,
            encountered_difficulties ,
            water_point,
            hike_date,
            level,
            created_at,
            updated_at
            )
            VALUES (
            UUID(),
            :userId,
            :cityId,
            :title,
            :text ,
            :elevation_gain ,
            :distance,
            :encountered_difficulties ,
            :water_point,
            :hike_date,
            :level,
            NOW(),
            NOW()
            )
        ');
        $stmt->bindValue('userId',$_SESSION['User']['id']);
        $stmt->bindValue('cityId',$cityId);
        $stmt->bindValue('title', ($hike->getTitle()));
        $stmt->bindValue('text', $hike->getText());
        $stmt->bindValue('elevation_gain', $hike->getElevationGain());
        $stmt->bindValue('distance',$hike->getDistance());
        $stmt->bindValue('encountered_difficulties', $hike->getEncounteredDifficulties());
        $stmt->bindValue('water_point',$hike->getWaterPoint());
        $stmt->bindValue('hike_date', $hike->getHikeDate()->format('Y-m-d H:i:s'));
        $stmt->bindValue('level', $hike->getLevel());
  
        $stmt->execute();
var_dump($hike);
        return $hike;
    }


    public function consultHikesByRegionId($region_id): array {
        $stmt = $this->_connexion->prepare('
            SELECT 
            h.hike_id,
            h.title,
            h.created_at,
            h.text AS hikeText,
            h.elevation_gain,
            h.level,
            h.distance,
            h.encountered_difficulties,
            h.water_point,
            h.hike_date AS hikeDate,
            c.name AS cityName,
            u.name AS hikeUserName,
            c.city_id,
            c.latitude,
            c.longitude,
            c.longitude,
            c.latitude,
            h.user_id AS hikeUserId,
            r.region_id,
            r.name AS regionName
            
        FROM 
           hikes h
        INNER JOIN 
            cities c ON h.city_id = c.city_id
        INNER JOIN 
            departments d ON d.department_number = c.department_number
        INNER JOIN 
            regions r ON r.region_id = d.region_id
        INNER JOIN 
            users u ON u.user_id = h.user_id
            where r.region_id = :regionId
            ORDER BY h.hike_date 
        ');
        $stmt->bindValue('regionId', $region_id);
        $stmt->execute();
        $hikeList = [];
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $hikeId = $row['hike_id'];

        if (!isset($hikeList[$hikeId])) {
            $hike = new Hike();
            $hike->setHikeId($row['hike_id']);
            $hike->setTitle($row['title']);
            $hike->setCreatedAt($row['created_at']);
            $hike->setText($row['hikeText']);
            $hike->setElevationGain($row['elevation_gain']);
            $hike->setLevel($row['level']);
            $hike->setDistance($row['distance']);
            $hike->setEncounteredDifficulties($row['encountered_difficulties']);
            $hike->setWaterPoint($row['water_point']);
            $hike->setHikeDate($row['hikeDate']);
            $hike->setCityName($row['cityName']);
            $hike->setUserName($row['hikeUserName']);
            $hike->setCityId($row['city_id']);
            $hike->setLatitude($row['latitude']);
            $hike->setLongitude($row['longitude']);
            $hike->setRegionId($row['region_id']);
            $hikeList[$hikeId] = $hike;
     
            $hikeList[$hikeId] = $hike;
        }
    }
 
    return array_values($hikeList);
}
public function consulthikes(): array {
    $stmt = $this->_connexion->prepare('
        SELECT 
           
            h.hike_id,
            h.title,
            h.created_at,
            h.text AS hikeText,
            h.elevation_gain,
            h.level,
            h.distance,
            h.encountered_difficulties,
            h.water_point,
            h.hike_date AS hikeDate,
            c.name AS cityName,
            u.name AS hikeUserName,
            c.city_id,
            c.latitude,
            c.longitude,
            c.longitude,
            c.latitude,
            h.user_id AS hikeUserId,
            r.region_id
        FROM 
           hikes h
        INNER JOIN 
            cities c ON h.city_id = c.city_id
        INNER JOIN 
            departments d ON d.department_number = c.department_number
        INNER JOIN 
            regions r ON r.region_id = d.region_id
        INNER JOIN 
            users u ON u.user_id = h.user_id
            ORDER BY h.hike_date 
    ');
    $stmt->execute();
    $hikeList = [];
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $hikeId = $row['hike_id'];

        if (!isset($hikeList[$hikeId])) {
            $hike = new Hike();
            $hike->setHikeId($row['hike_id']);
            $hike->setTitle($row['title']);
            $hike->setCreatedAt($row['created_at']);
            $hike->setText($row['hikeText']);
            $hike->setElevationGain($row['elevation_gain']);
            $hike->setLevel($row['level']);
            $hike->setDistance($row['distance']);
            $hike->setEncounteredDifficulties($row['encountered_difficulties']);
            $hike->setWaterPoint($row['water_point']);
            $hike->setHikeDate($row['hikeDate']);
            $hike->setCityName($row['cityName']);
            $hike->setUserName($row['hikeUserName']);
            $hike->setCityId($row['city_id']);
            $hike->setLatitude($row['latitude']);
            $hike->setLongitude($row['longitude']);
            $hike->setRegionId($row['region_id']);
            $hikeList[$hikeId] = $hike;
        }
   
    }
        return array_values($hikeList);
}

}


