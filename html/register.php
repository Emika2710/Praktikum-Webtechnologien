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
        // das Inputfeld username behält den Wert, den der Benutzer eingegeben hat
    }

    if(!isset($_POST["Passwort"]) || empty($_POST["Passwort"])){
        $errorPassword = "Bitte geben Sie ein Passwort ein.";
    } else{
        $password = $_POST["Passwort"];
    }

    if(!isset($_POST["Confirm"]) || empty($_POST["Confirm"])){
        $errorConfirm = "Bitte bestätigen Sie Ihr Passwort.";
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
            
            header("Location: friendlist.php");
            //exit();
        }
    }
    else{
        if(!empty($errorName)){
            echo $errorName;
            echo "<style>#register_username { outline: 1px solid red; }</style>";
            // change the placeholder of the username field to red
        }
        if(!empty($errorPassword)){
            echo $errorPassword;
            // change the password field to red 
            echo "<style>#register_password { outline: 1px solid red; }</style>";
        }
        if(!empty($errorConfirm)){
            echo $errorConfirm;
            echo "<style>#register_confirm { outline: 1px solid red; }</style>";
            // change the confirm field to red
        }
    }

}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Register</title>
    <!-- <link rel="stylesheet" href="style.css"> -->

    <!-- Bootstrap CSS -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    

</head>

<body class="bg-light">

    <div class="container">
            
        <!-- Image -->
        <div class="row justify-content-center mb-4 mt-3">
            <div class="col-2">
                <div class="text-center" id="image">
                    <img src="../images/user.png" class="img-fluid rounded-circle" alt="User-Image">
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="bg-body border p-4">
                    <form>
                        <div class="text-center">

                            <!-- Title -->
                            <h4>Register yourself</h4>

                            <!-- Input -->
                            <div class="form-floating mb-3">
                                <input type="username" class="form-control" placeholder="Username" name="User" id="register_username" onkeyup="checkUsername()">
                                <label for="floatingInput">Username</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" placeholder="Password" name="Passwort" id="register_password" onkeyup="checkPassword()">
                                <label for="floatingInput">Password</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" placeholder="Confirm Password" name="Confirm" id="register_confirm" onkeyup="checkConfirm()">
                                <label for="floatingInput">Confirm Password</label>
                            </div>
                            
                            <!-- Buttons -->
                            <div class="d-grid gap-2">
                                <div class="btn-group" role="group">
                                    <a href="login.php" class="btn btn-secondary">Cancle</a>
                                    <button type="submit" class="btn btn-primary">Register</button>
                                </div>
                            </div>
                            
                        </div>
                    </form>    
                </div>
            </div>
        </div>
    </div>
  


    <!--

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
    -->
    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        function checkUsername(){
            var username = document.getElementById("register_username").value;
            //username.classList.remove('is-valid', 'is-invalid');
            if(username.length <= 2){
                document.getElementById("register_username").classList.add("is-invalid");
            } 
            else{
                document.getElementById("register_username").classList.add("is-valid");
            }
        }
    </script>
</body>

</html>