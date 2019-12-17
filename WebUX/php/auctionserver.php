<?php
require_once 'config.php';
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
//Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " .  $mysqli->connect_error);
}

$sql = "SELECT id,itemName, description, startingBid, minimumBidInc, currentBid, donorName FROM Item order by itemName;";
$result = $mysqli->query($sql);

$resultArray = '[';
$tempArray= array();
echo $resultArray;
while($row=$result->fetch_assoc())
{
$tempArray = $row;
$resultArray=json_encode($tempArray).',';// $tempArray);
echo $resultArray;
}

$resultArray = substr($resultArray, 0, -1);
$resultArray.=']';
 echo $resultArray;
//echo $resultArray;
?>
