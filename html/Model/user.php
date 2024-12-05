<?php
//Model/User.php

class User{
    private $username;
    private $password;
    public function __construct($username){
        $this->username = $username;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getPassword(){
        return $this->password;
    }

    public function set($password){
        $this->passwort = $password;
    }
}
?>