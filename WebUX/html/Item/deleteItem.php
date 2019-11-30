<?php

require_once '../config.php';

$htmlOutput = "";

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " .  $mysqli->connect_error);
}
$sql = "DELETE from auctionItemTb where id = ". $_POST["id"];

if ($mysqli->query($sql) === TRUE) {
    $htmlOutput .= "Item deleted successfully";
}
else{
  $htmlOutput .= "Deletion Failed: ". $mysqli->error;
}




 ?>
