<?php

class Ad {
    private string $_id;
    private string $_title;
    private string $_text;
    private int $_cityid;
    private int $_userId;
    private int $_regionId;
    private DateTime $_date;

    public function setId($id):void {
        $this-> _id = $id;
    }
    private float $latitude;
    private float $longitude;

    public function setLatitude(float $latitude): void {
        $this->latitude = $latitude;
    }

    public function setLongitude(float $longitude): void {
        $this->longitude = $longitude;
    }

    public function setTitle($title):void {
        $this-> _title = $title;
    }
    public function setText($text):void {
        $this-> _text = $text;
    }
    public function setCityId($cityid):void {
        $this-> _cityid = $cityid;
    }
    public function setDate(string $date): void
    {
        try {
            // Tenter de créer un objet DateTime à partir de la chaîne
            $this->_date = new DateTime($date);
        } catch (Exception $e) {
            // Gérer l'exception si la conversion échoue
            // Vous pouvez enregistrer l'erreur, utiliser une date par défaut ou lancer une nouvelle exception
            echo "Erreur de conversion de la date : " . $e->getMessage();
            // $this->_date = new DateTime('1970-01-01'); // Utiliser une date par défaut
        }
    }
    public function setUserId($_userId):void {
        $this-> _userId = $_userId;
    }
    public function setRegionId($_regionId):void {
        $this-> _regionId = $_regionId;
    } 
    // Getters (et setters si nécessaire)
    public function getId(): string {
        return $this->_id;
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

    public function getDate(): DateTime {
        return $this->_date;
    }

    public function getUserId(): int {
        return $this->_userId;
    }
    public function getRegionId() : int {
        return $this->_regionId;
    }
}