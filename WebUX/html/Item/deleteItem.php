<?php
session_start();
require_once '../config.php';

$htmlOutput = "";
$_SESSION["itemNotice"] == false;

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " .  $mysqli->connect_error);
}
$sql = "DELETE from Item where id = ".$_POST["itemId"];

if ($mysqli->query($sql) === TRUE) {
    $htmlOutput .= "Item deleted successfully";
    $_SESSION["itemNotice"] == true;
}
else{
  $htmlOutput .= "Deletion Failed: ". $mysqli->error;
  $_SESSION["itemNotice"] == false;
}

$_SESSION["itemMessage"] = $htmlOutput;
header("Location: http://jorochial.cs.loyola.edu/html/Item/DashboardPage.php");
exit;

 ?>
