<?php
namespace Controllers\header;

// session_start();

if (isset ($_POST['logout'])) {

// Détruit toutes les variables de session
$_SESSION = array();

session_destroy();

// Redirige vers la page d'accueil 
header('Location: ../index.php');
exit();
}

require 'Vues/header.phtml';
