<?php
namespace Model;
use JsonSerializable;

class User implements JsonSerializable{
    private $username;

    // Konstruktor
    public function __constructor($username = null) {
        $this->username = $username;
    }
    
    //Implementation der Funktion für JsonSerializable
    public	function	jsonSerialize():mixed	{
        return	get_object_vars($this);
        }

    // Getter-Funktion für das Attribut username
    public function getUsername() {
        return $this->username;
    }
    public static function fromJson($data) {
        $user = new self();   // Erzeugt eine neue Instanz der Klasse User
        foreach($data as $key => $value) {
            if (property_exists($user, $key)) {
                $user->{$key} = $value;
            }
        }
        return $user;
    }
}
?>