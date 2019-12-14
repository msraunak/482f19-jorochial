<?php
  session_start();
  if (!isset($_SESSION["login"]) || $_SESSION["login"] !== true) {
      //if not login in
      $_SESSION["secure_Attempt"] = true;
      header("location: ../index.php");
      exit();
  }
    require_once '../config.php';

    $htmlOutput = "";
    $_SESSION["auctionNotice"] = false;
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " .  $mysqli->connect_error);
    }

    $auction = array($POST['id'],$_POST["AuctionTitle"],$_POST["AuctionDescription"],$_POST["AuctionCharity"],$_POST["StartDateTime"],$_POST["EndDateTime"]);

        $sql = "SELECT * FROM Auction WHERE id = ".$auction[0];

        $result = $mysqli->query($sql);
        $row = $result->fetch_assoc();


        $unchangedCount= 0;

      if ($row["auctionName"] != htmlspecialchars(trim($auction[1]))) {
          $sql = 'UPDATE Auction SET auctionName ="'.htmlspecialchars(trim($auction[1])).'"WHERE id ='.$auction[0];
          if ($mysqli->query($sql) === true) {
              $htmlOutput .= "Organization's Name updated successfully. ";
              $_SESSION["auctionNotice"] = true;
          } else {
              $htmlOutput .= "Update Failed: ". $mysqli->error;
          }
      } else {
          $unchangedCount++;
      }
      if ($row["description"] != htmlspecialchars(trim($auction[2]))) {
          $sql = 'UPDATE Auction SET description ="'.htmlspecialchars(trim($auction[2])).'"WHERE id ='.$auction[0];
          if ($mysqli->query($sql) === true) {
              $htmlOutput .= "Auction Description  updated successfully. ";
              $_SESSION["auctionNotice"] = true;
          } else {
              $htmlOutput .= "Update Failed: ". $mysqli->error;
          }
      } else {
          $unchangedCount++;
      }
      if ($row["beneficiary"] != htmlspecialchars(trim($auction[3]))) {
          $sql = 'UPDATE Auction SET beneficiary ="'.htmlspecialchars(trim($auction[3])).'"WHERE id ='.$auction[0];
          if ($mysqli->query($sql) === true) {
              $htmlOutput .= "Beneficary updated successfully. ";
              $_SESSION["auctionNotice"] = true;
          } else {
              $htmlOutput .= "Update Failed: ". $mysqli->error;
          }
      } else {
          $unchangedCount++;
      }
      if ($row["startTime"] != htmlspecialchars(trim($auction[4]))) {
          if strtotime($auction[4]) < date(){
          $sql = 'UPDATE Auction SET startTime ="'.htmlspecialchars(trim($auction[4])).'"WHERE id ='.$auction[0];
          if ($mysqli->query($sql) === true) {
              $htmlOutput .= "Start Time updated successfully. ";
              $_SESSION["auctionNotice"] = true;
          } else {
              $htmlOutput .= "Update Failed: ". $mysqli->error;
          }
        }
        else {
            $htmlOutput .= "Update Failed: Auction already started";
      } else {
          $unchangedCount++;
      }
      if ($row["endTime"] != htmlspecialchars(trim($auction[5]))) {
          $sql = 'UPDATE Auction SET endTime ="'.htmlspecialchars(trim($auction[5])).'"WHERE id ='.$auction[0];
          if ($mysqli->query($sql) === true) {
              $htmlOutput .= "End Time updated successfully. ";
              $_SESSION["auctionNotice"] = true;
          } else {
              $htmlOutput .= "Update Failed: ". $mysqli->error;
          }
      } else {
          $unchangedCount++;
      }

      if ($unchangedCount == 5) {
          $_SESSION["auctionNotice"] = true;
          $htmlOutput = "No changes detected.";
      }


    $_SESSION["auctionMessage"] = $htmlOutput;
    header("Location: http://jorochial.cs.loyola.edu/html/Auction/viewAuction.php?id=".$auction[0]);
    exit;
