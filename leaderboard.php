<!DOCTYPE html>
<HTML>
<HEAD>
<META content="text/html; charset=utf-8" http-equiv="Content-Type" />
<LINK href="lead_style.css" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Pangolin" rel="stylesheet">
<TITLE>SRDA</TITLE>
</HEAD>
<BODY>
	<h1 class="title">Steves riding dildo adventure</h1>
    <div id="test">             <!-- Blok waar de game in komt te staan -->
                                            
<!--                                            Startpagina-->
	<div id="dick">
		<img src="web_img/dick.gif" style="width: 100px; height: 100px; margin-left: ; margin-top: 2.5%; float: left;">
	</div>
	<div id="dick2">
		<img src="web_img/dick2.gif" style="width: 100px; height: 100px; margin-right: 22%; margin-top: 2.2%; float: right;">
	</div>
		<div id="naam">
			<br><br><h2>Leaderboard!</h2><br><br>
			<table style="width:100%">
			  <tr>
			    <th>Naam</th>
			    <th>Score</th> 
			  </tr>
			  <tr>
			    <td>Jill</td>
			    <td>30</td> 
			  </tr>
			  <tr>
			    <td>Eve</td>
			    <td>30</td> 
			  </tr>
			</table>
			<form action="index.php">
				<input name="Terug" type="button"  onclick="location.href='index.php'" id="terug" value="terug">
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