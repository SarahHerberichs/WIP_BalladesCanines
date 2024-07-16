<?php

namespace Controllers;

use Exception;
// use Models\HikeConversation;
use Repositories\HikeRepository;
// use Repositories\WalkConversationRepository;
use Repositories\LocationRepository;

$hikeRepo = new HikeRepository();
$locationRepo = new LocationRepository();

//Pour affichage de toutes les régions qui seront clickable pour filtrer walks par région(injection url js)
$regions = $locationRepo->getRegions();
$regions_id = [];
//Tableau de tous les Id region
foreach ($regions as $region) {
    $regionIds[] = $region->getId();
}
//Si region dans l'url récup les walks associées , sinon injecter toutes les walk
if (isset($_GET['region'])) {
    $regionId = htmlspecialchars($_GET['region']); 
    if (!in_array($regionId, $regionIds)) {
        throw new Exception('Region invalide.');
    }
    $hikeList = $hikeRepo->consultHikesByRegionId($regionId);
   
} else {
    $hikeList = $hikeRepo->consultHikes();
}



require 'Vues/hikes/consult_hikes.phtml';

?>
