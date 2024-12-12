<!DOCTYPE html>
<html>
    <head>
        <title>Weiterleitung</title>
    </head>

    <?php
        //Aufgabe 1: Einfache Weiterleitung
        //header("Location: HTML_Kontrollfluesse.php");
        
        //Aufgabe 2: Weiterleitung mit exit Funktion, die die ausführung beendet
        $foo = 12345;
        if($foo == 12345){
            header("Location: HTML_Kontrollfluesse.php");
            exit();
        }
    ?>
    <body>
        <p>Hallo, Welt!</p>
    </body>
</html>