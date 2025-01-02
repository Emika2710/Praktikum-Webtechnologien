<!DOCTYPE html>
<html>

<head>
    <!--<link rel="stylesheet" href="style.css">-->
    <meta charset="UTF-8" />
    <title>Chat</title>
    
    
    <!-- Bootstrap CSS -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
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
    // Wenn der Button Delete gedrückt wird wird der Freund gelöscht
    if(isset($_GET['action2']) && $_GET['action2'] == "Delete"){
        echo "Delete";
        if($service->removeFriend($to)){
            header("Location: friendlist.php");
            exit();
        }

    }
?>

    
    <h1>Chat with <?php echo $to; ?></h1>
    <p class="title">
        <a href="friendlist.php">
            &lt;back </a>|
        <!--<a href="friendlist.php" style="color: red;">remove friend</a> -->

        <input type="button" value="Delete" onclick="window.location.href='friendlist.php'; <?php echo $service->removeFriend($to); ?> " >

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

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>    

    <script src="main.js"></script>
    <script>
        loadChat();
    </script>


</body>

</html>