<!DOCTYPE html>
<html>
    <head>
        <title>Formulardatenverarbeitung</title>
    </head> 
    <?php
    $testWert= "";
    if(isset($_POST['test']))	{	
		$testWert=$_POST['test'];
 }
 ?>
    <body>
        <!--<form method="get" action="test.php">
        <form method="post" action="test.php">
            <input name="test">
            <input name="test" value="<?php if(isset($_POST['test'])){echo $_POST['test'];}?>">
            Erster Button
            <button type="submit">Absenden</button>
            
            <button type="submit" name="action"	value="foo1">Absenden</button>
            
            Weitere Buttons
            <button	type="submit" name="action" value="foo1">Absenden1</button>
            <button	type="submit" name="action" value="foo2">Absenden2</button>
            <button	type="submit" name="bar" value="foo3">Absenden3</button>
        </form> -->
        <form	method="post"	action="test.php">
			<input	name="test"	value="<?=	$testWert;	?>">
			<button	type="submit" name="action" value="foo1">Absenden1</button>
			<button	type="submit" name="action" value="foo2">Absenden2</button>
			<button	type="submit" name="bar" value="foo3">Absenden3</button>
		</form>
		<?php	var_dump($_POST);	?>
        </body> 
</html>