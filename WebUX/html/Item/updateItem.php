<?php
    require_once '../config.php';

    $htmlOutput = "";

    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " .  $mysqli->connect_error);
    }

    #echo "Connected successfully";
    #UPDATE INTO `auctionItemTb`(`auctionNameRef`, `itemName`, `description`, `startingBid`, `minimumBidInc`, `donor`, `itemPic`)
    $item = array($_POST["ItemAuction"],$_POST["ItemTitle"],$_POST["ItemDescription"],$_POST["ItemStartingBid"],$_POST["ItemMinIncrement"],$_POST["ItemDonor"],$_POST["ItemPicture"],$_POST["ItemId"]);
    #$item = array("hjfranceschi@loyola.edu","Herve","Franceschi","hjfranceschi","password");
    # user should be from form
    #| hjfranceschi@loyola.edu | Herve | Franceschi | hjfranceschi | password

    $sql = "SELECT * FROM auctionItemTb WHERE id = ". $item[7];

    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc( );



      if($row["auctionNameRef"] != htmlspecialchars(trim($item[0]))){
        $sql = 'UPDATE auctionItemTb SET auctionNameRef ="'.htmlspecialchars(trim($item[0])).'"WHERE id ='.$item[7];
        if ($mysqli->query($sql) === TRUE) {
            $htmlOutput .= "Auction updated successfully";
        }
        else{
          $htmlOutput .= "Update Failed: ". $mysqli->error;

        }
      }
      if($row["itemName"] != htmlspecialchars(trim($item[1]))){
        $sql = 'UPDATE auctionItemTb SET itemName ="'.htmlspecialchars(trim($item[1])).'"WHERE id ='.$item[7];
        if ($mysqli->query($sql) === TRUE) {
            $htmlOutput .= "Title updated successfully";
        }
        else{
          $htmlOutput .= "Update Failed: ". $mysqli->error;

        }
      }
      if($row["description"] != htmlspecialchars(trim($item[2]))){
        $sql = 'UPDATE auctionItemTb SET description ="'.htmlspecialchars(trim($item[2])).'"WHERE id ='.$item[7];
        if ($mysqli->query($sql) === TRUE) {
            $htmlOutput .= "Description updated successfully";
        }
        else{
          $htmlOutput .= "Update Failed: ". $mysqli->error;

        }
      }
      if($row["startingBid"] != htmlspecialchars(trim($item[3]))){
        $sql = 'UPDATE auctionItemTb SET startingBid ="'.htmlspecialchars(trim($item[3])).'"WHERE id ='.$item[7];
        if ($mysqli->query($sql) === TRUE) {
            $htmlOutput .= "Starting Bid updated successfully";
        }
        else{
          $htmlOutput .= "Update Failed: ". $mysqli->error;

        }
      }
      if($row["minimumBidInc"] != htmlspecialchars(trim($item[4]))){
        $sql = 'UPDATE auctionItemTb SET minimumBidInc ="'.htmlspecialchars(trim($item[3])).'"WHERE id ='.$item[7];
        if ($mysqli->query($sql) === TRUE) {
            $htmlOutput .= "Minimum Bid Increment updated successfully";
        }
        else{
          $htmlOutput .= "Update Failed: ". $mysqli->error;

        }
      }
      if($row["donor"] != htmlspecialchars(trim($item[5]))){
        $sql = 'UPDATE auctionItemTb SET donor ="'.htmlspecialchars(trim($item[3])).'"WHERE id ='.$item[7];
        if ($mysqli->query($sql) === TRUE) {
            $htmlOutput .= "Minimum Bid Increment updated successfully";
        }
        else{
          $htmlOutput .= "Update Failed: ". $mysqli->error;

        }
      }

      #TODO: add itemPic update here


    $_SESSION["itemMessage"] = $htmlOutput;
    header("Location: http://jorochial.cs.loyola.edu/html/Item/viewItem.php?id=".$item[7]);
    exit;


?>
