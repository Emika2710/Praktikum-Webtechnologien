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
        include("start.php");
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
            <?php 
                //Verarbeiten der Formularfelder für Nutzername und Passwort
                    if(isset($_POST)){

                    }
                    //include("Utils/Backendservice,php");
                ?>
        </div>

    </form>
</body>

</html>