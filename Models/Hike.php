<?php 

namespace Models;

use DateTime;

class Hike {
    private string $_hikeId;
    private int $_elevationGain;
    private float $_distance;
    private string $_encounteredDifficulties;
    private string $_userId;
    private bool $water_point;
    private DateTime $_hikeDate;
    private DateTime $_createdAt;
    private DateTime $_updatedAt;

 

    public function getHikeId(): string {
        return $this->_hikeId;
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

    public function hasWaterPoint(): bool {
        return $this->water_point;
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

    public function setHikeId(string $hikeId): void {
        $this->_hikeId = $hikeId;
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

    public function setWaterPoint(bool $water_point): void {
        $this->water_point = $water_point;
    }

    public function setHikeDate(DateTime $hikeDate): void {
        $this->_hikeDate = $hikeDate;
    }

    public function setCreatedAt(DateTime $createdAt): void {
        $this->_createdAt = $createdAt;
    }

    public function setUpdatedAt(DateTime $updatedAt): void {
        $this->_updatedAt = $updatedAt;
    }
}
