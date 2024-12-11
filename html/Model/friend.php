<?php
//Model/Friend.php
namespace Model;
use JsonSerializable;

class Friend implements JsonSerializable {
    //Attribute
    private $username;
    private $status;
    //Konstruktor
    public function __constructor($username) {
        $this->username = $username;
    }

    //Implementation der Funktion für JsonSerializable
    public function jsonSerialize():mixed {
        return	get_object_vars($this);
    }

    //Methoden, die den Zustand auf accepted bzw. dismissed setzen
    public function setAccepted(){
        $this->status = 'accepted';
    }
    public function setDismissed(){
        $this->status = 'dismissed';
    }

    //Getter
    public function getUsername() {
        return $this->username;
    }
    public function getStatus() {
        return $this->status;
    }
}
?>