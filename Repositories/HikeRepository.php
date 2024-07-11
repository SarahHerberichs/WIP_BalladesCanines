<?php

namespace Repositories;

use PDO;
use Models\Hike;
use Models\Region;

class HikeRepository {
    private PDO $_connexion;

    public function __construct() {
        $this->_connexion = DataBase::getConnexion();
    }
    public function insertWalk(Hike $walk, $cityId) : Hike {
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
            NOW(),
            NOW())
        ');
    
        $stmt->bindValue('date', $walk->getDate()->format('Y-m-d H:i:s'));
        $stmt->bindValue('title', ($walk->getTitle()));
        $stmt->bindValue('text', $walk->getText());
        $stmt->bindValue('time', ($walk->getTime()));
        $stmt->bindValue('city_id', $cityId);
        $stmt->bindValue('user_id', $_SESSION['User']['id']);
        $stmt->execute();

        return $walk;
    }
}


