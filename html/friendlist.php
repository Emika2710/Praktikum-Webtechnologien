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
    /*
        // Überprüfen, ob Login/ Register auch wirklich funktioniert
        try {
            $result = Utils\HttpClient::post("https://online-lectures-cs.thi.de/chat/a500ca45-ce5b-4f16-9d05-abf848edd0a3/login", 
                array("username" => $_SESSION['user'], "password" => $_SESSION['password']));
            echo "Token: " . $result->token;
        } catch(\Exception $e) {
            echo "Authentification failed";
        }
            */
        //ausgeben der Freundesliste über updateFriends, die das Array mit den Freunden erhält und ausgeben soll
        $friendList = $service->loadFriends();
        //updateFriends($friendlist);
        
        // friendList in Console ausgeben
        echo "<script>console.log(" . json_encode($friendList) . ");</script>";
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
        
    </form>
    <form action="friendlist.php" method="post">
    <input type="text" name="possibleFriend" placeholder="Search for User">
    <input type="hidden" name="action" value="add"> <!-- action als verstecktes Feld -->
    <input type="submit" value="Add">
    <?php
    /*Schritte: 
    1. Freundschaftsanfragen annehmbar und ablehnbar machen (Friend Klasse nutzen)
        1.1 Bedingung, dass der Button gedrückt wurde
        1.2 $friend rausholen
        1.2 friend Accept ausführen
    */ 
    //Neue Freundschaftsanfrage
    if (isset($_POST["action"]) && $_POST["action"] == "add") {
        // Auslesen der input Zeile
        $possibleFriend = isset($_POST["possibleFriend"]) ? $_POST["possibleFriend"] : "";
        
        // prüfen, ob der Nutzer existiert
        if ($service->userExists($possibleFriend)) {
            $service->friendAccept($possibleFriend);
            echo "Friend request sent to $possibleFriend!";
        } else {
            echo "This User doesn't exist";
        }
    }
    ?>
    <?php 
    //Versuch für Accept und Reject
    /*if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && isset($_POST['friend'])) {
        $action = $_POST['action'];
        $friend = $_POST['friend'];
    
        if ($action === "accept") {
            if ($service->friendAccept($friend)) {
                echo json_encode(["status" => "success", "message" => "Friend request accepted."]);
            } else {
                echo json_encode(["status" => "error", "message" => "Failed to accept friend request."]);
            }
        } elseif ($action === "decline") {
            if ($service->friendDismiss($friend)) {
                echo json_encode(["status" => "success", "message" => "Friend request declined."]);
            } else {
                echo json_encode(["status" => "error", "message" => "Failed to decline friend request."]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Invalid action."]);
        }
        exit();
    }*/
    ?>
    </form>

    <!--<script src="main.js"></script>
    <script>
        loadFriendList();
    </script>
    -->
</body>

</html>