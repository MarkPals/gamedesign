<!DOCTYPE html>
<HTML>
<HEAD>
<META content="text/html; charset=utf-8" http-equiv="Content-Type" />
<LINK href="style.css" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Pangolin" rel="stylesheet">
<TITLE>SRDA</TITLE>
</HEAD>
<BODY>
    
    <h1 class="title">Steves riding dildo adventure</h1>
    <div id="test">             <!-- Blok waar de game in komt te staan -->
                                            
<!--                                            Startpagina-->
                <div id="naam">
                    <form action="level.php" method="post">                     <!-- Formulier om naam in te vullen --> 
                    <h2>Player name:</h2>
                    <input required type="text" name="naam" id="naam"><br>
                    <input type="submit" name="submit" id="submit" value="Start game">
                    </form>
                    <div class="credits_container">
    					<p class="credits_title">Credits</p>
    					<ul class="credits">
	    					<li>Niels van Faassen</li>
	    					<li>Mark Pals</li>
					    	<li>Ramon Dubbink</li>
					    	<li>Lars Hofsink</li>
					    	<li>Jeroen Mager</li>
					    	<li>Stijn ter Keurs</li>
    					</ul>
    				</div>
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