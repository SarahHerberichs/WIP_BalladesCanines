<?php

namespace Repositories;

use PDO;
use Models\User;
use Exception;

class UserRepository {
    private PDO $_connexion;

    public function __construct() {
        $this->_connexion = DataBase::getConnexion();
    }
    
        
    public function insertUser(User $user, $cityId) : User {
        $stmt=$this->_connexion->prepare('
        INSERT INTO USERS (user_id,name,password,phone,city_id,role, email) 
        VALUES 
        (UUID(), :name, :password, :phone, :cityId, :role, :email) 
        ');
        $stmt->bindValue('email', $user->getEmail());
        $stmt->bindValue('name',$user->getName());
        $stmt->bindValue('password', password_hash($user->getPassword(), PASSWORD_DEFAULT));
        $stmt->bindValue('phone', $user->getPhone());
        $stmt->bindValue('cityId', $cityId);
        $stmt->bindValue('role', 'user');
        $stmt->execute();
        return $user;
    }

    public function retrieveLoginDatas(string $email): User {
        $stmt = $this->_connexion->prepare('
          SELECT *
          FROM users where email= :email
        ');
        $stmt->bindValue('email',$email);
        $stmt ->execute();
    
        $user = $stmt->fetch(PDO::FETCH_OBJ);

        if (!$user) {
          throw new Exception('Utilisateur non trouvé.');
        } else {
            $retrievedUser = new User();
            $retrievedUser ->setEmail($user->email);
            $retrievedUser->setId($user->user_id);
            $retrievedUser->setName($user->name);
            $retrievedUser->setPassword($user->password); 
            $retrievedUser->setPhone($user->phone);
            $retrievedUser->setCityId($user->city_id);
            $retrievedUser->setRole($user->role);
            return $retrievedUser;
        }
      }  
      public function getUserDatas(string $userId): User {
        $stmt = $this->_connexion->prepare('
          SELECT *
          FROM users where user_id= :userId
        ');
        $stmt->bindValue('userId',$userId);
        $stmt ->execute();
    
        $user = $stmt->fetch(PDO::FETCH_OBJ);

        if (!$user) {
          throw new Exception('Utilisateur non trouvé.');
        } else {
            $retrievedUser = new User();
            $retrievedUser ->setEmail($user->email);
            $retrievedUser->setId($userId);
            $retrievedUser->setName($user->name);
            $retrievedUser->setPassword($user->password); 
            $retrievedUser->setPhone($user->phone);
            $retrievedUser->setCityId($user->city_id);
            $retrievedUser->setRole($user->role);
            return $retrievedUser;
        }
      }  

      public function updateUser(User $user) : User {
        $stmt=$this->_connexion->prepare('
      UPDATE USERS 
            SET name = :name, password = :password, phone = :phone, email = :email 
            WHERE user_id = :user_id 
        ');
        $stmt->bindValue('user_id', $user->getId());
        $stmt->bindValue('email', $user->getEmail());
        $stmt->bindValue('name',$user->getName());
        $stmt->bindValue('password', password_hash($user->getPassword(), PASSWORD_DEFAULT));
        $stmt->bindValue('phone', $user->getPhone());
        $stmt->execute();
        return $user;
    }
}