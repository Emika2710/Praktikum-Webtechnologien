<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8" />
    <title>Login</title>

    
    <!-- Bootstrap CSS -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-+qdLaIRZfNu4cVPK/PxJJEy0B0f3Ugv8i482AKY7gwXwhaCroABd086ybrVKTa0q" crossorigin="anonymous">
    
</head>

<body>
    <?php 
        $username = "";
        $password = "";


        //Starten von start.php und Backendservice
        require "start.php";

        //Hier ist ein Fehler, dass die SESSION Variable nicht mit dem User belegt wird
        //Verarbeiten der Formularfelder für Nutzername und Passwort
        if(isset($_POST["action"]) && $_POST["action"] == "login"){
            $username = $_POST["Username"];
            $password = $_POST["Password"];

            // Überprüfen ob Nutzername und Passwort korrekt sind
            if($service->login($username, $password) && $service -> userExists($username)){
                $_SESSION['user'] = $username;
                $_SESSION['password'] = $password;
                
                //echo "Login erfolgreich";

                header("Location: friendlist.php");
                exit();
            } else {
                echo "Fehler bei Passwort oder Nutzername";
            }
        }
    
    ?>

    <div class="flex">
        <img src="../images/chat.png" alt="Login Image" height="200px" width="200px">
    </div>
    <h1>Please sign in!</h1>
    <div class="title"> Login </div>
    <form class="flex" method="post">
        <div class="form-container">
            <br>
            <label for="login_username">Username:</label><input type="text" placeholder="Username" name="Username"
                id="login_username">
            <label for="login_passwort">Passwort:</label><input type="text" placeholder="Password" name="Password"
                id="login_passwort">
        </div>
        <div class="form-buttons">
            <a href="register.php">Register</a>

            <!--<input type="submit" value="Login" name="login" method="post"> -->
            <button class="button" name="action" value="login">Login</button>

        </div>

    </form>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>    

</body>

</html>