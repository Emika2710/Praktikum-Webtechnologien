<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8" />
    <title>Login</title>
</head>

<body>
    <?php 
        //laden der start.php Datei
        include ('start.php');

        //Einbinden BackendService
        include_once ('Utils\BackendService.php');

        //Überprüfung, ob das Formular abgesendet wurde
        if($_SERVER["REQUEST_METHOD"]=="GET"){
            $username = $_GET["User"];
            $password = $_GET["Password"];
    
            // Erstellung einer Instanz der Klasse BackendService (es gab Probleme beim statischen Aufruf einer nicht statischen Methode)
            $backendService = new Utils\BackendService($username,$password);

            // Nicht-statischer Aufruf der login Methode
            $result = $backendService->login($username, $password);

            if($result){
                $_SESSION["user"] = $username;
                header("Location: friends.php");
                exit();
            }else{
                echo"<div class='error-message'>Fehler: Ungültiger Benutzername oder Passwort.</div>";
            }
        }
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
            <input type="submit" value="Login">
        </div>

    </form>
</body>

</html>