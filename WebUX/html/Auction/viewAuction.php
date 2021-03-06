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

if(!isset($_GET["page"])){
  $pageNumber = 1;
  $_GET["page"] = 1;
}
else {
  $pageNumber = $_GET["page"];
  if($pageNumber < 1){
    $pageNumber = 1;
    $_GET["page"] = 1;
  }
}

if(isset($_GET["id"])){

  $name = "Game Sale";

  $result = $mysqli->query('SELECT * FROM Auction WHERE id = "'.$_GET["id"].'";');

  $row = $result->fetch_assoc( );
  $auction_id = $row["id"];
  $auction_title = $row['auctionName'];
  $auction_description = $row['description'];
  $auction_start_date = date("F j, Y, g:i a", strtotime($row["startTime"]));
  $auction_end_date=  date("F j, Y, g:i a", strtotime($row['endTime']));
  $auction_charity = $row['beneficiary'];
}
else{
  $auction_id = 0;
  $auction_title = "The Best Auction";
  $auction_description = "This auction is in support of the XYZ group and features items from Donors.";
  $auction_start_date = date("l jS \of F Y h:i:s A", 1530054626);;
  $auction_end_date= date("l jS \of F Y h:i:s A", 1530154626);
  $auction_charity = "The Children's Project";
}

if (isset($_SESSION["auctionNotice"])) {
    if ($_SESSION["auctionNotice"] == true) {
        $alert =  '<div class="alert alert-secondary alert-dismissible fade show" role="alert">
        '.$_SESSION["auctionMessage"].'
      <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="<?php unset($_SESSION["auctionNotice"]); ?>">
      <span aria-hidden="true">&times;</span>
      </button>
    </div>';
    } else {#($_SESSION["itemNotice"] == False){
        $alert =  '<div class="alert alert-danger alert-dismissible fade show" role="alert">
       '.$_SESSION["auctionMessage"].'
      <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="<?php unset($_SESSION["auctionNotice"]); ?>">
      <span aria-hidden="true">&times;</span>
      </button>
    </div>';
    }
}

function itemRow($id,$name, $donor, $current_bid, $start, $min_inc) {
  #TODO: Change hard coded picture to link
  return '<tr>
      <td>
        <h5><a href="../Item/viewItem.php?id='.$id.'">'.$name.'</a></h5>
      </td>
      <td>'.$donor.'</td>
      <td> $'.$current_bid.'</td>
      <td> $'.$start.'</td>
      <td> $'.$min_inc.'</td>
      <td><a class="btn btn-primary"href="../Item/viewItem.php?id='.$id.'">View Item</a></td>
    </tr>';
}

function itemTable( $mysqli, $auction_title, $pageNum, $tableSize){
  $htmlResult = "";
  $startRow = ($pageNum-1)*$tableSize;
  $sql = 'SELECT *  FROM Item WHERE auctionNameRef LIKE "'.$auction_title.'" order by id LIMIT '.$startRow.' , '.$tableSize;
  $result = $mysqli->query($sql);
  echo $mysqli->error;
  while( $row = $result->fetch_assoc( ) ){
     $htmlResult .= itemRow($row["id"],$row["itemName"],$row["donorName"],$row["currentBid"],$row["startingBid"],$row["minimumBidInc"]);
  }
  return $htmlResult;
}

function sumAmounts($mysqli, $auction_title){
  $output =  "Total raised: $";
  $sql = 'SELECT sum(currentBid) FROM Item WHERE auctionNameRef LIKE "'.$auction_title.'";';
  $result = $mysqli->query($sql);
  echo $mysqli->error;
  while( $row = $result->fetch_assoc( ) ){
     $output .= $row["sum(currentBid)"];
  }
  return $output;
}

?>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/SASS/AuctionProject.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../../js/formValidation.js"></script>
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
<?php echo $alert; ?>
    <div class="container">
      <h1><?= $auction_title ?></h1>
        <p><?= $auction_description;?></p>
        <p class="text-primary">Start Date and Time: <?= $auction_start_date;?></p>
        <p class="text-primary">End Date and Time: <?php echo $auction_end_date;?></p>
        <h6>Beneficiary: <?php echo $auction_charity;?></h6>
        <h5><?php echo sumAmounts($mysqli, $auction_title)?></h5>
      <a class="btn btn-primary" href="editAuction.php">Edit Auction Details</a>
    </div>
    <div class="container mt-3">
      <table class="table table-responsive ">
        <thead>
          <th>Item Title</th>
          <th scope="col" data-bind="tableSort: { arr: _data, propName: 'text()'}">Item Description</th>
          <th>Item's Donor</th>
          <th>Current Bid</th>
          <th>Minimum Bid</th>
          <th>Starting Bid</th>
          <th></th>
        </thead>
        <?php echo itemTable($mysqli,$auction_title, $pageNumber,4);?>
      </table>
    </div>
    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center">
        <li class="page-item"><a class="page-link" href="viewAuction.php?id=<?php echo $auction_id."page=".$pageNumber-1;?>">Previous</a></li>
        <li class="page-item"><a class="page-link" href="viewAuction.php?id=<?php echo $auction_id;?>&page=1">1</a></li>
        <li class="page-item"><a class="page-link" href="viewAuction.php?id=<?php echo $auction_id;?>&page=2">2</a></li>
        <li class="page-item"><a class="page-link" href="viewAuction.php?id=<?php echo $auction_id;?>&page=3">3</a></li>
        <li class="page-item"><a class="page-link" href="viewAuction.php?id=<?php echo $auction_id;?>&page=<?php echo $pageNumber+1;?>">Next</a></li>
      </ul>
    </nav>

    <div class="footer  footer-dark">
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
