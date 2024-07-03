<?php
// Détruit toutes les variables de session
$_SESSION = array();
echo('coucou ctrl');
// Détruit la session côté serveur
// session_destroy();

// // Redirige vers la page d'accueil par exemple
// header("?page=home"); // Assurez-vous de rediriger vers la bonne page
// exit();
?>