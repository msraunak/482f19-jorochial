<?php

require_once 'config.php';

$htmlOutput = "";

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " .  $mysqli->connect_error);
}

#echo "Connected successfully";
$bid = array($_GET["username"],$_GET["amount"],$_GET["itemId"]);

$sql = "SELECT ItemName FROM Item WHERE id = ". $_GET["itemId"];

$result = $mysqli->query($sql);
$row = $result->fetch_assoc();

$itemName = $row["ItemName"];

  $sql = 'INSERT INTO Bids (bidderUName, amount, itemId, ItemName) VALUES';

  $bid[0] = htmlspecialchars(trim($bid[0]));
  $bid[1] = htmlspecialchars(trim($bid[1]));
  $bid[2] = htmlspecialchars(trim($bid[2]));
  $sql .= '("'.$bid[0].'",'. $bid[1] .','. $bid[2] .',"'. $itemName .'")';
  $sql .= ";";
  echo $sql;
  if ($mysqli->query($sql) === TRUE) {
      $htmlOutput .= "Success";
  }
  else{
    $htmlOutput .= "Failed ". $mysqli->error;

  }
  $sql = "SELECT max(amount) FROM Bids WHERE itemId = ". $_GET["itemId"];
  $result = $mysqli->query($sql);
  echo $mysqli->error;
  $row = $result->fetch_assoc();


  $sql = "Update Item set currentBid = ".$row["max(amount)"]." WHERE itemId = ". $_GET["itemId"];
  $result = $mysqli->query($sql);
  echo $mysqli->error;
  if ($mysqli->query($sql) === TRUE) {
      $htmlOutput .= "Success update";
  }
  else{
    $htmlOutput .= "Failed ". $mysqli->error;

  }



  echo $htmlOutput;

?>
