<?php


class User {
    //Atributos
    private $username;
    private $password;
    private $type;
    private $email;
    
    //Construtor padrão
    public function __construct() {
        
    }
    
    //Gettes e setters
    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getType() {
        return $this->type;
    }
    
    public function getEmail() {
        return $this->email;
    }

    public function setUsername($username): void {
        $this->username = $username;
    }

    public function setPassword($password): void {
        $this->password = $password;
    }

    public function setType($type): void {
        $this->type = $type;
    }

    public function setEmail($email): void {
        $this->email = $email;
    }
}
