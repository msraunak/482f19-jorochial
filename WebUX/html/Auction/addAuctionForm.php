<?php

<?php

session_start();
if(!isset($_SESSION["login"]) || $_SESSION["login"] !== true){
  //if not login in
  $_SESSION["secure_Attempt"] = true;
  header("location: ../index.php");
  exit();
}
require_once '../config.php';

$_SESSION["auctionNotice"] = False;
$htmlOutput = "";

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " .  $mysqli->connect_error);
}

#echo "Connected successfully";
#INSERT INTO `Auction`(`auctionNameRef`, `auctionName`, `description`, `startingBid`, `minimumBidInc`, `donorName`, `auctionPic`)
$auction = array($_POST["AuctionTitle"],$_POST["AuctionDescription"],$_POST["AuctionCharity"],$_POST["StartDateTime"],$_POST["EndDateTime"]);
#$auction = array("hjfranceschi@loyola.edu","Herve","Franceschi","hjfranceschi","password");
# user should be from form
#| hjfranceschi@loyola.edu | Herve | Franceschi | hjfranceschi | password


  $sql .= 'INSERT INTO Auction (auctionName, description, beneficiary, startTime, endTime) VALUES'; #TODO: add auctionPic

  $auction[0] = htmlspecialchars($auction[0]);
  $auction[1] = htmlspecialchars(trim($auction[1]));
  $auction[2] = htmlspecialchars(trim($auction[2]));
  $auction[3] = htmlspecialchars(trim($auction[3]));
  $auction[4] = htmlspecialchars(trim($auction[4]));
#  $auction[6] = htmlspecialchars(trim($auction[6]));
  $sql .= '("'.$auction[0].'","'. $auction[1] .'","'. $auction[2] .'","'. $auction[3] .'","'. $auction[4] .'","'. $auction[5]. '")';
  $sql .= ";";
  #echo $sql;
  if ($mysqli->query($sql) === TRUE) {
      $htmlOutput .= "Auction added successfully";
  }
  else{
    $htmlOutput .= "Insertion Failed: ".$sql. $mysqli->error;

  }
  #echo $htmlOutput;
  $_SESSION["auctionNotice"] = True;

else {
  #echo "vaildation fail";
  $_SESSION["auctionNotice"] = False;
}
$htmlOutput .= " Auction: ".$auction[1];
$_SESSION["auctionMessage"] = $htmlOutput;
header("Location: http://jorochial.cs.loyola.edu/html/Auction/AuctionDashboard.php");
exit;
?>
