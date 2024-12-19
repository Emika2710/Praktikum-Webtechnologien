<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8" />
    <title>Friendlist</title>
</head>

<body>
    <?php
        require "start.php";
        if(!isset($_SESSION['user'])) {
            header("Location: login.php");
            exit();
        }
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

        // wie lade ich jetzt die Freunde in regelmäßigen Abständen neu?
        $friendList = $service->loadFriends();
        //updateFriends($friendlist);
        
        // friendList in Console ausgeben
        echo "<script>console.log(" . json_encode($friendList) . ");</script>";

        // Bei friend_accept wird der Freund akzeptiert
        /*
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && isset($_POST['friend'])) {
            
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
        }
        */
        // wenn ein Button Accept gedrückt wird
        if (isset($_POST["friendlist_accept"]) ) {
            // den korrespondierenden Freund laden
            $friendName = $_POST["friendlist_accept"];

            // Freund akzeptieren
            $service->friendAccept($friendName);
            //echo $friendName;
            //echo "Friend request accepted!";

        }
        if (isset($_POST["friendlist_reject"]) ) {
            // den korrespondierenden Freund laden
            $friendName = $_POST["friendlist_accept"];

            // Freund akzeptieren
            $service->friendDismiss($friendName);
            //echo $friendName;
            //echo "Friend request rejected!";

        }
    ?>

    <h1>Friends</h1>
    <div class="title">
        <a href="logout.php">< Logout</a> | Settings
    </div>
    <hr>
    <div class="flex" method="get">
        <div class="form-container">
            <ul class="friendlist" id="friendslist">
                <!-- loading friends from $friendList that are accepted -->
                <?php
                foreach ($friendList as $friend) {
                    if ($friend->getStatus() == "accepted") {
                        echo "<li><a href='chat.php?friend=" . $friend->getUsername() . "'>" . $friend->getUsername() . "</a>
                        <div class=box>". $friend->getUnread() . "</div>
                        </li>";

                    }
                }
                ?>
        </div>
    </div>
    <hr>
    <h2>New Requests</h2>

    <form class="flex"  method="post">
        <div class="form-list" >
        <ol id="requests">
            <!-- loading friends from $requested that are accepted -->
            <?php
            foreach ($friendList as $friend) {
                if ($friend->getStatus() == "requested") {
                    echo "<li>Friend Request from <b>" . $friend->getUsername() . "</b><div>
                    <button class='button' value=" .$friend->getUsername(). " name='friendlist_accept' id=" . $friend->getUsername() .  ">Accept</button>
                    <button class='button' value=" .$friend->getUsername(). " name='friendlist_reject' id=" . $friend->getUsername() .  ">Reject</button>
                    </div></li>";
                }
            }
            ?>
        </ol>
        </div>
    </form>
    <hr>
        
    </form>
    <form method="post">
        <!--<input type="text" name="NewFriend" placeholder="Search for User"> -->


        <input type="text" placeholder="Add Friend to List" name="NewFriend" id="friend-request-name" list="friend-selector">
        <datalist id="friend-selector">
            <?php
            $userList = $service->loadUsers();
            echo "<script>console.log(" . json_encode($userList) . ");</script>";

            foreach($userList as $value) { ?>
                <option><?= $value; ?></option>
            <?php } ?>
        </datalist>
        <input type="submit" name="action" value="Add">


    <?php
     
    //Neue Freundschaftsanfrage
    if (isset($_POST["action"]) && $_POST["action"] == "Add") {

        // Auslesen der input Zeile
        $possibleFriend = isset($_POST["NewFriend"]) ? $_POST["NewFriend"] : "";

        // prüfen, ob der Nutzer existiert
        if ($service->userExists($possibleFriend)) {

            echo "<br>";
            echo "User exists! ";
            if(!$service->friendRequest($possibleFriend)){
                echo "Failed to send friend request";
            }

            // Das Problem liegt im Backend. Ich konnte es bis zu HttpClient tracken, wo beim absenden der Anfrage "aud Position 0 ein unerwartetes " ist...
            // Er scheint nicht die richtige URL zu finden

        } else {
            echo "This User doesn't exist";
        }
    }
    ?>
    <?php 
    
    ?>
    </form>

    <!--<script src="main.js"></script>
    <script>
        loadFriendList();
    </script>
    -->
</body>

</html>