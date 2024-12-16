<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8" />
    <title>Friendlist</title>
</head>

<body>
    <?php
        /*zu nutzende Funktionen:
        1. friendRequest($friend)
        2. friendAccept($friend)
        3. friendDismiss($friend)
        4. removeFriend($friend)
        5. userExists($username)
        6. getUnread()
        */
        //Starten von start.php und Backendservice
        require "start.php";
        /*if(!isset($_SESSION['user'])){
            header("Location: login.php");
        };*/ 
        $service->loadFriends();   
    

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
    <form action="friendlist.php" method="post">
    <input type="text" placeholder="Search for User">
    <input type="submit" value="Add">
    <?php 
        //da muss was hin
        
    ?>
    </form>

    <script src="main.js"></script>
    <script>
        loadFriendList();
    </script>
</body>

</html>