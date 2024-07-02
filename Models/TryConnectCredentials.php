<?php
class TryConnectCredentials {   
  private string $_login;
  private string $_password;

  // Set le password entré par l'utilisateur
  public function setPassword(string $password): string {
    if (!empty($password)) {
      $this->_password = $password;
      return '';
    }
    return 'Please, insert your password';
  }

  // Set le login entré par l'utilisateur
  public function setLogin(string $login): string {
    if (!empty($login)) {
      $this->_login = $login;
      return '';
    }
    return 'Please, insert your email';
  }

  // Méthode de Verification de l'identité (loggin Réel en parametre) comparé avec login entré
  public function isValidLogin(string $accountLogin): bool {
    return $this->_login === $accountLogin;
  }

  public function getLogin(): string {
    return $this->_login;
  } 

  public function getPassword(): string {
    return $this->_password;
  }
}
