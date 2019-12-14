<?php
session_start();
require_once '../config.php';

$htmlOutput = "";
$_SESSION["charityNotice"] == false;
$_SESSION["charityMessage"] = "";

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " .  $mysqli->connect_error);
}
$sql = "DELETE from Charity where charityId = ".$_POST["charityId"];

if ($mysqli->query($sql) === TRUE) {
    $htmlOutput .= "Charity deleted successfully";
    $_SESSION["charityNotice"] == true;
}
else{
  $htmlOutput .= "Deletion Failed: ". $mysqli->error;
  $_SESSION["charityNotice"] == false;
}

$_SESSION["charityMessage"] = $htmlOutput;
header("Location: http://jorochial.cs.loyola.edu/html/Charity/CharitiesDashboard.php");
exit;

 ?>
