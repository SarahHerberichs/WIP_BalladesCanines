<?php
// CREATE TABLE IF NOT EXISTS `departments` (
//     `department_id` int NOT NULL AUTO_INCREMENT,
//     `name` varchar(255) NOT NULL,
//     `region_id` int DEFAULT NULL,
//     `department_number` varchar(10) DEFAULT NULL,
//     PRIMARY KEY (`department_id`),
//     KEY `region_id` (`region_id`),
//     CONSTRAINT `departments_ibfk_1` FOREIGN KEY (`region_id`) REFERENCES `regions` (`region_id`)
//   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

class Department {
    private string $_name;
    private int $_regionId;
    private int $_departmenNumber;

   
    public function setName($name):void {
        $this-> _name = $name;
    }
    public function setDepartmentNumber($departmentNumber):void{
        $this-> _departmenNumber = $departmentNumber;
    }
    public function setRegionId($regionId):void {
        $this-> _regionId = $regionId;
    }

}