<?php

require_once 'config.php';

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " .  $mysqli->connect_error);
}

//retrieve user entered information from form
$username = "";


if (isset($_GET['username'])) {
  $username = htmlspecialchars(trim($_GET['username']));

  //get information from Database
  $sql = "SELECT * FROM Bids WHERE itemId not in (SELECT itemId FROM Bids WHERE bidderUName = '$username' group by itemId having amount = max(amount)) and bidderUName = '$username ';";

  $result = $mysqli->query($sql);
  echo $mysqli->error;
  //$sql = "SELECT itemId, ItemName, max(amount) as amount FROM Bids WHERE BidderUName = '$username' group by itemId";
  //$result2 = $mysqli->query($sql);
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
$mysqli->close();
?>
