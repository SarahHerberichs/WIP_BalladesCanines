<?php
namespace Controllers\walks;


use Models\WalkConversation;
use Repositories\WalkConversationRepository;

$convRepo = new WalkConversationRepository();


if (isset($_POST['msg_conversation'])){

    $conversation = new WalkConversation();

    $conversation->setWalkId($_POST['walk_id']);
    $conversation->setText($_POST['message']);
    $convRepo->insertMessage($conversation,$_POST['walk_id']);

    $queryString = $_SERVER['QUERY_STRING'];

 // Analyse de la QUERY_STRING pour extraire les paramètres existants
parse_str($queryString, $params);

// Ajout ou modification du paramètre 'message_sent' à 1 dans les paramètres
$params['message_sent'] = 1;

// Re-construction de l'URL avec les paramètres mis à jour
$url = '/?' . http_build_query($params);

    
    // Génération du script JavaScript pour la redirection
    echo "<script type='text/javascript'>window.location.href = '$url';</script>";
    

}

require 'Vues/walks/walk_post_message.phtml';
?>