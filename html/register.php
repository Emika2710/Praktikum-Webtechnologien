<?php
require "start.php";

$errorName = "";
$errorPassword = "";
$errorConfirm = "";
$username = "";
$password = "";
$confirm = "";


// Wenn das Formular abgeschickt wurde
if (isset($_POST["action"]) && $_POST["action"] == "register") {

    // Validierung
    if(!isset($_POST["User"]) || empty($_POST["User"])){
        $errorName = "Bitte geben Sie einen Benutzernamen ein.";
    } else{
        $username = $_POST["User"];
    }

    if(!isset($_POST["Passwort"]) || empty($_POST["Passwort"])){
        $errorPassword = "Bitte geben Sie ein Passwort ein.";
    } else{
        $password = $_POST["Passwort"];
    }

    if(!isset($_POST["Confirm"]) || empty($_POST["Confirm"])){
        $errorPassword = "Bitte bestätigen Sie Ihr Passwort.";
    } else{
        $confirm = $_POST["Confirm"];
    }

    // Username überprüfen
    if(strlen($username) <= 2){
        $errorName = "Der Benutzername muss mindestens 3 Zeichen lang sein.";
    }
    if($service->userExists($username)){
        $errorName = "Der Benutzername ist bereits vergeben.";
    }

    // Passwort überprüfen
    if(strlen($password) < 8){
        $errorPassword = "Das Passwort muss mindestens 8 Zeichen lang sein.";
    }
    if($password != $confirm){
        $errorConfirm = "Die Passwörter stimmen nicht überein.";
    }

    // Wenn keine Fehler aufgetreten sind
    if(empty($errorName) && empty($errorPassword)){

        // Benutzer registrieren
        if($service->register($username, $password)){
            //echo "Benutzer wurde erfolgreich registriert.";
            $_SESSION['user'] = $username;
            $_SESSION['password'] = $password;
            echo $_SESSION['user'];
            
            header("Location: friendlist.php");
        }
    }
    else{
        if(!empty($errorName)){
            echo $errorName;
        }
        if(!empty($errorPassword)){
            echo $errorPassword;
        }
        if(!empty($errorConfirm)){
            echo $errorConfirm;
        }  
    }
    try {
        $result = Utils\HttpClient::post("https://online-lectures-cs.thi.de/chat/a500ca45-ce5b-4f16-9d05-abf848edd0a3/register", array("username" => $username, "password" => $password));
        echo "Token: " . $result->token;
    } catch(\Exception $e) {
        echo "Authentification failed";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="flex">
        <img src="../images/user.png" alt="User-Image" height="200px" width="200px">
    </div>

    <h1>Please register yourself</h1>

    <div class="title">
        Register
    </div>
    <form class="flex" method="post">
        <div class="form-container">
            <br>
            <label for="register_username">Username:</label> <input type="text" placeholder="Username" name="User" id="register_username"> <br>
            <label for="register_passwort">Passwort:</label> <input type="text" placeholder="Passwort" name="Passwort" id="register_password"> <br>
            <label for="register_confirm">Confirm Passwort:</label> <input type="text" placeholder="Confirm Passwort" name="Confirm" id="register_confirm">
        </div>
        <div class="form-buttons">
            <a href="login.php">Cancel</a>
            <button class="button" name="action" value="register">Create Account</button>
        </div>
        
    </form>

</body>

</html>