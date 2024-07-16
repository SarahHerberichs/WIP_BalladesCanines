<?php 

namespace Models;

use DateTime;
use Exception;
class Hike {
    private string $_hikeId;
    private int $_cityid;
    private int $_regionId;
    private string $_userId;
    private string $_title;
    private string $_text;
    private string $_cityName;
    private int $_elevationGain;
    private float $_distance;
    private string $_encounteredDifficulties;
    private string $_userName;
    private bool $_waterPoint;
    private DateTime $_hikeDate;
    private DateTime $_createdAt;
    private DateTime $_updatedAt;
    private float $latitude;
    private float $longitude;
    private int $_level;
 
    public function setHikeId(string $hikeId): void {
        $this->_hikeId = $hikeId;
    }
    public function setTitle(string $title) : void {
        $this->_title = $title;
    }
    public function setText(string $text) : void {
        $this->_text= $text;
    }
    public function setCityId($cityid): void {
        $this->_cityid = $cityid;
    }
    public function setRegionId($_regionId): void {
        $this->_regionId = $_regionId;
    }


    public function setCityName($cityName): void {
        $this->_cityName = $cityName;
    }
    public function setLatitude(float $latitude): void {
        $this->latitude = $latitude;
    }

    public function setLongitude(float $longitude): void {
        $this->longitude = $longitude;
    }
    public function setElevationGain(int $elevationGain): void {
        $this->_elevationGain = $elevationGain;
    }

    public function setDistance(float $distance): void {
        $this->_distance = $distance;
    }

    public function setEncounteredDifficulties(string $encounteredDifficulties): void {
        $this->_encounteredDifficulties = $encounteredDifficulties;
    }

    public function setUserId(string $userId): void {
        $this->_userId = $userId;
    }
    public function setUserName($userName): void {
        $this->_userName = $userName;
    }

    public function setWaterPoint(bool $waterPoint): void {
        $this->_waterPoint = $waterPoint;
    }

    public function setHikeDate( $hikeDate): void {
        try {
            $this->_hikeDate = new DateTime($hikeDate);
        } catch (Exception $e) {
            echo "Erreur de conversion de la date : " . $e->getMessage();
        }
    }

    public function setCreatedAt( $createdAt): void {
        try {
            $this->_createdAt= new DateTime($createdAt);
        } catch (Exception $e) {
            echo "Erreur de conversion de la date : " . $e->getMessage();
        }
    }

    public function setUpdatedAt( $updatedAt): void {
        try {
            $this->_updatedAt= new DateTime($updatedAt);
        } catch (Exception $e) {
            echo "Erreur de conversion de la date : " . $e->getMessage();
        }
    }
    public function setLevel($level) :void{
        $this->_level = $level;
    }
    public function getHikeId(): string {
        return $this->_hikeId;
    }
 
    public function getTitle() : string {
        return $this->_title;
    }
    public function getText() : string {
        return $this->_text;
    }
    public function getCityId(): int {
        return $this->_cityid;
    }
    public function getRegionId(): int {
        return $this->_regionId;
    }
    public function getCityName(): string {
        return ucfirst(strtolower($this->_cityName));
    }
    public function getLatitude(): float {
        return $this->latitude;
    }

    public function getLongitude(): float {
        return $this->longitude;
    }
    public function getElevationGain(): int {
        return $this->_elevationGain;
    }

    public function getDistance(): float {
        return $this->_distance;
    }

    public function getEncounteredDifficulties(): string {
        return $this->_encounteredDifficulties;
    }

    public function getUserId(): string {
        return $this->_userId;
    }
    public function getUserName(): string {
        return $this->_userName;
    }

    public function getWaterPoint(): bool {
        return $this->_waterPoint;
    }

    public function getHikeDate(): DateTime {
        return $this->_hikeDate;
    }

    public function getCreatedAt(): DateTime {
        return $this->_createdAt;
    }

    public function getUpdatedAt(): DateTime {
        return $this->_updatedAt;
    }

    public function getLevel(): int {
        return $this->_level;
    }
}
