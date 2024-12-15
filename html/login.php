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
        };
    ?>

    <div class="flex">
        <img src="../images/chat.png" alt="Login Image" height="200px" width="200px">
    </div>
    <h1>Please sign in!</h1>
    <div class="title"> Login </div>
    <form class="flex" action="friendlist.php" method="get">
        <div class="form-container">
            <br>
            <label for="login_username">Username:</label><input type="text" placeholder="Username" name="User"
                id="login_username">
            <label for="login_passwort">Passwort:</label><input type="text" placeholder="Password" name="PW"
                id="login_passwort">
        </div>
        <div class="form-buttons">
            <a href="register.php">Register</a>
            <?php 
                //Hier ist ein Fehler, dass die SESSION Variable nicht mit dem User belegt wird, weil ich werde nicht auf Friendlist weitergeleitet
                //Verarbeiten der Formularfelder für Nutzername und Passwort
                    if(isset($_POST["data"])){
                        $username = $_POST["username"];
                        $password = $_POST["password"];

                        //Aufrufen der login Methode im BackendService
                        include_once ("Utils/Backendservice.php");
                        
                        //Ausführen von login (Methode sie nicht Statisch aufzurufen, weil es sonst einen Fehler geworfen hätte)
                        $backendService = new Utils\BackendService($_POST["username"], $_POST["password"]);
                        $correctUser = $backendService->login($_POST["username"], $_POST["password"]);

                        if($correctUser == true){
                            $_SESSION["user"] = $username;
                            echo var_dump($_SESSION);
                            header("Location: friends.php");
                            exit();
                        } else {
                            echo "Fehler bei Passwort oder Nutzername";
                        }
                    }
                ?>
            <input type="submit" value="Login">
        </div>

    </form>
</body>

</html>