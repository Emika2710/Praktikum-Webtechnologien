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
    <form class="flex" action="friendlist.php" method="get">
        <div class="form-container">
            <br>
            <label for="register_username">Username:</label> <input type="text" placeholder="Username"> <br>
            <label for="register_passwort">Passwort:</label> <input type="text" placeholder="Passwort"> <br>
            <label for="register_confirm">Confirm Passwort:</label> <input type="text" placeholder="Confirm Passwort">
        </div>
        <div class="form-buttons">
            <a href="login.php">Cancel</a>
            <input type="submit" value="Create Account" class="create-account">
        </div>
    </form>

</body>

</html>