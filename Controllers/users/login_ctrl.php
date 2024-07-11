<?php

namespace Controllers;
use Models\TryConnectCredentials;
use Repositories\UserRepository;
use Exception;
// Messages d'erreurs    
$userMessages = [
    'sendSuccess' => '',
    'requiredLogin' => '',
    'requiredPassword' => '',
    'loginError' => '',
];

// Si le formulaire est soumis : 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accountSubmit'])) {
    // Msg erreurs + Set du Login et Pwd entrés
    $TryConnectCredentials = new TryConnectCredentials();
    $userMessages['requiredLogin'] = $TryConnectCredentials->setLogin(htmlentities($_POST['login']));
    $userMessages['requiredPassword'] = $TryConnectCredentials->setPassword(htmlentities($_POST['password']));

    // Si champs erreur vides
    if (empty($userMessages['requiredLogin']) && empty($userMessages['requiredPassword'])) {
        $userRepo = new UserRepository();
        try {
            // Méthode Recup identifiants réels
            $userLog = $userRepo->retrieveLoginDatas($_POST['login']);
           
            // Si méthode aboutit
            if ($userLog) {
               
                // Vérification du mot de passe avec password_verify
                if (password_verify($TryConnectCredentials->getPassword(), $userLog->getPassword())) {
                    $_SESSION['User'] = [
                        'id' => $userLog->getId(),
                        'name' => $userLog->getName(),
                        'email' =>$userLog->getEmail()
                    ];
                    echo "<script>window.location.href = window.location.href.split('?')[0] ;</script>";
                   
                    exit();
                } else {          
                    $userMessages['loginError'] = 'Invalid password';
                }
            }
        } catch (Exception $e) {
            // Utilisateur non trouvé ou autre erreur
            $userMessages['loginError'] = $e->getMessage();
        }
    }
}

require 'Vues/users/login.phtml';
?>