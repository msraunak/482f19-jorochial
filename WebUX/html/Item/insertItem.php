
<?php

session_start();
if(!isset($_SESSION["login"]) || $_SESSION["login"] !== true){
  //if not login in
  $_SESSION["secure_Attempt"] = true;
  header("location: ../index.php");
  exit();
}
require_once '../config.php';

$_SESSION["itemNotice"] = False;
$htmlOutput = "";

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " .  $mysqli->connect_error);
}

#echo "Connected successfully";
#INSERT INTO `Item`(`auctionNameRef`, `itemName`, `description`, `startingBid`, `minimumBidInc`, `donorName`, `itemPic`)
$item = array($_POST["ItemAuction"],$_POST["ItemTitle"],$_POST["ItemDescription"],$_POST["ItemStartingBid"],$_POST["ItemMinIncrement"],$_POST["ItemDonor"]);
#$item = array("hjfranceschi@loyola.edu","Herve","Franceschi","hjfranceschi","password");
# user should be from form
#| hjfranceschi@loyola.edu | Herve | Franceschi | hjfranceschi | password
if (true){

  $sql .= 'INSERT INTO Item (auctionNameRef, itemName, description, startingBid, minimumBidInc, donorName, imageName, imageMime, imageData) VALUES'; #TODO: add itemPic

  $item[0] = htmlspecialchars($item[0]);
  $item[1] = htmlspecialchars(trim($item[1]));
  $item[2] = htmlspecialchars(trim($item[2]));
  $item[3] = htmlspecialchars(trim($item[3]));
  $item[4] = htmlspecialchars(trim($item[4]));
  $item[5] = htmlspecialchars($item[5]);
#  $item[6] = htmlspecialchars(trim($item[6]));
  //$sql .= '("'.$item[0].'","'. $item[1] .'","'. $item[2] .'",'. $item[3] .','. $item[4] .',"'. $item[5]. '")';
  $filefullname = $_FILES['myfile']['name'];
  $filetype = $_FILES['myfile']['type'];
  $filedata = file_get_contents($_FILES['myfile']['tmp_name']);

  $sql .= "\"(\" $item[0] \",\" $item[1] \",\" $item[2] \", $item[3] , $item[4] ,\" $item[5] \",\" $filefullname \",\" $filetype \"";
  $sql .= ",\" $filedata\");";
  echo sql; 
  if ($item[5] == "null"){
    $sql = "INSERT INTO Item (auctionNameRef, itemName, description, startingBid, minimumBidInc) VALUES (\"$item[0]\",\" $item[1] \",\" $item[2] \", $item[3] , $item[4] )";
    $sql .= ";";
  }
  #echo $sql;
  if ($mysqli->query($sql) === TRUE) {
      $htmlOutput .= "Item added successfully";
  }
  else{
    $htmlOutput .= "Insertion Failed: ".$sql. $mysqli->error;

  }
  #echo $htmlOutput;
  $_SESSION["itemNotice"] = True;
}
else {
  #echo "vaildation fail";
  $_SESSION["itemNotice"] = False;
}
$htmlOutput .= " Item: ".$item[1];
$_SESSION["itemMessage"] = $htmlOutput;
header("Location: http://jorochial.cs.loyola.edu/html/Item/DashboardPage.php");
exit;
?>
