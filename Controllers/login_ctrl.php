<?php

require_once __DIR__ . '/../Models/TryConnectCredentials.php';

// Messages d'erreurs    
$userMessages = [
    'sendSuccess' => '',
    'requiredLogin' => '',
    'requiredPassword' => '',
];

// Si le formulaire est soumis : 
if (isset($_POST['accountSubmit'])) {
    // Msg erreurs + Set du Login et Pwd entrés
    $TryConnectCredentials = new TryConnectCredentials();
    $userMessages['requiredLogin'] = $TryConnectCredentials->setLogin(htmlentities($_POST['login']));
    $userMessages['requiredPassword'] = $TryConnectCredentials->setPassword(htmlentities($_POST['password']));

    // Si champs erreur vides
    if (empty($userMessages['requiredLogin']) && empty($userMessages['requiredPassword'])) {
        $userRepo = new UserRepository;
        // Méthode Recup identifiants réels
        $userLog = $userRepo->retrieveLoginDatas($_POST['login']);
        // Si méthode aboutit
        if ($userLog) {
            // Vérification du mot de passe avec password_verify
            if (password_verify($TryConnectCredentials->getPassword(), $userLog->getPassword())) {
         
                $_SESSION['User'] = [
                    'id' => $userLog->getId(),
                    'name' => $userLog->getName(),
                ];
                header('Location:?page=home');
                exit();
            } else {          
                echo 'Invalid password';
                header('Location:?page=login');
                exit();
            }
        } else {
            // Utilisateur non trouvé
            header('Location:?page=login');
            exit();
        }
    }
}

require 'Vues/login.phtml';
