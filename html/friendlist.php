<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8" />
    <title>Friendlist</title>
</head>

<body>
    <?php
        //Starten von start.php und Backendservice
        require "start.php";
        /*if(!isset($_SESSION['user'])){
            header("Location: login.php");
        };*/
    ?>

    <h1>Friends</h1>
    <div class="title">
        <a href="logout.php">Logout</a> | Settings
    </div>
    <hr>
    <div class="flex" method="get">
        <div class="form-container">
            <ul class="friendlist" id="friendslist">
            </ul>
        </div>
    </div>
    <hr>
    <h2>New Requests</h2>

    <form class="flex" action="friendlist.php" method="get">
        <div class="form-list" >
            <ol id="requests">
            </ol>
        </div>
    </form>
    <hr>
    <form>
        <input type="text" placeholder="Add Friend to List"></input>
        <input type="submit" value="Add"></input>
    </form>

    <script src="main.js"></script>
    <?php
    var_dump($user);
    ?>
    <script>
        loadFriendList();
    </script>
</body>

</html>