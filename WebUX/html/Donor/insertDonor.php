
<?php

session_start();

require_once '../config.php';

$_SESSION["donorNotice"] = False;
$htmlOutput = "";

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " .  $mysqli->connect_error);
}

#echo "Connected successfully";
#INSERT INTO `Item`(`auctionNameRef`, `itemName`, `description`, `startingBid`, `minimumBidInc`, `donorName`, `itemPic`)

$donor = array($_POST["OrgName"],$_POST["RepName"],$_POST["PhoneNumber"],$_POST["email"],$_POST["Address"]);
#$donor = array("hjfranceschi@loyola.edu","Herve","Franceschi","hjfranceschi","password");
# user should be from form
#| hjfranceschi@loyola.edu | Herve | Franceschi | hjfranceschi | password


  $sql .= 'INSERT INTO Donor (orgName, repName, phoneNum, email, address) VALUES'; #TODO: add itemPic

  $donor[0] = htmlspecialchars(trim($donor[0]));
  $donor[1] = htmlspecialchars(trim($donor[1]));
  $donor[2] = htmlspecialchars(trim($donor[2]));
  $donor[3] = htmlspecialchars(trim($donor[3]));
  $donor[4] = htmlspecialchars(trim($donor[4]));
  $sql .= '("'.$donor[0].'","'.$donor[1].'","'.$donor[2].'","'.$donor[3].'","'.$donor[4].'")';
  $sql .= ";";
  if ($mysqli->query($sql) === TRUE) {
      $htmlOutput .= "Donor added successfully";
  }
  else{
    $htmlOutput .= "Insertion Failed: ".$sql. $mysqli->error;

  }
  $_SESSION["donorNotice"] = True;

$htmlOutput .= " Donor: ".$donor[1];
$_SESSION["donorMessage"] = $htmlOutput;
header("Location: http://jorochial.cs.loyola.edu/html/Donor/DonorsDashboard.php");
exit;
?>
