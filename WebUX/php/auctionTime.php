<?php

require_once 'config.php';

$htmlOutput = "";

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " .  $mysqli->connect_error);
}

//Select auction currently running from server
$sql = "SELECT * FROM Auction WHERE startTime < now()  and endTime > now()";

$result = $mysqli->query($sql);

$resultArray = '[';
$tempArray= array();

$row=$result->fetch_assoc();
$tempArray = $row;
$resultArray.=json_encode($tempArray);// $tempArray);
$resultArray.=']';
 echo $resultArray;
?>
