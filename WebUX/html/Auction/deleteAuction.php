<?php
session_start();
if(!isset($_SESSION["login"]) || $_SESSION["login"] !== true){
  //if not login in
  $_SESSION["secure_Attempt"] = true;
  header("location: ../index.php");
  exit();
}
require_once '../config.php';

$htmlOutput = "";
$_SESSION["auctionNotice"] == false;
$_SESSION["auctionMessage"] = "";

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " .  $mysqli->connect_error);
}
$sql = "DELETE from Auction where id = ".$_POST["auctionId"];

if ($mysqli->query($sql) === TRUE) {
    $htmlOutput .= "Auction deleted successfully";
    $_SESSION["auctionNotice"] == true;
}
else{
  $htmlOutput .= "Deletion Failed: ". $mysqli->error;
  $_SESSION["auctionNotice"] == false;
}

$_SESSION["auctionMessage"] = $htmlOutput;
header("Location: http://jorochial.cs.loyola.edu/html/Auction/AuctionDashboard.php");
exit;

 ?>
