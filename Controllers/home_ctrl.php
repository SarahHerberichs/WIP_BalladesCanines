<?php

namespace Controllers\home;

use Repositories\WalkRepository;
use Repositories\HikeRepository;

$hikeRepo = new HikeRepository;
$walkRepo = new WalkRepository;

$walkList = $walkRepo->consultWalks();
$hikeList = $hikeRepo->consulthikes();
require 'Vues/home.phtml'

?>