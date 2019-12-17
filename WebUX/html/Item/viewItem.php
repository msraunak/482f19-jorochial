<?php
// Start the session
session_start();
if(!isset($_SESSION["login"]) || $_SESSION["login"] !== true){
  //if not login in
  $_SESSION["secure_Attempt"] = true;
  header("location: ../index.php");
  exit();
}
require_once '../config.php';
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if(isset($_GET["id"])){


  $sql = "SELECT * FROM Item WHERE id = ". $_GET["id"];

  $result = $mysqli->query($sql);
  $row = $result->fetch_assoc( );
  $item_edit_link= "editItem.php?id=".$row["id"];
  $item_title = $row["itemName"];
  $item_auction = $row["auctionNameRef"];
  $item_description = $row["description"];
  $item_current_bid= $row["currentBid"];
  $item_starting_bid= $row["startingBid"];
  $item_minimum_inc = $row["minimumBidInc"];
  $item_donor = $row["donorName"];
  #TODO: use pic from DB also Picture file ... url for now
  $item_picture_ref = $row['imageRef'];
  $item_picture_data = $row["imageData"];
}
else{
  $item_title = "Chessboard";
  $item_auction = "Rendevous Haiti";
  $item_description = "This chessboard was owned by King George back in 1945, seeing use by over three generations of royal family. It was sold to the French after the Battle of 1765 and was gifted to the King after the former owner when in against a Sicilian when death was on the line.";
  $item_current_bid= 1000.00;
  $item_starting_bid= 500.00;
  $item_minimum_inc = 100.02;
  $item_donor = "The Royal Family";
  #also Picture file ... url for now
  $item_picture = "https://assets.dmagstatic.com/wp-content/uploads/2018/12/dallas-construction-1024x683.jpg";
}



function itemRow($bidder,$amount, $time) {
  #TODO: Change hard coded picture to link
  return '<tr>
      <td>'.$bidder.'</td>
      <td> $'.$amount.'</td>
      <td> $'.$time.'</td>
    </tr>';
}

function itemTable($mysqli, $itemId){
  $htmlResult = "";
  $sql = "SELECT *  FROM Bids WHERE itemId = $itemId";
  $result = $mysqli->query($sql);
  echo $mysqli->error;
  while( $row = $result->fetch_assoc( ) ){
     $htmlResult .= itemRow($row["bidderUName"],$row["amount"],$row["time"]);
  }
  return $htmlResult;
}



 ?>

<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/SASS/AuctionProject.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../js/formValidation.js"></script>
  </head>
  <body>
    <nav class="navbar navbar-light navbar-expand-lg bg-light">
      <a class="navbar-brand" href="../index.php">AuctionForHaiti</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-h5="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarColor02">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item ">
            <a class="nav-link" href="../Item/DashboardPage.php">Dashboard<span class="sr-only">(current)</span></a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="../StartHere.php">Host an Event</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="../Settings.php">Settings</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../logout.php">Logout</a>
          </li>
        </ul>
        <form class="form-inline" method="get" action="../search.php">
          <!--TODO: Add functionality to Search bar -->
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-h5="Search">
          <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>

    <div class="container">
      <div class="row">
        <div class="col">
          <img src="data:<?php echo $item_picture_ref ?>;base64, <?php echo $item_picture_data ?>" class="img-fluid" width=200>
          <!-- img src="data:'.$pictureRef.';base64,' . $pictureData .'" width="200" class="card-img" -->
        </div>

        <div class="col">
          <h1><?php echo $item_title;?></h1>
          <div class="row">
            <h5>Auction: <?php echo $item_auction;?> </h5>
          </div>
          <div class="row">
            <p><?php echo $item_description;?></p>
          </div>
          <div class="row">
            <h5 class="text-primary">Current Bid: <?php echo "$".$item_current_bid;?></h5>
          </div>
          <div class="row">
            <h5>Starting Bid: <?php echo "$".$item_starting_bid;?></h5>
          </div>
          <div class="row">
            <h5>Minimum Bid Increment: <?php echo "$".$item_minimum_inc;?></h5>
          </div>
          <div class="row">
            <h5>Donor: <?php echo $item_donor;?></h5>
          </div>
          <a class="btn btn-primary" href="<?php echo $item_edit_link?>"> Edit Item</a>
        </div>
      </div>
    </div>
    <div class="content row justify-content-center mt-3">
      <div class="col-auto">
        <table class="table table-responsive">
          <tr>
            <th>Bidder's Username</th>
            <th>Amount</th>
            <th>Time</th>
          </tr>
          <?php echo bidsTable($mysqli, $_GET["id"]);?>
        </table>
      </div>
    </div>
    <div class="footer fixed-bottom footer-dark">
      <h3> Contact Us </h3>
      <div class="row">
        <div class="col">Main Campus<br>
          4501 N. Charles Street<br>
          Baltimore, MD 21210<br>
          410-617-2000 or 1-800-221-9107<br>
        </div>
        <div class="col">
          Timonium Graduate Center<br>
          2034 Greenspring Drive<br>
          Timonium, MD 21093<br>
          410-617-1903<br>
        </div>
        <div class="col">
          Columbia Graduate Center<br>
          8890 McGaw Road<br>
          Columbia, MD 21045<br>
          410-617-7600
        </div>
      </div>
    </div>

  </body>

</html>
