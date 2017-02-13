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
                    <form action="" method="post">
                    <h2>Naam:</h2>
                    <input type="text" id="naam"><br>
                    <input type="button" type="submit" id="submit" value="Start de game">
                    </form>
                </div>
                
    </div>

        <!--
   <canvas id="test">
       
   </canvas>
    
-->

    
<?php
if(isset($_POST["submit"])) {
    $naam = $_POST["naam"];
    echo $naam; 
}


?>
    
</BODY>
</HTML>