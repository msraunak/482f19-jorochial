<?php

//Database components
const DB_HOST = 'cs-database.cs.loyola.edu';
const DB_USER = 'arschilke';
const DB_PASS = '1737341';
const DB_NAME = 'jorochial';
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($mysqli->connect_error) {
    die("Connection failed: " .  $mysqli->connect_error);
}

//User input for id
$userIdRequest = $_GET['id'];

//Queries database
$sqlIdStatement = "select imageData from Item where id = '$userIdRequest' LIMIT 1";
$result = $mysqli->query($sqlIdStatement);

while ($row = $result->fetch_assoc()) {
  $imageDataString = $row['imageData'];
}

echo $imageDataString;

$mysqli->close();
 ?>
