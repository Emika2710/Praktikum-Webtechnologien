<?php
namespace Model;
use JsonSerializable;

class User implements JsonSerializable{
    private $username;
    //Implementation der Funktion für JsonSerializable
    public	function	jsonSerialize():mixed	{
        return	get_object_vars($this);
        }

    // konstruktor
    public function __constructor($username = null) {
        $this->username = $username;
    }

    // Getter-Funktion für das Attribut username
    public function getUsername() {
        return $this->username;
    }
}
?>