<?php

namespace Repositories;
use PDO;

class LocationRepository {
    private PDO $_connexion;

    public function __construct() {
      $this ->_connexion = DataBase::getConnexion();
    }

    public function insertLocations () {
        $json_data = file_get_contents('cities.json');
        $cities_array = json_decode($json_data,true);

        foreach ($cities_array['cities'] as $city) {

          $region_name = $city['region_name'];
          $department_name = $city['department_name'];
          $department_number = $city['department_number'];
          $city_name = $city['city_code'];
          $zip_code = $city['zip_code'];
          $latitude = isset($city['latitude']) && !empty($city['latitude']) ? floatval($city['latitude']) : null;
          $longitude = isset($city['longitude']) && !empty($city['longitude']) ? floatval($city['longitude']) : null;
          
          // Vérifie si la région existe déjà
          $stmt = $this->_connexion->prepare('
              SELECT region_id FROM regions WHERE name = :name
          ');
          $stmt->bindValue('name', $region_name);
          $stmt->execute();
          $region = $stmt->fetch(PDO::FETCH_ASSOC);
          //Si region existe, recupere l'id, Sinon, l'insérer dans table
          if ($region) {
              // La région existe, obtenir l'ID
              $region_id = $region['region_id'];
          } else {
              // La région n'existe pas, l'insérer et obtenir l'ID
              $stmt = $this->_connexion->prepare('
                  INSERT INTO regions (name)
                  VALUES (:name)
              ');
              $stmt->bindValue('name', $region_name);
              $stmt->execute();
              
              // Récupère l'ID de la nouvelle région insérée
              $region_id = $this->_connexion->lastInsertId();
          }
      
          // Vérifie si le département existe déjà
          $stmt = $this->_connexion->prepare('
              SELECT department_number FROM departments WHERE department_number = :department_number
          ');

          $stmt->bindValue('department_number', $department_number);
          $stmt->execute();
          $department = $stmt->fetch(PDO::FETCH_ASSOC);
          //Si department existe pas, le créer
          if (!$department) {
              // Le département n'existe pas, l'insérer
              $stmt = $this->_connexion->prepare('
                  INSERT INTO departments (name, region_id, department_number)
                  VALUES (:name, :region_id, :department_number)
              ');
              $stmt->bindValue('name', $department_name);
              $stmt->bindValue('region_id', $region_id);
              $stmt->bindValue('department_number', $department_number);
              $stmt->execute();
          } // Le département existe déjà, ne rien faire
          
          //Inserer les villes dans table
          $stmt = $this->_connexion->prepare('
          INSERT INTO cities (name,department_number,zip_code, longitude, latitude)
          VALUES (:name, :department_number, :zip_code, :longitude, :latitude)
          ');
          $stmt->bindValue('name', $city_name);
          $stmt->bindValue('department_number', $department_number);
          $stmt->bindValue('zip_code', $zip_code);
          $stmt->bindValue('latitude', $latitude);
          $stmt->bindValue('longitude',  $longitude );
          $stmt->execute();
      }

    }
  
}
