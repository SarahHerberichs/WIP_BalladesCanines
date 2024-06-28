<?php
// CREATE TABLE IF NOT EXISTS `regions` (
//     `region_id` int NOT NULL AUTO_INCREMENT,
//     `name` varchar(255) NOT NULL,
//     PRIMARY KEY (`region_id`)
//   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
  

class Region {
    private int $_id;
    private string $_name;

    public function setId($id):void {
        $this-> _id = $id;
    }
    public function setName($name):void {
        $this-> _name = $name;
    }
    public function getId() : string {
        return $this->_id;
    } 
    public function getName() : string {
        return $this->_name;
    }
}