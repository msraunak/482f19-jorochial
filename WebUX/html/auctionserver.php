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

$resultArray =  json_encode(($result->fetch_assoc()));
echo $resultArray;
?>
