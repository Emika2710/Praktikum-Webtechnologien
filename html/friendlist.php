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



<!DOCTYPE html>
<html lang="en">

<head>
    <!--<link rel="stylesheet" href="style.css"> -->
    <meta charset="UTF-8" />
    <title>Friendlist</title>

    
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
                    <h1>Friends</h1>
                </div>

                <!-- Navigation -->
                <div class="row my-3 mb-5">
                    <div class="col-5">
                        <div class="btn-group" role="group">
                            <a href="logout.php" class="btn btn-secondary">< Logout</a>
                            <button type="button" class="btn btn-secondary">Edit Profil</button>
                        </div>
                    </div>
                </div>

                <hr>

                <!-- Friendlist -->
                <div class="row my-4">
                    <ul class="list-group" id="friendslist">
                        <!-- loading friends from friendList -->
                        <a href="#" class="list-group-item list-group-item-action text-secondary">loading friends</a>
                    </ul>
                </div>

                <hr>

                <!-- New Requests -->
                
                <div class="row my-4">
                    <ol class="list-group" id="requests">
                        <!-- loading friends from requested that are accepted-->
                        <li class="list-group-item text-secondary">loading friend requests</li>
                    </ol>
                </div>

                <hr>

                <div class="row my-4">
                    <form method="post" class="form-group ps-0">   
                        <div class="btn-group col-12 " type="group">
                            <input type="text" class="form-control" placeholder="Add Friend to List" name="NewFriend" id="friend-request-name" list="friend-selector">
                            <datalist id="friend-selector">
                            </datalist>
                            <button type="submit" class="btn btn-primary" name="action" value="Add">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
        } else {
            echo "This User doesn't exist";
        }
    }
    ?>
    
    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>    

    <script src="main.js"></script>
    <script>
        loadFriendList();
        loadUser();
    </script>
</body>

</html>

<?php
/*

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

*/
?>