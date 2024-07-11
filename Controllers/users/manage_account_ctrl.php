<?php

namespace Controllers;

use Repositories\UserRepository;
use Models\TryConnectCredentials;
use Models\User;
use Exception;

$userRepo = new UserRepository;
$user = $userRepo->getUserDatas(($_SESSION['User']['id']));
   
//Message pr stocker erreurs ou success et savoir si password a été vérifié
$errorConfirmPwd = "";
$messageSuccess = "";
$passwordVerified = false;
$errorPassword="";

if (isset($_POST['updateAccountSubmit'])){
//Methode de vérification du password INITIAL
$TryConnectCredentials = new TryConnectCredentials();
$errorPassword = $TryConnectCredentials->setPassword(htmlentities($_POST["old_password"]));
    //Si submit, tryconnect par rapport à l'input oldPwd -> set pwg. Retourne un msg si pas bon
    if ($errorPassword=="") {
       
        try{
            $userLog = $userRepo->retrieveLoginDatas($_SESSION['User']['email']);
           
            if ($userLog) {
                if (password_verify($TryConnectCredentials->getPassword(),$userLog->getPassword())) {
                    echo("Password OK");
                    $passwordVerified = true;
                } else{
                    $errorPassword='Mot de passe invalide';
                    $passwordVerified = false;
                }       
           }
        }catch (Exception $e) {
            // Utilisateur non trouvé ou autre erreur
           echo($e->getMessage());
        }
    } 

    // Fin de verif du password, passwordVerified est true ou false

    //Si le password est bien celui de la BDD, dans tout les cas on passe à l'update de l'user
    if ($passwordVerified){
        $userInUpdate = new User;
        $userInUpdate->setName($_POST["name"]);
        $userInUpdate->setEmail($_POST['email']);
        $userInUpdate->setPhone($_POST['phone']);
        $userInUpdate->setId($_SESSION["User"]["id"]);

        //Si demande de modif du password
        if ($_POST['new_password'] != "") {
            //Si les deux nouveaux sont identiques on update l'user
            if (($_POST['confirm_new_password'])=== $_POST["new_password"]){
                $userInUpdate->setPassword($_POST["new_password"]);
                $userRepo->updateUser($userInUpdate);
                $messageSuccess = "Votre compte a bien été modifié et votre MDP a changé";
                $_SESSION['User'] = [
                    'id' => $userInUpdate->getId(),
                    'name' => $userInUpdate->getName(),
                    'email' =>$userInUpdate->getEmail()
                ];
           //Les deux mdp pas identique, erreur
            } else{
               $errorPassword = "Les deux mdp ne sont pas identiques";
            }
            //Si pas de demande de modif de password, on garde l'ancien et on update l'user
        } else {
         
          $userInUpdate->setPassword($_POST["old_password"]);
          $userRepo->updateUser($userInUpdate);
          $messageSuccess = "Votre Compte a bien été modifié";
          $_SESSION['User'] = [
            'id' => $userInUpdate->getId(),
            'name' => $userInUpdate->getName(),
            'email' =>$userInUpdate->getEmail()
        ];
        }
    }
    //LE password initial n'était pas bon
    else {
        echo("entrez votre ancien MDP pour toute modification");
    }
}


require 'Vues/users/manage_account.phtml';