<?php
session_start();

if (isset ($_POST['logout'])) {

$_SESSION = array();

// Détruit la session côté serveur
session_destroy();

// Redirige vers la page d'accueil 
header('Location: ../../index.php');exit();
}
?>