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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-+qdLaIRZfNu4cVPK/PxJJEy0B0f3Ugv8i482AKY7gwXwhaCroABd086ybrVKTa0q" crossorigin="anonymous">
    

</head>

<body>
    <div class="container">
        <div class="d-grid gap-3">
            <!-- Image -->
            <div class="row justify-content-center mb-4">
                <div class="col-3">
                    <div class="text-center" id="image">
                        <img src="../images/user.png" class="img-fluid rounded-circle" alt="User-Image">
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="row justify-content-center">
                <div class="col-5">
                    <form>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi unde laboriosam consequuntur illo dolores mollitia, maxime molestias possimus reiciendis, incidunt reprehenderit dolorem sint. Perferendis provident, nesciunt temporibus explicabo commodi consectetur?
                    </form>    
                </div>
            </div>

            <form>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
            </form> 
        </div>
    </div>


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

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>    

</body>

</html>