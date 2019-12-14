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
    $_SESSION["charityNotice"] = false;
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " .  $mysqli->connect_error);
    }

    #echo "Connected successfully";
    #UPDATE INTO `Charity`(`auctionNameRef`, `itemName`, `description`, `startingBid`, `minimumBidInc`, `charity`, `itemPic`)
    $charity = array($_POST["id"],$_POST["OrgName"],$_POST["RepName"],$_POST["PhoneNumber"],$_POST["email"],$_POST["Address"]);
    # user should be from form
    #| hjfranceschi@loyola.edu | Herve | Franceschi | hjfranceschi | password
        $sql = "SELECT * FROM Charity WHERE charityId = ".$charity[0];

        $result = $mysqli->query($sql);
        $row = $result->fetch_assoc();


        $unchangedCount= 0;

      if ($row["orgName"] != htmlspecialchars(trim($charity[1]))) {
          $sql = 'UPDATE Charity SET orgName ="'.htmlspecialchars(trim($charity[1])).'"WHERE charityId ='.$charity[0];
          if ($mysqli->query($sql) === true) {
              $htmlOutput .= "Organization's Name updated successfully. ";
              $_SESSION["charityNotice"] = true;
          } else {
              $htmlOutput .= "Update Failed: ". $mysqli->error;
          }
      }
      else{
        $unchangedCount++;
      }
      if ($row["repName"] != htmlspecialchars(trim($charity[2]))) {
          $sql = 'UPDATE Charity SET repName ="'.htmlspecialchars(trim($charity[2])).'"WHERE charityId ='.$charity[0];
          if ($mysqli->query($sql) === true) {
              $htmlOutput .= "Rep Name updated successfully. ";
              $_SESSION["charityNotice"] = true;
          } else {
              $htmlOutput .= "Update Failed: ". $mysqli->error;
          }
      }
      else{
        $unchangedCount++;
      }
      if ($row["phoneNumber"] != htmlspecialchars(trim($charity[3]))) {
          $sql = 'UPDATE Charity SET phoneNumber ="'.htmlspecialchars(trim($charity[3])).'"WHERE charityId ='.$charity[0];
          if ($mysqli->query($sql) === true) {
              $htmlOutput .= "Phone Number updated successfully. ";
              $_SESSION["charityNotice"] = true;
          } else {
              $htmlOutput .= "Update Failed: ". $mysqli->error;
          }
      }
      else{
        $unchangedCount++;
      }
      if ($row["email"] != htmlspecialchars(trim($charity[4]))) {
          $sql = 'UPDATE Charity SET email ="'.htmlspecialchars(trim($charity[4])).'"WHERE charityId ='.$charity[0];
          if ($mysqli->query($sql) === true) {
              $htmlOutput .= "Email updated successfully. ";
              $_SESSION["charityNotice"] = true;
          } else {
              $htmlOutput .= "Update Failed: ". $mysqli->error;
          }
      }
      else{
        $unchangedCount++;
      }
      if ($row["address"] != htmlspecialchars(trim($charity[5]))) {
          $sql = 'UPDATE Charity SET address ="'.htmlspecialchars(trim($charity[5])).'"WHERE charityId ='.$charity[0];
          if ($mysqli->query($sql) === true) {
              $htmlOutput .= "Address updated successfully. ";
              $_SESSION["charityNotice"] = true;
          } else {
              $htmlOutput .= "Update Failed: ". $mysqli->error;
          }
      }
      else{
        $unchangedCount++;
      }

      if ($unchangedCount == 5){
        $_SESSION["charityNotice"] = true;
        $htmlOutput = "No changes detected.";
      }


    $_SESSION["charityMessage"] = $htmlOutput;
    header("Location: http://jorochial.cs.loyola.edu/html/Charity/viewCharity.php?id=".$charity[0]);
    exit;
?>
