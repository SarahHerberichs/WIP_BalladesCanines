<?php

$page = isset ($_GET['page'])? $_GET['page'] : 'home';

    switch($page) {
        case 'home':
            require 'Controllers/home_ctrl.php';
            break;
        case 'import_location':
            require 'Controllers/import_location_ctrl.php';
            break;
        case 'create_walk':
            require 'Controllers/post_walk_ctrl.php';
            break;
        case 'consult_walks':
            require 'Controllers/consult_walks_ctrl.php';
            break;
        case 'consult_randos':
            require 'Controllers/consult_randos_ctrl.php';
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