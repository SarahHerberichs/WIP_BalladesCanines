<?php

namespace Models;

use DateTime;

class User {
    private string $_id;
    private string $_name;
    private string $_password;
    private string $_phone;
    private string $_cityId;
    private string $_role;
    private string $_email;
    private DateTime $_signUpDate;

    public function setId(string $id): void {
        $this->_id = $id;
    }

    public function getId(): string {
        return $this->_id;
    }

    public function setName(string $name): void {
        $this->_name = $name;
    }

    public function getName(): string {
        return $this->_name;
    }
    public function setEmail(string $email) {
        $this->_email = $email;
     }
     public function getEmail() : string {
        return $this->_email;
     }

    public function setPassword(string $password): void {
        $this->_password = $password;
    }

    public function getPassword(): string {
        return $this->_password;
    }

    public function setPhone(string $phone): void {
        $this->_phone = $phone;
    }

    public function getPhone(): string {
        return $this->_phone;
    }

    public function setCityId(string $cityId): void {
        $this->_cityId = $cityId;
    }

    public function getCityId(): string {
        return $this->_cityId;
    }

    public function setRole(string $role): void {
        $this->_role = $role;
    }

    public function getRole(): string {
        return $this->_role;
    }

    public function setSignUpDate(DateTime $signUpDate): void {
        $this->_signUpDate = $signUpDate;
    }

    public function getSignUpDate(): DateTime {
        return $this->_signUpDate;
    }
}
