<?php
$userRepo = new UserRepository;
$walkRepo = new WalkRepository;

if (isset( $_POST['confirm_registration'])) {
    $user = new User();
    $user->setEmail(htmlentities($_POST['email']));
    $user->setName(htmlentities($_POST['name']));
    $user->setPassword(($_POST['password']));
    $user->setPhone(htmlentities($_POST['phone']));
    $cityId = $walkRepo->getCityId(htmlentities($_POST['search']));
    $userRepo->insertUser($user,$cityId);
        // Message de succès
    $_SESSION['success_message'] = 'Votre compte a été créé avec succès !';
}
require 'Vues/register.phtml';