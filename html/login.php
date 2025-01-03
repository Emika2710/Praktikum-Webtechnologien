<!DOCTYPE html>
<html lang="en">

<head>
    <!--<link rel="stylesheet" href="style.css">-->
    <meta charset="UTF-8" />
    <title>Login</title>

    
    <!-- Bootstrap CSS -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
</head>

<body class="bg-light">
    <?php 
        $username = "";
        $password = "";


        //Starten von start.php und Backendservice
        require "start.php";

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
   <!-- Picture -->
<div class="d-flex justify-content-center mt-3" style="margin-top: 20px;">
    <img src="../images/chat.png" class="rounded-circle" alt="Login Image" height="200px" width="200px">
</div>
    <div class="d-flex justify-content-center mt-3">
        <div class="card shadow-sm" style="width: 400px; height: 300px;">
            <!--Überschrift-->
            <h2 class="text-center" style="margin: 20px;">Please Sign in</h2>

            <div class="d-flex justify-content-center mt-3">
                <form class="flex" method="post">
                    <!--Eingabe-->
                    <div class="form-container">
                        <input type="text" class="form-control" style="max-width: 300px; margin-top: 15px" placeholder="Username" name="Username" id="login_username">
                        <input type="text" class="form-control" style="max-width: 300px; margin-top: 15px" placeholder="Password" name="Password" id="login_passwort">
                    </div>
                    <!--Buttons-->
                    <div class="btn-group" role="group" style="margin-top: 15px">
                        <a href="register.php" class="btn btn-secondary" style="width: 150px">Register</a>
                        <button class="btn btn-primary" name="action" value="login" style="width: 150px">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>    

</body>

</html>