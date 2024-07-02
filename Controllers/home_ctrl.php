<?php
$walkRepo = new WalkRepository;
//Affichera la carte contenant les walks ET les parcs
$walkList = $walkRepo->consultWalks();

require 'Vues/home.phtml'

?>