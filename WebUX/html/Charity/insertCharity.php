
<?php

session_start();

require_once '../config.php';

$_SESSION["charityNotice"] = False;
$htmlOutput = "";

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " .  $mysqli->connect_error);
}

#echo "Connected successfully";
#INSERT INTO `Item`(`auctionNameRef`, `itemName`, `description`, `startingBid`, `minimumBidInc`, `charityName`, `itemPic`)

$charity = array($_POST["OrgName"],$_POST["RepName"],$_POST["PhoneNumber"],$_POST["email"],$_POST["Address"]);
#$charity = array("hjfranceschi@loyola.edu","Herve","Franceschi","hjfranceschi","password");
# user should be from form
#| hjfranceschi@loyola.edu | Herve | Franceschi | hjfranceschi | password


  $sql .= 'INSERT INTO Charity (orgName, repName, phoneNumber, email, address) VALUES'; #TODO: add itemPic

  $charity[0] = htmlspecialchars(trim($charity[0]));
  $charity[1] = htmlspecialchars(trim($charity[1]));
  $charity[2] = htmlspecialchars(trim($charity[2]));
  $charity[3] = htmlspecialchars(trim($charity[3]));
  $charity[4] = htmlspecialchars(trim($charity[4]));
  $sql .= '("'.$charity[0].'","'.$charity[1].'","'.$charity[2].'","'.$charity[3].'","'.$charity[4].'")';
  $sql .= ";";
  if ($mysqli->query($sql) === TRUE) {
      $htmlOutput .= "Charity added successfully";
  }
  else{
    $htmlOutput .= "Insertion Failed: ".$sql. $mysqli->error;

  }
  $_SESSION["charityNotice"] = True;

$htmlOutput .= " Charity: ".$charity[1];
$_SESSION["charityMessage"] = $htmlOutput;
header("Location: http://jorochial.cs.loyola.edu/html/Charity/CharitiesDashboard.php");
exit;
?>
