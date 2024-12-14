<?php
require("start.php");
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
            <input type="submit" value="Create Account" class="create-account">
            <button class="button" name="action" value="register">Create Account</button>
        </div>
        <?php
            $username = $_POST["User"];
            $password = $_POST["Passwort"];
            $confirm = $_POST["Confirm"];

            if($username != null && strlen($username) >= 3 && !$service->userExists($username)){

                if($password != null && strlen($password) >= 8 && $password == $confirm){
                    //register($username, $password);

                    if($service->register($username, $password)){
                        $_SESSION["user"] = $username;

                        // ICH WAR HIER -> er scheint hier nicht zu landen
                        var_dump($username);
                        var_dump($password);
                        var_dump($user);
                        //header("Location: friendlist.php");
                    }
                }
                else{
                    //TODO: Error Message Password
                }
            }
            else{
                //TODO: Error Message Username

            }
        ?>
    </form>

</body>

</html>