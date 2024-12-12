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

    //Anweisung 2: die Liste ordentlich anzugeben
    /*foreach($list as $value) {
        echo "<p>".$value."</p>";
        }*/
    
    //Anweisung 3: Unterbrechen des PHP Blocks 
    /*foreach($list	as	$value)	{
    ?>
	<p><?php echo $value; ?></p>

	<?php	
	    }*/
	?>
    <!--Anweisung 4: Vereinfachung der Augabe-->
    <?php foreach($list as $value){ ?>
    <p><?php echo $value; ?></p>
    <?php }?>

</body>
<!--	...	-->

</html>