<?php

namespace Models;

class Region {
    private int $_id;
    private string $_name;

    public function setId($id):void {
        $this-> _id = $id;
    }
    public function setName($name):void {
        $this-> _name = $name;
    }
    public function getId() : int {
        return $this->_id;
    } 
    public function getName() : string {
        return $this->_name;
    }
}