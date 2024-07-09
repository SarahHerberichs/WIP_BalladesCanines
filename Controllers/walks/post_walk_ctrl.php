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
    $walk->setText(($_POST['text']));
    $walk->setTitle(($_POST['title']));
    $walk->setTime($_POST['time']);
    $cityId = $walkRepo->getCityId(($_POST['cityName']), $_POST['zipcode']);
    $walkRepo->insertWalk($walk, $cityId);
    var_dump($walk);
    $queryString = $_SERVER['QUERY_STRING'];
    // Analyse de la QUERY_STRING pour extraire les paramètres existants
    parse_str($queryString, $params);

// Ajout ou modification du paramètre 'message_sent' à 1 dans les paramètres
$params['walk_sent'] = 1;

// Re-construction de l'URL avec les paramètres mis à jour
$url = '/?' . http_build_query($params);

    // Génération du script JavaScript pour la redirection
    echo "<script type='text/javascript'>window.location.href = '$url';</script>";
    }
} else { 
    $message = "Veuillez vous connecter";
};
require 'Vues/walks/post_walk.phtml';
?>