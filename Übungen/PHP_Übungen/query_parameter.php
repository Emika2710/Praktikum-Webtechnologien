<!DOCTYPE html>
<html>

<head>
    <title>Query Parameter Test</title>
</head>

<body>
    <!--erster Test, ob überhaupt ein Wert angegeben wird, wenn man test=1234 anfügt-->
    <?php 
    // echo	$_GET["test"];
    ?>
    
    <?php
    if (isset($_GET["test"])) {
        if (!empty($_GET["test"])) {
            echo "Wert:	" . $_GET["test"];
        } else {
            echo "Kein	Wert!";
        }
    } else {
        echo "Kein	Parameter	übergeben";
    }
    ?>
</body>

</html>