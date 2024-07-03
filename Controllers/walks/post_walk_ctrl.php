<?php

namespace Controllers\walks\postWalks;

use Repositories\WalkRepository;
use Models\Walk;

$walkRepo = new WalkRepository ;
$message = "";
if (isset($_SESSION['User']) && !empty($_SESSION['User'])) {
    if (isset ($_POST['post_walk'])){
    
    $walk = new Walk();
    $walk->setDate($_POST['date']);
    $walk->setText(htmlentities($_POST['text']));
    $walk->setTitle(htmlentities($_POST['title']));
        $cityId = $walkRepo->getCityId(htmlentities($_POST['search']));
        $walkRepo->insertWalk($walk, $cityId);
        $message= 'Annonce postée avec succès';

    }
} else { 
    $message = "Veuillez vous connecter";
};
require 'Vues/walks/post_walk.phtml';
?>