<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8" />
    <title>Chat</title>
</head>

<body>
<?php
        require "start.php";
        require "ajax_load_messages.php";
        require "ajax_send_messages.php";

        //Überprüfen ob Daten Stimmen
        if(!isset($_SESSION["user"])){
            header("Location: login.php");
            exit();
        }

        if (isset($_GET['friend']) && !empty(trim($_GET['friend']))) {
            $friend = htmlspecialchars($_GET['friend']);
            echo "Das Chat-Ziel ist: " .$friend;
        } else {
            header("Location: friendlist.html");
            exit();
        }
        //Was zum Teufel muss ich machen, damit der Chat wenigstens auftaucht??        
        if (!isset($_GET['to'])) {
            http_response_code(400); // bad request
            return;
        }
    ?>
    
    <h1>Chat with <?php echo $friend; ?></h1>
    <p class="title">
        <a href="friendlist.php">
            &lt;back </a>|
        <a href="friendlist.php" style="color: red;">remove friend</a>
    </p>
    <form class="flex" action="friendlist.php" method="get">
        <div class="form-container">
            <ul id="chat">
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
        onChatLoad();
    </script>
</body>

</html>