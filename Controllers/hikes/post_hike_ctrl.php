<?php

use Repositories\WalkRepository;
use Models\Hike;
use Repositories\HikeRepository;

$hikeRepo = new HikeRepository;
$walkRepo = new WalkRepository;

if (isset($_SESSION['User']) && !empty($_SESSION['User'])) {
    
    if (isset ($_POST['post_hike'])){
        var_dump($_POST);
    $hike = new Hike();
    $hike->setTitle($_POST['title']);
    $hike->setText($_POST['text']);
    $hike->setElevationGain($_POST['elevation_gain']);
    $hike->setDistance($_POST['hike_distance']);
    $hike->setEncounteredDifficulties($_POST['hike_difficulties']);
    $hike->setWaterPoint($_POST['water_point']);
    $hike->setHikeDate($_POST['hike_date']);
    $hike->setLevel($_POST["hike_level"]);
    $cityId = $walkRepo->getCityId(($_POST['cityName']), $_POST['zipcode']);
    var_dump($hike);
    $hikeRepo->insertHike($hike,$cityId);

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
}
require 'Vues/hikes/post_hike.phtml';