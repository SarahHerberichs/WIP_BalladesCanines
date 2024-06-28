<?php

$page = isset ($_GET['page'])? $_GET['page'] : 'home';

    switch($page) {
        case 'home':
            require 'Controllers/home_ctrl.php';
            break;
        case 'import_location':
            require 'Controllers/import_location_ctrl.php';
            break;
        case 'create_ad':
            require 'Controllers/post_ad_ctrl.php';
            break;
        case 'consult_ads':
            require 'Controllers/consult_ads_ctrl.php';
            break;
        case 'consult_parcs':
            require 'Controllers/consult_parcs_ctrl.php';
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