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
    // <input type="button" value="Delete" onclick="window.location.href='friendlist.php'; <?php echo $service->removeFriend($to); " >
?>

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

<body class="bg-light">    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <!-- Headline -->
                <div class="row mb-3 mt-5">
                    <h1>Chat with <?php echo $to?></h1>
                </div>

                <!-- Navigation -->
                <div class="row my-3">
                    <div class="col-8">     
                         <div class="btn-group" role="group">
                        
                            <a href="friendlist.php" class="btn btn-secondary">< Back</a>
                            <button type="button" class="btn btn-secondary">Show Profil</button>
                            <input type="button" class="btn btn-danger" value="Remove Friend" onclick="showDelete()">
                        </div>
                    </div>
                </div>

                <!-- Chatverlauf -->
                <div class="row mb-3">
                    <div class="bg-body border px-3 pt-2">
                        <ul id="chat" class="list-unstyled">
                            <!-- Hier werden die Nachrichten angezeigt und formatiert -->
                        </ul>
                    </div>
                </div>

                <!-- Neue Nachricht senden-->
                <div class="row my-4">
                    <form method="post" class="form-group px-0">   
                        <div class="btn-group col-12 " type="group">
                            <input type="text" class="form-control" placeholder="New Message" id="message">
                            <input type="button" class="btn btn-primary" value="Send" onclick="sendMessage()">
                        </div>
                    </form>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title fw-semibold" id="modal_heading">Remove <?php echo $to ?> as Friend</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Do you really wnat to end your friendship?
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancle</button>
                            <button type="button" class="btn btn-primary" onclick="removeFriend()" data-bs-dismiss="modal">Yes, Please!</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>    

    <script src="main.js"></script>
    <script>
        loadChat();
        window.setInterval(function () {
            loadChat();
        }, 1000);

        function showDelete(){
            var myModal = new bootstrap.Modal(document.getElementById('myModal'));
            myModal.show();
        }

        function removeFriend(){
            window.location.href = "chat.php?to=<?php echo $to ?>&action2=Delete";  
        }
        
    </script>
</body>

</html>
<?php
/*
    <h1>Chat with <?php echo $to; ?></h1>
    <p class="title">
        <a href="friendlist.php">back </a>
        <!--<a href="friendlist.php" style="color: red;">remove friend</a> -->
        <input type="button" value="Delete" onclick="">        

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

    
    */
?>