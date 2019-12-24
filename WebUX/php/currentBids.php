<?php

// YOU NEED TO ADD COMMENTS TO THESE FILES TOO!!!

require_once 'config.php';

$htmlOutput = "";

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " .  $mysqli->connect_error);
}


  if (isset($_GET['username'])) {
    $username = htmlspecialchars(trim($_GET['username']));

  //get information from Database
  //SELECT itemId, Bids.ItemName, imageMime, imageData, max(amount) FROM Bids, Item WHERE BidderUName = 'hfranceschi' and Item.id = Bids.itemId group by itemId
  //$sql = "SELECT itemId, Bids.ItemName, imageMime, imageData, max(amount) FROM Bids, Item WHERE BidderUName = '$username' and Item.id = Bids.itemId group by itemId";
  $sql = "SELECT itemId, ItemName, max(amount) as amount FROM Bids WHERE BidderUName = '$username' group by itemId";

      $result = $mysqli->query($sql);
    echo $mysqli->error;
    if ($result->num_rows > 0) {

      $resultArray = '[';
      $tempArray= array();

      while($row=$result->fetch_assoc())
      {
      $tempArray = $row;
      $resultArray.=json_encode($tempArray).',';// $tempArray);
      echo $resultsArray;
      }

      $resultArray = substr($resultArray, 0, -1);
      $resultArray.=']';
       echo $resultArray;
  }
  }


  echo $htmlOutput;

?>
