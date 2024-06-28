<?php

class UserRepository {
    private PDO $_connexion;

    public function __construct() {
        $this->_connexion = DataBase::getConnexion();
    }
    
        
    public function insertUser(User $user, $cityId) : User {
        $stmt=$this->_connexion->prepare('
        INSERT INTO USERS (user_id,name,password,phone,city_id,role) 
        VALUES 
        (UUID(), :name, :password, :phone, :cityId, :role) 
        ');
        $stmt->bindValue('name',$user->getName());
        $stmt->bindValue('password', password_hash($user->getPassword(), PASSWORD_DEFAULT));
        $stmt->bindValue('phone', $user->getPhone());
        $stmt->bindValue('cityId', $cityId);
        $stmt->bindValue('role', 'user');
        $stmt->execute();
        return $user;
    }

    public function retrieveLoginDatas(string $name): User {
        $stmt = $this->_connexion->prepare('
          SELECT *
          FROM users where name= :name
        ');
        $stmt->bindValue('name',$name);
        $stmt ->execute();
    
        $user = $stmt->fetch(PDO::FETCH_OBJ);
        //Si rien trouvé, retourne null
        if (!$user) {
            echo('salut');
          return null;
        } else {
            $retrievedUser = new User();
            $retrievedUser->setId($user->user_id);
            $retrievedUser->setName($user->name);
            $retrievedUser->setPassword($user->password); 
            $retrievedUser->setPhone($user->phone);
            $retrievedUser->setCityId($user->city_id);
            $retrievedUser->setRole($user->role);
            var_dump($retrievedUser);
            return $retrievedUser;
        }
      
      }
        
}