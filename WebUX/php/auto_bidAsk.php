<?php

require_once 'config.php';

$htmlOutput = "";

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " .  $mysqli->connect_error);
}

#echo "Connected successfully";
$bid = $_GET["itemId"];

$sql = "SELECT currentBid, minimumBidInc as minInc FROM Item WHERE id = ". $_GET["itemId"];

$result = $mysqli->query($sql);

$resultArray = '[';
$tempArray= array();

$row=$result->fetch_assoc();

$tempArray = $row;
$resultArray.=json_encode($tempArray).',';// $tempArray);



$resultArray = substr($resultArray, 0, -1);
$resultArray.=']';
 echo $resultArray;

?>
