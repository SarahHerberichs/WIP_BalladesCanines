<?php

namespace Controllers;

use PDO;
use Models\Walks;
use Models\Hikes;
use Repositories\DataBase;

class AdsRepository {
private PDO $_connexion;

public function __construct() {
    $this ->_connexion = DataBase::getConnexion();
}

// public function getAdsByUser($userId) {
//     $stmt = $this->_connexion.prepare('
    
//     ')
// }
}