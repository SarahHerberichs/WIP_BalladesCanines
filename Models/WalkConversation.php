<?php

namespace Models;

use DateTime;
use Exception;

class WalkConversation {
    private string $_conversationId;
    private string $_userId;
    private string $_userName;
    private string $_walkId;
    private string $_text;
    private DateTime $_date;

    public function __construct() {
        // Initialiser la propriété _date avec la date actuelle
        $this->_date = new DateTime();
    }

    public function setConversationId($conversationId): void {
        $this->_conversationId = $conversationId;
    }

    public function getConversationId(): string {
        return $this->_conversationId;
    }

    public function setUserId($userId): void {
        $this->_userId = $userId;
    }

    public function getUserId(): string {
        return $this->_userId;
    }
    public function setUserName($userName): void {
        $this->_userName = $userName;
    }
    public function getUserName(): string {
       return $this->_userName;
    }
    public function setWalkId($walkId): void {
        $this->_walkId = $walkId;
    }

    public function getWalkId(): string {
        return $this->_walkId;
    }

    public function setText($text): void {
        $this->_text = $text;
    }

    public function getText(): string {
        return $this->_text;
    }

    public function setDate(string $date): void {
        try {
            // Tenter de créer un objet DateTime à partir de la chaîne
            $this->_date = new DateTime($date);
        } catch (Exception $e) {
            // Gérer l'exception si la conversion échoue
            echo "Erreur de conversion de la date : " . $e->getMessage();
        }
    }

    public function getDate(): DateTime {
        return $this->_date;
    }
}
