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
        */
        //Starten von start.php und Backendservice
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
        
        // friendList in Console ausgeben
        echo "<script>console.log(" . json_encode($friendList) . ");</script>";

        // Bei friend_accept wird der Freund akzeptiert
        if (isset($_POST["action"]) && $_POST["action"] == "friendlist_accept") {

            $newfreind = $service-> loadUser($_POST["friend"].getUsername());
            $service->friendAccept($friend);
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
                        echo "<li><a href='chat.html?friend=" . $friend->getUsername() . "'>" . $friend->getUsername() . "</a><div class='box'>" . $friend->getUnread() . "</div></li>";
                    }
                }
                ?>
        </div>
    </div>
    <hr>
    <h2>New Requests</h2>

    <form class="flex" action="friendlist.php" method="get">
        <div class="form-list" >
        <ol id="requests">
            <!-- loading friends from $requested that are accepted -->
            <?php
            foreach ($friendList as $friend) {
                if ($friend->getStatus() == "requested") {
                    echo "<li>Friend Request from <b>" . $friend->getUsername() . "</b><div><input type='submit' value='Accept' action='friendlist_accept' id=" . $friend->getUsername() . "><input type='submit' value='Decline' action='friendlist_decline'></div></li>";
                }
            }
            ?>
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
    </form>

    <!--<script src="main.js"></script>
    <script>
        loadFriendList();
    </script>
    -->
</body>

</html>