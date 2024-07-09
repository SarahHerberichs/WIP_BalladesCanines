<?php
namespace Controllers\header;

session_start();

if (isset ($_POST['logout'])) {

$_SESSION = array();

session_destroy();

header('Location: ../index.php');
exit();
}

require '../Vues/header.phtml';
