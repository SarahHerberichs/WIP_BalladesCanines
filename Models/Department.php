<?php
namespace Models;

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

    public function getName() : string {
        return $this->_name;
    }

    public function getRegionId() : int {
      return $this-> _regionId;
    }
    public function getDepartmentNumber() : int {
        return $this-> _departmenNumber;
    }

}