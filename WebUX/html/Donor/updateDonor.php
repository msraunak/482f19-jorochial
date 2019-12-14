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
    $_SESSION["donorNotice"] = false;
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " .  $mysqli->connect_error);
    }

    #echo "Connected successfully";
    #UPDATE INTO `Donor`(`auctionNameRef`, `itemName`, `description`, `startingBid`, `minimumBidInc`, `donor`, `itemPic`)
    $donor = array($_POST["id"],$_POST["OrgName"],$_POST["RepName"],$_POST["PhoneNumber"],$_POST["email"],$_POST["Address"]);
    #$donor = array("hjfranceschi@loyola.edu","Herve","Franceschi","hjfranceschi","password");
    # user should be from form
    #| hjfranceschi@loyola.edu | Herve | Franceschi | hjfranceschi | password
        $sql = "SELECT * FROM Donor WHERE donorId = ".$donor[0];

        $result = $mysqli->query($sql);
        $row = $result->fetch_assoc();


        $unchangedCount= 0;

      if ($row["orgName"] != htmlspecialchars(trim($donor[1]))) {
          $sql = 'UPDATE Donor SET orgName ="'.htmlspecialchars(trim($donor[1])).'"WHERE donorId ='.$donor[0];
          if ($mysqli->query($sql) === true) {
              $htmlOutput .= "Organization's Name updated successfully. ";
              $_SESSION["donorNotice"] = true;
          } else {
              $htmlOutput .= "Update Failed: ". $mysqli->error;
          }
      }
      else{
        $unchangedCount++;
      }
      if ($row["repName"] != htmlspecialchars(trim($donor[2]))) {
          $sql = 'UPDATE Donor SET repName ="'.htmlspecialchars(trim($donor[2])).'"WHERE donorId ='.$donor[0];
          if ($mysqli->query($sql) === true) {
              $htmlOutput .= "Rep Name updated successfully. ";
              $_SESSION["donorNotice"] = true;
          } else {
              $htmlOutput .= "Update Failed: ". $mysqli->error;
          }
      }
      else{
        $unchangedCount++;
      }
      if ($row["phoneNum"] != htmlspecialchars(trim($donor[3]))) {
          $sql = 'UPDATE Donor SET phoneNum ="'.htmlspecialchars(trim($donor[3])).'"WHERE donorId ='.$donor[0];
          if ($mysqli->query($sql) === true) {
              $htmlOutput .= "Phone Number updated successfully. ";
              $_SESSION["donorNotice"] = true;
          } else {
              $htmlOutput .= "Update Failed: ". $mysqli->error;
          }
      }
      else{
        $unchangedCount++;
      }
      if ($row["email"] != htmlspecialchars(trim($donor[4]))) {
          $sql = 'UPDATE Donor SET email ="'.htmlspecialchars(trim($donor[4])).'"WHERE donorId ='.$donor[0];
          if ($mysqli->query($sql) === true) {
              $htmlOutput .= "Email updated successfully. ";
              $_SESSION["donorNotice"] = true;
          } else {
              $htmlOutput .= "Update Failed: ". $mysqli->error;
          }
      }
      else{
        $unchangedCount++;
      }
      if ($row["address"] != htmlspecialchars(trim($donor[5]))) {
          $sql = 'UPDATE Donor SET address ="'.htmlspecialchars(trim($donor[5])).'"WHERE donorId ='.$donor[0];
          if ($mysqli->query($sql) === true) {
              $htmlOutput .= "Address updated successfully. ";
              $_SESSION["donorNotice"] = true;
          } else {
              $htmlOutput .= "Update Failed: ". $mysqli->error;
          }
      }
      else{
        $unchangedCount++;
      }

      if ($unchangedCount == 5){
        $_SESSION["donorNotice"] = true;
        $htmlOutput = "No changes detected.";
      }


    $_SESSION["donorMessage"] = $htmlOutput;
    header("Location: http://jorochial.cs.loyola.edu/html/Donor/viewDonor.php?id=".$donor[0]);
    exit;
?>
