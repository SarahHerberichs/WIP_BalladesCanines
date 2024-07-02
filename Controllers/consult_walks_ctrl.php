<?php


$walkRepo = new WalkRepository;
//Pour affichage de toutes les régions qui seront clickable pour filtrer walks par région(injection url js)
$regions = $walkRepo->getRegions();
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
    $walkList = $walkRepo->consultWalksById($regionId);
} else {
    $walkList = $walkRepo->consultWalks();
}


require 'Vues/consult_walks.phtml';
?>
