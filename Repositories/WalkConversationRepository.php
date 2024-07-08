<?php

namespace Repositories;
use PDO;
use Models\WalkConversation;

class WalkConversationRepository{

    private PDO $_connexion;

    public function __construct(){
        $this->_connexion = DataBase::getConnexion();
    }

    public function insertMessage(WalkConversation $conversation ,$walkId): WalkConversation{
        $stmt = $this->_connexion->prepare ('
        INSERT INTO walk_conversations 
         ( walk_conversation_id, walk_id, user_id ,text, date)
         VALUES 
         (UUID(), :walkId, :userId , :text, :date)
        ');
        $stmt->bindValue('walkId',$walkId);
        $stmt->bindValue('userId',$_SESSION['User']['id']);
        $stmt->bindValue('text',$conversation->getText());
        $stmt->bindValue('date', $conversation->getDate()->format('Y-m-d H:i:s'));

        $stmt->execute();
        return $conversation;
    }
}