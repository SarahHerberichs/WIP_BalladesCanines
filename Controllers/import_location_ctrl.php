<?php

$locationRepo = new LocationRepository();

if (isset($_POST['import_locations']) ){

        $locationRepo->insertLocations();

}


require 'Vues/import_location.phtml';
?>