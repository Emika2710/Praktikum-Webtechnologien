<!DOCTYPE html>
<html>

<head>
    <title>Generieren von HTML in Kontrollflüssen</title>
</head>

<?php
    $list=array(1,	2,	3,	4,	5);
?>
<!--	...	-->

<body>
    <?php
    //Anweisung 1: Liste irgendwie ausgeben
    //var_dump($list);
    foreach($list as $value) {
        echo "<p>".$value."</p>";
        }
    ?>
</body>
<!--	...	-->

</html>