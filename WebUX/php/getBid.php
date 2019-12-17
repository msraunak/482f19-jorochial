<?php

require_once 'config.php';

$htmlOutput = "";

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " .  $mysqli->connect_error);
}

#echo "Connected successfully";
$sql = "SELECT max(amount) as amount FROM Bids WHERE itemId = ". $_GET["itemId"];
$result = $mysqli->query($sql);
echo $mysqli->error;
$row = $result->fetch_assoc();

$resultArray = '[';
$tempArray= array();

$tempArray = $row;
$resultArray.=json_encode($tempArray).',';// $tempArray);

$resultArray = substr($resultArray, 0, -1);
$resultArray.=']';
 echo $resultArray;

?>
