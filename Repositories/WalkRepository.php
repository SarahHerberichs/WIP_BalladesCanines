<?php

namespace Repositories;

use PDO;
use Models\Walk; 
use Models\Region; 
use Models\WalkConversation;

class WalkRepository {
    private PDO $_connexion;

    public function __construct() {
        $this ->_connexion = DataBase::getConnexion();
    }
 
    public function getCityId( $name,$zipcode) {

        $stmt= $this->_connexion->prepare('
        SELECT city_id from cities where zip_code = :zipcode AND name = :name');
        $stmt->bindValue('zipcode', $zipcode);
        $stmt->bindValue('name', $name);
        $stmt->execute() ;
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['city_id'] ?? null;
    }
    
    
    public function insertWalk(Walk $walk, $cityId) : Walk {
        $stmt = $this->_connexion->prepare('
            INSERT INTO walks (walk_id, title, date, time, text, city_id, user_id, created_at)
            VALUES (UUID(), :title, :date, :time, :text, :city_id, :user_id, NOW())
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


    
       
    
    public function consultWalksByRegionId($region_id): array {
        $stmt = $this->_connexion->prepare('
                  SELECT 
            w.walk_id,
            w.title,
            w.created_at,
            w.user_id AS walkUserId,
            w.text AS walkText,
            w.date AS walkDate,
            w.time,
            c.latitude,
            wc.walk_conversation_id,
            c.longitude,
            c.city_id,
            c.name AS cityName,
            r.region_id,
            r.name AS regionName,
            wc.conversation_id,
            wc.text AS convText,
            wc.date AS convDate,
            u1.name AS convUser,
            u2.name AS walkUserName
        FROM 
            walks w
        INNER JOIN 
            cities c ON w.city_id = c.city_id
        INNER JOIN 
            departments d ON d.department_number = c.department_number
        INNER JOIN 
            regions r ON r.region_id = d.region_id
        LEFT JOIN 
            walk_conversations wc ON wc.walk_id = w.walk_id
        LEFT JOIN 
            users u1 ON u1.user_id = wc.user_id
        INNER JOIN 
            users u2 ON u2.user_id = w.user_id

            where r.region_id = :regionId
            ORDER BY w.date 
        ');
        $stmt->bindValue('regionId', $region_id);
        $stmt->execute();
        $walkList = [];
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $walkId = $row['walk_id'];

        if (!isset($walkList[$walkId])) {
            $walk = new Walk();
            $walk->setWalkId($row['walk_id']);
            $walk->setTitle($row['title']);
            $walk->setText($row['walkText']);
            $walk->setDate($row['walkDate']);
            $walk->setTime($row['time']);
            $walk->setCityId($row['city_id']);
            $walk->setLatitude($row['latitude']);
            $walk->setLongitude($row['longitude']);
            $walk->setRegionId($row['region_id']);
            $walk->setCityName($row['cityName']);
            $walk->setUserName($row['walkUserName']);
            $walk->setCreatedAt($row['created_at']);
            $walk->setConversation([]);
            $walkList[$walkId] = $walk;
        }
   
        if ($row['walk_conversation_id']) {
            $conversation = new WalkConversation();
            $conversation->setConversationId($row['walk_conversation_id']);
            $conversation->setText($row['convText']);
            $conversation->setDate($row['convDate']);            
            $conversation->setUserName($row['convUser']);
            $walkList[$walkId]->addConversation($conversation);
        }
    }
 
    return array_values($walkList);
}
public function consultWalks(): array {
    $stmt = $this->_connexion->prepare('
        SELECT 
            w.walk_id,
            w.title,
            w.created_at,
            w.user_id AS walkUserId,
            w.text AS walkText,
            w.date AS walkDate,
            w.time,
            c.latitude,
            wc.walk_conversation_id,
            c.longitude,
            c.city_id,
            c.name AS cityName,
            r.region_id,
            r.name AS regionName,
            wc.conversation_id,
            wc.text AS convText,
            wc.date AS convDate,
            u1.name AS convUser,
            u2.name AS walkUserName
        FROM 
            walks w
        INNER JOIN 
            cities c ON w.city_id = c.city_id
        INNER JOIN 
            departments d ON d.department_number = c.department_number
        INNER JOIN 
            regions r ON r.region_id = d.region_id
        LEFT JOIN 
            walk_conversations wc ON wc.walk_id = w.walk_id
        LEFT JOIN 
            users u1 ON u1.user_id = wc.user_id
        INNER JOIN 
            users u2 ON u2.user_id = w.user_id
        ORDER BY 
            w.date;
    ');
    $stmt->execute();
    $walkList = [];
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $walkId = $row['walk_id'];

        if (!isset($walkList[$walkId])) {
            $walk = new Walk();
            $walk->setWalkId($row['walk_id']);
            $walk->setCreatedAt($row['created_at']);
            $walk->setTitle($row['title']);
            $walk->setText($row['walkText']);
            $walk->setDate($row['walkDate']);
            $walk->setTime($row['time']);
            $walk->setCityId($row['city_id']);
            $walk->setLatitude($row['latitude']);
            $walk->setLongitude($row['longitude']);
            $walk->setRegionId($row['region_id']);
            $walk->setCityName($row['cityName']);
            $walk->setUserName($row['walkUserName']);
            $walk->setConversation([]);
            $walkList[$walkId] = $walk;
        }
   
        if ($row['walk_conversation_id']) {
            $conversation = new WalkConversation();
            $conversation->setConversationId($row['walk_conversation_id']);
            $conversation->setText($row['convText']);
            $conversation->setDate($row['convDate']);            
            $conversation->setUserName($row['convUser']);
            $walkList[$walkId]->addConversation($conversation);
        }
    }
        return array_values($walkList);
}

 
}
?>
