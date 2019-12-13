<?php
session_start();
require_once '../config.php';

$htmlOutput = "";
$_SESSION["donorNotice"] == false;
$_SESSION["donorMessage"] = "";

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " .  $mysqli->connect_error);
}
$sql = "DELETE from Donor where donorId = ".$_POST["donorId"];

if ($mysqli->query($sql) === TRUE) {
    $htmlOutput .= "Donor deleted successfully";
    $_SESSION["donorNotice"] == true;
}
else{
  $htmlOutput .= "Deletion Failed: ". $mysqli->error;
  $_SESSION["donorNotice"] == false;
}

$_SESSION["donorMessage"] = $htmlOutput;
header("Location: http://jorochial.cs.loyola.edu/html/Donor/DonorsDashboard.php");
exit;

 ?>
