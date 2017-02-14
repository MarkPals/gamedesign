<?php
    
if(isset($_POST["submit"])){
   
    $con = mysqli_connect("localhost", "root", "", "game");
 
    $username = $_POST["username"];
    $score = $_POST["score"];
    
    $sql = "INSERT INTO score (Score, Username)
    VALUES ('" . $score . "', '" . $username . "')";

    if (mysqli_query($con, $sql)) {
    echo "New record created successfully";
    } 
    else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
    
    mysqli_close($con);
}

?>

