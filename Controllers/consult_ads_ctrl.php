<?php


$adRepo = new AdRepository;
$adList = $adRepo->consultAd();
$regions = $adRepo->getRegions();
$message = "";
if (isset($_GET['message'])) {
    $message = urldecode($_GET['message']);
}

require 'Vues/consult_ads.phtml';
?>
