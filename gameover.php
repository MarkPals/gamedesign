<!DOCTYPE html>
<HTML>
<HEAD>
<META content="text/html; charset=utf-8" http-equiv="Content-Type" />
<LINK href="style.css" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Pangolin" rel="stylesheet">
<TITLE>SRDA</TITLE>
</HEAD>
<BODY>
<h1>Game over :(</h1>
<div align="center">
<input type="button" onclick="location.href='leaderboard.php'" name="leaderboard" id="leaderboard" value="leaderboard">
<input type="button" onclick="location.href='index.php'" name="leaderboard" id="leaderboard" value="Retry">
</div>
<?php 
	
	/*!!!!! Resultaten !!!!!!*/
    $resultaat =  $_GET['score'];
    $resultaatencoded = preg_replace("/[^0-9,.]/", "", $resultaat);
    $result = $resultaatencoded - 100;
    $result1 = substr_replace($result, "", -4);
    echo "<center><br><b>Jouw score: <font color='red'>" . $result1 . "</font></center>";

    $resultaatNaam = $_GET['naam'];
    echo "<center><b><br>Jouw gebruikersnaam: <font color='red'>" . $resultaatNaam . "</font></center>";
    //echo $_POST['fn'];
    //echo "<script>alert($result1);</script>";


	/*MySQL Stuff*/
		//print_r(PDO::getAvailableDrivers());
        $dbhost = "localhost";
        $dbname = "game";
        $user = "root";
        $pass = "";	
		try {
			$database = new
			PDO("mysql:host=$dbhost;dbname=$dbname",$user,$pass);
			$database->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			//echo "<br />Verbinding gemaakt";
		}
		catch(PDOException $e) {
			echo $e->getMessage();
			echo "<br /><font color='red'><b>KAN GEEN VERBINDING MAKEN MET DE DATABASE! Score niet opgeslagen!</b></font>";
		}

		$query = "SELECT * FROM score";
		$insert = $database->prepare($query);
		try {
			$insert->execute();
			$insert->setFetchMode(PDO::FETCH_ASSOC);
			foreach($insert as $ins) {
				$username = $ins["username"];
				$score = $ins["gamescore"];
			}
		}
		catch(PDOException $e) {
			echo "tekst niet opgehaald";
			echo $e->getMessage();
		}

		$scoremax = $score + 25;
		$scoremin = $score -25;
		if($username == $resultaatNaam && $result1 < $scoremax && $result1 > $scoremin) {
			exit;	
		}
		$query = "INSERT INTO score (gamescore, username) values (?, ?)";
		$insert = $database->prepare($query);
		$data = array($result1, $resultaatNaam); //result 1 = gamescore resultaatNaam = naam van speler

		try {
			$insert->execute($data);
			echo "<center><br><font color='red'> ༼ᕗຈل͜ຈ༽ᕗ</font><font color='lime'><b>Gamescore toegevoegd aan de leaderboard! </b></font><font color='red'> ༼ᕗຈل͜ຈ༽ᕗ</font></center>";
		}
		catch(PDOException $e) {
			echo "<center><font color='red'><br><b>Gamescore niet toegevoegd aan de leaderboard. Contact de systeembeheerder voor verdere instructies.</b></font></center>";
			echo $e->getMessage();
		}
?>
</HTML>