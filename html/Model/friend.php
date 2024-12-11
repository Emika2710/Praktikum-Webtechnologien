<?php
//Model/Friend.php
namespace Model;

namespace Model;
use JsonSerializable;

class Friend implements JsonSerializable {
    
    private $username;

    public function __construct($username) {
        $this->username = $username;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function jsonSerialize():mixed {
        return get_object_vars($this);
    }

}
?>