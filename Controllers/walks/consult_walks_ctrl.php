<?php
namespace Controllers\walks\consultWalks;

use Exception;
use Repositories\WalkRepository;


if (isset($_POST['msg-conversation'])){
    var_dump($_POST);
    //Ajouter un convRepository , Creer un Model Conversation, dans convRepository créer un postMsgConv , au submit msg-conversation apeller cette method
    //Pour l'affichage  : creer une method dans WalkRepository qui récupere les "conversations" dont la walk_id est celle qu'on passera en param
    //Injection dans consult_walk du resultat OU Setter/Getter d'un tableau d'objets Walk->getCOnv??
}

$walkRepo = new WalkRepository();
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


require 'Vues/walks/consult_walks.phtml';
?>
