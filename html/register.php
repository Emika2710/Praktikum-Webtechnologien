<?php
require "start.php";
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
    <form class="flex" method="post" value="<?php if(isset($_POST['Username'])) { echo
$_POST['test']; } ?>">
        <div class="form-container">
            <br>
            <label for="register_username">Username:</label> <input type="text" placeholder="Username" name="User" id="register_username"> <br>
            <label for="register_passwort">Passwort:</label> <input type="text" placeholder="Passwort" name="Passwort" id="register_password"> <br>
            <label for="register_confirm">Confirm Passwort:</label> <input type="text" placeholder="Confirm Passwort" name="Confirm" id="register_confirm">
        </div>
        <div class="form-buttons">
            <a href="login.php">Cancel</a>
            <input type="submit" value="Create Account" class="create-account">
            <button class="button" name="action" value="register">Create Account</button>
        </div>
        
        
        <?php

        $errorName = "";
        $errorPassword = "";
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
            if(strlen($username) <= 3){
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
                $errorPassword = "Die Passwörter stimmen nicht überein.";
            }

            // Wenn keine Fehler aufgetreten sind
            if(empty($errorName) && empty($errorPassword)){

                // Benutzer registrieren
                if($service->register($username, $password)){
                    //echo "Benutzer wurde erfolgreich registriert.";
                    $_SESSION['user'] = $username;
                    //echo $_SESSION['user'];
                    // Warum wird user nicht in die Session geschrieben?
                    
                    header("Location: friendlist.php");
                }
            }
            }
        ?>
    </form>

</body>

</html>