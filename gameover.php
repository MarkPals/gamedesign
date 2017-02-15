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
    echo $_POST[$score];
?>
</HTML>