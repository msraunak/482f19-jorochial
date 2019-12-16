<?php

require_once 'config.php';

$htmlOutput = "";

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " .  $mysqli->connect_error);
}

#echo "Connected successfully";
$bid = array($_GET["username"],$_GET["itemId"],$_GET["amount"]);

$sql = "SELECT ItemName FROM Item WHERE id = ". $_GET["itemId"];

$result = $mysqli->query($sql);
$row = $result->fetch_assoc();

$itemName = $row["ItemName"];

  $sql .= 'INSERT INTO jorochial.Bids (bidderUName, amount, itemId,) VALUES';

  $bid[0] = htmlspecialchars(trim($bid[0]));
  $bid[1] = htmlspecialchars(trim($bid[1]));
  $bid[2] = htmlspecialchars(trim($bid[2]));
  $bid[3] = $itemName;
  $sql .= '("'.$bid[0].'",'. $bid[1] .','. $bid[2] .',"'. $bid[3] .'")';
  $sql .= ";";
  #echo $sql;
  if ($mysqli->query($sql) === TRUE) {
      $htmlOutput .= "Success";
  }
  else{
    $htmlOutput .= "Failed ". $mysqli->error;

  }
  echo $htmlOutput;

?>
