<?php
require_once 'config.php';
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
//Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " .  $mysqli->connect_error);
}

// Select all of our stocks from table 'stock_tracker'
$sql = "SELECT * FROM Item";
//there is no stock_tracker table what are
$result = $mysqli->query($sql);

$resultArray = '{ "items": [';
$tempArray= array();

//test
//echo json_encode($result->fetch_assoc());
//echo json_encode($result->fetch_assoc());
//$row =0;
while($row=$result->fetch_assoc())
{
$tempArray = $row;
//echo json_encode($tempArray);
//echo json_encode($result->fetch_assoc());
//array_push($resultArray, $tempArray)
$resultArray.=json_encode($tempArray).',';// $tempArray);
echo $resultsArray;
}

$resultArray = substr($resultArray, 0, -1);
$resultArray.=']}';
 echo $resultArray;
//echo $resultArray;
?>
