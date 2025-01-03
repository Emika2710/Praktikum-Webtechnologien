<?php
require "start.php";

// Error-Handling
$errorUsername = "";
$errorPassword = "";
$errorConfirm = "";
$username = "";
$password = "";
$confirm = "";


// Wenn das Formular abgeschickt wurde
if (isset($_POST["action"]) && $_POST["action"] == "register") {
    
    
    $username = $_POST["User"];
    $password = $_POST["Passwort"];
    // Benutzer registrieren
    if($service->register($username, $password)){
        
        echo "Benutzer wurde erfolgreich registriert.";
        $_SESSION['user'] = $username;
        $_SESSION['password'] = $password;

        header("Location: friendlist.php");
        exit();
    }


    /*
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
        $errorConfirm = "Bitte bestätigen Sie Ihr Passwort.";
    } else{
        $confirm = $_POST["Confirm"];
    }
    */
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
                    <form method="post">
                        <div class="text-center">

                            <!-- Title -->
                            <h4>Register yourself</h4>

                            <!-- Input -->
                            <div class="form-floating mb-3">
                                <input type="username" class="form-control" placeholder="Username" name="User" id="register_username" onkeyup="checkUsername()" required>
                                <label for="floatingInput">Username</label>
                                <div class="invalid-feedback">
                                </div>
                            </div>
                            
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" placeholder="Password" name="Passwort" id="register_password" onkeyup="checkPassword()" required>
                                <label for="floatingInput">Password</label>
                                <div class="invalid-feedback">
                                    The password must be at least 8 characters long.
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" placeholder="Confirm Password" name="Confirm" id="register_confirm" onkeyup="checkConfirm()" required>
                                <label for="floatingInput">Confirm Password</label>
                                <div class="invalid-feedback">
                                    The passwords do not match.
                                </div>
                            </div>
                            
                            <!-- Buttons -->
                            <div class="d-grid gap-2">
                                <div class="btn-group" role="group">
                                    <a href="login.php" class="btn btn-secondary">Cancle</a>
                                    <button class="btn btn-primary" id="register_button" name="action" value="register">Register</button>
                                </div>
                            </div>
                        </div>
                    </form>    
                </div>
            </div>
        </div>
        
        <!-- Invisible Error -->
        <div class="visually-hidden">
            <div id="errorUsername">                
            </div>
            <div id="errorPassword">
            </div>
            <div id="errorConfirm">
            </div>
        </div>
    </div>
  
    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="register_helper.js"></script>
    <script>
        // Button disabled until all inputs are valid
        document.getElementById("register_button").disabled = true;

        window.setInterval(function () {
            // Gett error messages
            var errorUsername = document.getElementById("errorUsername").innerHTML;
            var errorPassword = document.getElementById("errorPassword").innerHTML;
            var errorConfirm = document.getElementById("errorConfirm").innerHTML;

            // Check if all inputs are valid
            if (errorUsername == "" && errorPassword == "" && errorConfirm == "") {
                document.getElementById("register_button").disabled = false;
            } else {
                document.getElementById("register_button").disabled = true;
            }
        }, 500);

    </script>

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
</body>

</html>