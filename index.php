<!DOCTYPE html>
<HTML>
<HEAD>
<META content="text/html; charset=utf-8" http-equiv="Content-Type" />
<LINK href="style.css" rel="stylesheet" type="text/css" />
<TITLE>Gamepjuh</TITLE>
</HEAD>
<BODY>
    
    <h1>Gamepjuh</h1>
    <div id="test">             <!-- Blok waar de game in komt te staan -->
                                            
<!--                                            Startpagina-->
                <div id="naam">
                    <form action="level.php" method="post">                     <!-- Formulier om naam in te vullen --> 
                    <h2>Naam:</h2>
                    <input required type="text" name="naam" id="naam"><br>
                    <input type="submit" name="submit" id="submit" value="Start de game">
                    </form>
                </div>
    </div>
                                                
<!--    PHP Code om de naam op te slaan in een variabele-->
   <?php
    if(isset($_POST["submit"])) {
    $naam = $_POST["naam"];
    
    }


?> 

 

    
</BODY>
</HTML>