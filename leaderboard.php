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
			<br><br><h2>Leaderboard!</h2><br>
			<table style="width:100%">
			  <tr>
                  <th>Plaats</th>
			    <th>Naam</th>
			    <th>Score</th>

			  </tr>
                <?php
                $dbhost = "localhost";
                $dbname = "game";
                $user = "root";
                $pass = "";
                try {
                    $database = new
                    PDO("mysql:host=$dbhost;dbname=$dbname", $user, $pass);
                    $database->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION );
//                    echo "<br>Verbinding gemaakt";
                } catch(PDOException $e) {
                    echo $e->getMessage();
                    echo "<br>Verbinding niet gemaakt";
                }

                $query = "SELECT * FROM score ORDER BY gamescore DESC LIMIT 10";

                $insert = $database->prepare($query);
                $insert->setFetchMode(PDO::FETCH_ASSOC);
                try {
                    $insert->execute(array());
//                    echo "<script>alert('leaderboard geladen.');</script>";
                } catch(PDOException $e) {
                    echo $e->getMessage();
                    echo "<script>alert('Verbinding niet gemaakt');</script>";
                }
                $i = 0;
                foreach ($insert as $ins) {
                    $i++;
                    echo "<tr>
                                <td>$i.</td>
                                <td>" . $ins['username'] . "</td>
                                <td>" . $ins['gamescore'] ."</td>
                          </tr>";
                }

                ?>
			</table>
			<form action="index.php">
				<input name="Terug" type="button"  onclick="location.href='index.php'" id="terug" value="terug">
			</form>
        </div>
    </div>
                                                
<!--    PHP Code om de naam op te slaan in een variabele-->

</BODY>
</HTML>