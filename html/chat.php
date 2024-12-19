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


        // Die Daten laden
        // das Programm ajax_load_messages laufen lassen

        
        /*
            
            require "ajax_send_messages.php";  

        
        //Was zum Teufel muss ich machen, damit der Chat wenigstens auftaucht??        
        if (!isset($_GET['to'])) {
            http_response_code(400); // bad request
            return;
        }
        */
    ?>

    
    <h1>Chat with <?php echo $to; ?></h1>
    <p class="title">
        <a href="friendlist.php">
            &lt;back </a>|
        <a href="friendlist.php" style="color: red;">remove friend</a>
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
    <form method="post">
    <!-- Als Aktionecho $service-> removeFriend() einfügen -->
        <button type="button" value="Delete Friend"> Delete</button>
    </form>

    <script src="main.js"></script>
    <script>
        loadChat();
    </script>





</body>

</html>