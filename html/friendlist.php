<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8" />
    <title>Friendlist</title>

    
    <!-- Bootstrap CSS -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-+qdLaIRZfNu4cVPK/PxJJEy0B0f3Ugv8i482AKY7gwXwhaCroABd086ybrVKTa0q" crossorigin="anonymous">
    
</head>

<body>
    <?php
        require "start.php";
        if(!isset($_SESSION['user'])) {
            header("Location: login.php");
            exit();
        }

        // wie lade ich jetzt die Freunde in regelmäßigen Abständen neu?
        $friendList = $service->loadFriends();
        //updateFriends($friendlist);
        
        // friendList in Console ausgeben
        echo "<script>console.log(" . json_encode($friendList) . ");</script>";

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
                <!-- loading friends from $friendList -->
            </ul>
        </div>
    </div>
    <hr>
    <h2>New Requests</h2>

    <form class="flex"  method="post">
        <div class="form-list" >
        <ol id="requests">
            <!-- loading friends from $requested that are accepted-->
        </ol>
        </div>
    </form>
    <hr>
        
    </form>
    <form method="post">

        <input type="text" placeholder="Add Friend to List" name="NewFriend" id="friend-request-name" list="friend-selector">
        <datalist id="friend-selector">
            <?php
            $userList = $service->loadUsers();
            echo "<script>console.log(" . json_encode($userList) . ");</script>";

            foreach($userList as $value) { ?>
                <option><?= $value; ?></option>
            <?php } ?>
        </datalist>
        <input type="submit" name="action" value="Add" onclick="loadFriendList()">


    <?php
     
    //Neue Freundschaftsanfrage
    if (isset($_POST["action"]) && $_POST["action"] == "Add") {

        // Auslesen der input Zeile
        $possibleFriend = isset($_POST["NewFriend"]) ? $_POST["NewFriend"] : "";

        // prüfen, ob der Nutzer existiert
        if ($service->userExists($possibleFriend)) {

            $newFriend = new Model\Friend($possibleFriend);
            if(!$service->friendRequest($newFriend)) {
                echo "Failed to send friend request";
            }

            // Das Problem liegt im Backend. Ich konnte es bis zu HttpClient tracken, wo beim absenden der Anfrage "aud Position 0 ein unerwartetes " ist...
            // Er scheint nicht die richtige URL zu finden

        } else {
            echo "This User doesn't exist";
        }

    }
    ?>

    </form>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>    

    <script src="main.js"></script>
    <script>
        loadFriendList();
    </script>
</body>

</html>