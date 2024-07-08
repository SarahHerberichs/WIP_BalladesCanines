<?php
namespace Controllers\walks\consultWalks;

use Exception;
use Models\WalkConversation;
use Repositories\WalkRepository;
use Repositories\WalkConversationRepository;

$walkRepo = new WalkRepository();
$convRepo = new WalkConversationRepository();

if (isset($_POST['msg_conversation'])){
  

    $conversation = new WalkConversation();

    $conversation->setWalkId($_POST['walk_id']);
    $conversation->setText($_POST['message']);
    $convRepo->insertMessage($conversation,$_POST['walk_id']);
    //recup walkId et text
}


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
    $walkList = $walkRepo->consultWalksByRegionId($regionId);
   
} else {
    $walkList = $walkRepo->consultWalks();
}



require 'Vues/walks/consult_walks.phtml';

?>
