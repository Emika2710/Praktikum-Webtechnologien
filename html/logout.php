<!DOCTYPE html>
<html lang="en">

<head>
    <!--<link rel="stylesheet" href="style.css">-->
    <meta charset="UTF-8" />
    <title>Logout</title>

    
    <!-- Bootstrap CSS -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
</head>

<body class="bg-light">
    <?php
        require "start.php";
        session_unset();
    ?>
    <!-- Picture -->
    <div class="d-flex justify-content-center mt-3" style="margin-top: 20px;">
        <img src="../images/logout.png" class="rounded-circle" alt="Logout Image" height="200px" width="200px">
    </div>
    <!-- Kontent -->
    <div class="d-flex justify-content-center mt-3">
        <div class="card shadow-sm" style="width: 400px; height: 200px;">
            <div class="text-center" style="margin: 20px;">
                <h3>Logged out...</h3>
            </div> 
            <div class="text-center" style="margin: 10px;">
                <h6>See you!</h6>
            </div>
            <form class="d-flex justify-content-center" style="margin-top: 5px;">
                <a href="login.php" class="btn btn-secondary" style="width: 200px">Login again</a>
            </form>
        </div>
    </div>
    <!--<div class="row mb-3 mt-5">
        <h1>Logged out...</h1>
    </div>
    see you!<br>
    <br>
    <a href="login.php">Login again</a>-->

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>    

</body>

</html>