<?php
namespace Controllers;



use Models\WalkConversation;
use Repositories\WalkConversationRepository;

$convRepo = new WalkConversationRepository();


if (isset($_POST['msg_conversation'])){

    $conversation = new WalkConversation();

    $conversation->setWalkId($_POST['walk_id']);
    $conversation->setText($_POST['message']);
    $convRepo->insertMessage($conversation,$_POST['walk_id']);

    $queryString = $_SERVER['QUERY_STRING'];

    parse_str($queryString, $params);

    $params['message_sent'] = 1;

    $url = '/?' . http_build_query($params);

    echo "<script type='text/javascript'>window.location.href = '$url';</script>";
    

}

require 'Vues/walks/walk_post_message.phtml';
?>