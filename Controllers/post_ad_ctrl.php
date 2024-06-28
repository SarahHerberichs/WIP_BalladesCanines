<?php

$adRepo = new AdRepository ;
$message = "";
if (isset ($_POST['post_ad'])){
    echo('setttt');
   $ad = new Ad();
   $ad->setDate($_POST['date']);
   $ad->setText(htmlentities($_POST['text']));
   $ad->setTitle(htmlentities($_POST['title']));
    $cityId = $adRepo->getCityId(htmlentities($_POST['search']));
    $adRepo->insertAd($ad, $cityId);
    $message= 'Annonce postée avec succès';

}
require 'Vues/post_ad.phtml';
?>