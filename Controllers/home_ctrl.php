<?php
$adRepo = new AdRepository;
//Affichera la carte contenant les ballades ET les parcs
$adList = $adRepo->consultAd();

require 'Vues/home.phtml'

?>