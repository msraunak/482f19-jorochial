
<?php

session_start();

require_once '../config.php';

$_SESSION["insertAdd"] = False;
$htmlOutput = "";

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " .  $mysqli->connect_error);
}

#echo "Connected successfully";
#INSERT INTO `auctionItemTb`(`auctionNameRef`, `itemName`, `description`, `startingBid`, `minimumBidInc`, `donor`, `itemPic`)
$user = array($_POST["ItemAuction"],$_POST["ItemTitle"],$_POST["ItemDescription"],$_POST["ItemStartingBid"],$_POST["ItemMinIncrement"],$_POST["ItemDonor"],$_POST["ItemPicture"]);
#$user = array("hjfranceschi@loyola.edu","Herve","Franceschi","hjfranceschi","password");
# user should be from form
#| hjfranceschi@loyola.edu | Herve | Franceschi | hjfranceschi | password
if ($_POST["newAdminPassword"] == $_POST["newPassword2"]){
  $sql .= 'INSERT INTO auctionItemTb (auctionNameRef, itemName, description, startingBid, minimumBidInc, donor)'; #TODO: add itemPic

  $user[0] = htmlspecialchars(trim($user[0]));
  $user[1] = htmlspecialchars(trim($user[1]));
  $user[2] = htmlspecialchars(trim($user[2]));
  $user[3] = htmlspecialchars(trim($user[3]));
  $user[4] = htmlspecialchars(trim($user[4]));
  $user[5] = htmlspecialchars(trim($user[5]));
#  $user[6] = htmlspecialchars(trim($user[6]));
  $sql .= '("'.$user[0].'","'. $user[1] .'","'. $user[2] .'","'. $user[3] .'","'. $user[4] .'","'. $user[5]. '")';
  $sql .= ";";
  #echo $sql;
  if ($mysqli->query($sql) === TRUE) {
      $htmlOutput .= "Item added successfully";
  }
  else{
    $htmlOutput .= "Insertion Failed: ". $mysqli->error;

  }
  #echo $htmlOutput;
  $_SESSION["insertAdd"] = True;
}
else {
  #echo "vaildation fail";
  $_SESSION["insertAdd"] = False;
}
$htmlOutput = " Username: ".$user[3];
$_SESSION["itemMessage"] = $htmlOutput;
header("Location: http://jorochial.cs.loyola.edu/html/DashboardPage.php");
exit;
?>
