<?php

$page = isset ($_GET['page'])? $_GET['page'] : 'home';

    switch($page) {
        case 'home':
            require 'Controllers/home_ctrl.php';
            break;
        case 'import_location':
            require 'Controllers/import_location_ctrl.php';
            break;
        case 'post_walk':
            require 'Controllers/walks/post_walk_ctrl.php';
            break;
        case 'consult_walks':
            require 'Controllers/walks/consult_walks_ctrl.php';
            break;
        case 'consult_hikes':
            require 'Controllers/hikes/consult_hikes_ctrl.php';
            break;
        case 'post_hike':
            require 'Controllers/hikes/post_hike_ctrl.php';
            break;
        case 'register':
            require 'Controllers/register_ctrl.php';
            break;
        case 'login':
            require 'Controllers/login_ctrl.php';
            break;
        
        default:
            require 'Controllers/home_ctrl.php';
    }