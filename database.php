<?php
    
if(isset($_POST["submit"])){

    $dbhost = "localhost";
    $dbname = "game";
    $user = "root";
    $pass = "";
    try {
        $database = new
        PDO("mysql:host=$dbhost;dbname=$dbname", $user, $pass);
        $database->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION );
        echo "<br>Verbinding gemaakt";
    } catch(PDOException $e) {
        echo $e->getMessage();
        echo "<br>Verbinding niet gemaakt";
    }

    $username = $_POST["username"];
    $score = $_POST["score"];


    $query = "INSERT INTO score (gamescore, username) VALUES (?, ?)";

    $insert = $database->prepare($query);
    $data = array($score, $username);

    try {
        $insert->execute($data);
        echo "<script>alert('Album toegevoegd.');</script>";
    } catch(PDOException $e) {
        echo $e->getMessage();
        echo "<br>Verbinding niet gemaakt";
    }
}

?>

