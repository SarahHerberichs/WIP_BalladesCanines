<?php

namespace Models;
//  `city_id` int NOT NULL AUTO_INCREMENT,
//  `name` varchar(255) NOT NULL,
//  `latitude` decimal(9,6) DEFAULT NULL,
//  `longitude` decimal(9,6) DEFAULT NULL,
//  `department_id` int DEFAULT NULL,
//  `zip_code` varchar(10) DEFAULT NULL,

class City {
     
    private int $_id;
    private string $_name;
    private float $_latitude;
    private float $_longitude;
    private int $_zipCode;
    private int $_departmentNumber;

    public function setId($id):void {
        $this-> _id = $id;
    }
    public function setName($name):void {
        $this-> _name = $name;
    }
    public function setDepartmentId($departmentNumber) {
        $this-> _departmentNumber = $departmentNumber;
    }
    public function setZipCode($zipCode) {
        $this-> _zipCode = $zipCode;
    }

}