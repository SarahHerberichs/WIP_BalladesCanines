<?php 
namespace Models;

use DateTime;
use Exception;

class Walk {
    private string $_walkId;
    private string $_title;
    private string $_text;
    private int $_cityid;
    private string $_cityName;
    private int $_userId;
    private string $_userName;
    private int $_regionId;
    private array $_conversation;
    private DateTime $_time; // Changement en string
    private DateTime $_date;
    private DateTime $_created_at;

    private float $latitude;
    private float $longitude;

    public function setCreatedAt($created_at): void {
        if (is_string($created_at)) {
            try {
                $this->_created_at = new DateTime($created_at);
            } catch (Exception $e) {
                echo "Erreur de conversion de la date de création : " . $e->getMessage();
            }
        } elseif ($created_at instanceof DateTime) {
            $this->_created_at = $created_at;
        } else {
            echo "Format de date de création invalide";
        }
    }
    public function setTime($time): void {
        if (is_string($time)) {
            try {
                $this->_time = new DateTime($time);
            } catch (Exception $e) {
                echo "Erreur de conversion de la date de création : " . $e->getMessage();
            }
        } elseif ($time instanceof DateTime) {
            $this->_time = $time;
        } else {
            echo "Format de date de création invalide";
        }
    }


    public function setConversation($conversation): void {
        $this->_conversation = $conversation;
    }

    public function setWalkId($walkId): void {
        $this->_walkId = $walkId;
    }

    public function setLatitude(float $latitude): void {
        $this->latitude = $latitude;
    }

    public function setLongitude(float $longitude): void {
        $this->longitude = $longitude;
    }

    public function setTitle($title): void {
        $this->_title = $title;
    }

    public function setText($text): void {
        $this->_text = $text;
    }

    public function setCityId($cityid): void {
        $this->_cityid = $cityid;
    }

    public function setCityName($cityName): void {
        $this->_cityName = $cityName;
    }

    public function setDate($date): void {
        try {
            $this->_date = new DateTime($date);
        } catch (Exception $e) {
            echo "Erreur de conversion de la date : " . $e->getMessage();
        }
    }

    public function setUserId($_userId): void {
        $this->_userId = $_userId;
    }

    public function setUserName($userName): void {
        $this->_userName = $userName;
    }

    public function setRegionId($_regionId): void {
        $this->_regionId = $_regionId;
    }

    public function getCreatedAt(): DateTime {
        return $this->_created_at;
    }

    public function getTime(): string {
        return $this->_time->format('H:i:s');
    }

    public function getConversation(): array {
        return $this->_conversation;
    }

    public function getWalkId(): string {
        return $this->_walkId;
    }

    public function getLatitude(): float {
        return $this->latitude;
    }

    public function getLongitude(): float {
        return $this->longitude;
    }

    public function getTitle(): string {
        return $this->_title;
    }

    public function getText(): string {
        return $this->_text;
    }

    public function getCityId(): int {
        return $this->_cityid;
    }

    public function getCityName(): string {
        return $this->_cityName;
    }

    public function getDate(): DateTime {
        return $this->_date;
    }

    public function getUserId(): int {
        return $this->_userId;
    }

    public function getUserName(): string {
        return $this->_userName;
    }

    public function getRegionId(): int {
        return $this->_regionId;
    }

    public function addConversation(WalkConversation $conversation): void {
        $this->_conversation[] = $conversation;
    }
}
?>