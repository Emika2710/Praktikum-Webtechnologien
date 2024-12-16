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

    <script src="main.js"></script>
    <script>
        loadFriendList();
    </script>
</body>

</html>