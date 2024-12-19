<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8" />
    <title>Chat</title>
    
</head>

<body>
    <!-- Freund Löschen -->
<?php
        require "start.php";
 

        //Überprüfen ob Daten Stimmen
        if(!isset($_SESSION["user"])){
            header("Location: login.php");
            exit();
        }

        if (isset($_GET['to']) && !empty(trim($_GET['to']))) {
            $to = $_GET['to'];
        } else {
            header("Location: friendlist.php");
            exit();
        } 
        if(isset($_POST["action"]) && $_POST["action"] == "delete"){
            echo "Delete";
            $service-> removeFriend($to);
            header("Location: friendlist.php");
        }

    ?>

    
    <h1>Chat with <?php echo $to; ?></h1>
    <p class="title">
        <a href="friendlist.php">
            &lt;back </a>|
        <!--<a href="friendlist.php" style="color: red;">remove friend</a> -->
        <button class="button" name="action" value="delete">Delete</button>
    </p>
    <form class="flex" action="friendlist.php" method="get">
        <div class="form-container">
            <ul id="chat">
                <!-- Hier werden die Nachrichten angezeigt und formatiert -->
                <!-- <?php $messages = require('ajax_load_messages.php') ?> -->

            </ul>
        </div>
    </form>
    <br>
    <form method="get" action="chat.php">
        <input type="text" id="message" placeholder="new message">
        <input type="button" value="Send" onclick="sendMessage()">
    </form>

    <script src="main.js"></script>
    <script>
        loadChat();
    </script>


</body>

</html>