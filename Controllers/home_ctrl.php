<?php

namespace Controllers\home;

use Repositories\WalkRepository;

$walkRepo = new WalkRepository;

$walkList = $walkRepo->consultWalks();

require 'Vues/home.phtml'

?>