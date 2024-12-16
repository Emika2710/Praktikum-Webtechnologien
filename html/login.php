<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8" />
    <title>Login</title>
</head>

<body>
    <?php 
        //Starten von start.php und Backendservice
        require "start.php";

        if(isset($_SESSION['user'])){
            header("Location: friends.php");
            exit();
        };
    ?>

    <div class="flex">
        <img src="../images/chat.png" alt="Login Image" height="200px" width="200px">
    </div>
    <h1>Please sign in!</h1>
    <div class="title"> Login </div>
    <form class="flex" action="friendlist.php" method="post">
        <div class="form-container">
            <br>
            <label for="login_username">Username:</label><input type="text" placeholder="Username" name="Username"
                id="login_username">
            <label for="login_passwort">Passwort:</label><input type="text" placeholder="Password" name="Password"
                id="login_passwort">
        </div>
        <div class="form-buttons">
            <a href="register.php">Register</a>
            <input type="submit" value="Login" name="Login" method="post">
            <?php 
                //Hier ist ein Fehler, dass die SESSION Variable nicht mit dem User belegt wird
                //Verarbeiten der Formularfelder für Nutzername und Passwort
                    if(isset($_POST["Login"])){
                        $username = $_POST["username"];
                        $password = $_POST["password"];
                        
                        $correctUser = $service->login($username, $password);

                        //egal, ob ich diese Funktion ausklammere oder nicht, ich werde auf die Standard-Seite weiter geleitet.
                        if($correctUser == true && $userExists == true){
                            $_SESSION['user'] = $username;
                            header("Location: friends.php");
                            exit();
                        } else {
                            echo "Fehler bei Passwort oder Nutzername";
                        }
                    }
                ?>
        </div>

    </form>
</body>

</html>