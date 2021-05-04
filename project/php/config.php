<?php

$servername = "us-cdbr-east-03.cleardb.com";
$username = "b4556e0ce0f10d";
$password = "788fd875";
$database = "heroku_85ffbe977f09ea2";

$mysqli = new mysqli($servername, $username, $password, $database);

if ($mysqli->connect_error) {
  die("ERROR: ".$mysqli->connect_error);
}


 ?>
