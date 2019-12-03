<!DOCTYPE html>
<?php
// Start the session
session_start();
require_once '../config.php';
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " .  $mysqli->connect_error);
}

if (isset($_SESSION["itemNotice"])) {
    if ($_SESSION["itemNotice"] == true) {
        $alert =  '<div class="alert alert-secondary alert-dismissible fade show" role="alert">
        '.$_SESSION["itemMessage"].'
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
    </div>';
    } else {#($_SESSION["itemNotice"] == False){
        $alert =  '<div class="alert alert-danger alert-dismissible fade show" role="alert">
       '.$_SESSION["itemMessage"].'
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
    </div>';
    }
}
if(!isset($_GET["page"])){
  $pageNumber = 1;
}
else {
  $pageNumber = $_GET["page"];
  if($pageNumber < 1){
    $pageNumber = 1;
    $_GET["page"] = 1;
  }
}

function itemCard($id, $title, $description, $current_bid, $min_inc, $start_bid, $donor, $auction, $picture) {
  #TODO: Change hard coded picture to link
  return '<div class="col-sm-6 card mb-3">
    <div class="row no-gutters">
      <div class="col-md-4">
        <img src="https://i.etsystatic.com/10797882/r/il/00ee9c/1373183800/il_794xN.1373183800_3udm.jpg" class="card-img" alt="...">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title">'.$title.'</h5>
          <p class="card-text">'.$description.'</p>
          <div class="row text-primary">
            <p class="card-text col-lg-4">Current Bid: '.$current_bid.'</p>
            <p class="card-text col-lg-4">Minimum Increment:'.$min_inc.'</p>
            <p class="card=text col-lg-4">Starting Bid:'.$start_bid.'</p>
          </div>
          <p class="card-text"><small class="text-muted">Donated by: '.$donor.'</small></p>
          <p class="card-text"><small class="text-muted">Auction: '.$auction.'</small></p>
          <a href="viewItem.php?id='.$id.'" class="btn btn-secondary stretched-link">View Details</a>
        </div>
      </div>
    </div>
  </div>';
}

function itemGrid($pageNum, $mysqli){
  $htmlResult = "";
  $startRow = ($pageNum-1)*4;
  $sql = "SELECT * from Item order by id LIMIT $startRow , 4";
  $result = $mysqli->query($sql);
  echo $mysqli->error;
  while( $row = $result->fetch_assoc( ) ){
     $htmlResult .= itemCard($row["id"],$row["itemName"],$row["description"], $row["currentBid"],$row["minimumBidInc"],$row["currentBid"],$row["donor"],$row["auctionNameRef"], $row["itemPic"]);
  }
  return $htmlResult;
}

?>

<html lang="en" dir="ltr">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/SASS/AuctionProject.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../../js/formValidation.js"></script>
    <title>Dashboard</title>
    <style>
      .content {
        min-height: 70vh;
      }
    </style>
  </head>
  <body>

    <nav class="navbar navbar-light navbar-expand-lg bg-light">
      <a class="navbar-brand" href="../index.php">AuctionForHaiti</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarColor02">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="DashboardPage.php">Dashboard<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../index.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="addItem.php">Add Item</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../Auction/createAuction.php">Create Auction</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../Settings.php">Settings</a>
          </li>
        </ul>
        <form class="form-inline">
          <!--TODO: Add functionality to Search bar -->
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>
    <?php echo $alert ?>
    <div class="container-fluid">
      <nav class="nav nav-pills nav-justified mb-3">
        <a class="nav-item nav-link active" href="DashboardPage.php">All Items</a>
        <a class="nav-item nav-link" href="../Auction/AuctionDashboard.php">Auctions</a>
        <a class="nav-item nav-link" href="../Donor/DonorsDashboard.php">Donors</a>
        <a class="nav-item nav-link" href="../Charity/CharitiesDashboard.php">Charities</a>
        <a class="nav-item nav-link" href="#">Results Summary</a>
      </nav>

        <!-- Large input -->
        <form class="md-form form-lg">
          <input type="text" id="inputLGEx" class="form-control form-control-lg" placeholder="Search for an existing item at auction">
          <label for="inputLGEx"></label>
        </form>

      <div class="row justify-content-around">
        <?php echo itemGrid($pageNumber, $mysqli);?>
      <!-- OLD: Hard coded item entries
        <div class="col-sm-6 card mb-3">
          <div class="row no-gutters">
            <div class="col-md-4">
              <img src="https://i.etsystatic.com/10797882/r/il/00ee9c/1373183800/il_794xN.1373183800_3udm.jpg" class="card-img" alt="...">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">Chessboard</h5>
                <p class="card-text">This chessboard was owned by King George back in 1945, seeing use by over three generations of royal family.</p>
                <div class="row text-primary">
                  <p class="card-text col-lg-4">Current Bid: $1,000.00</p>
                  <p class="card-text col-lg-4">Minimum Increment: $100.00</p>
                  <p class="card=text col-lg-4">Starting Bid: $500.00</p>
                </div>
                <p class="card-text"><small class="text-muted">Donated by: The Royal Family</small></p>
                <p class="card-text"><small class="text-muted">Auction: Rendevous Haiti's Auction</small></p>
                <a href="viewItem.php?id=1" class="btn stretched-link"></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-6 card mb-3">
          <div class="row no-gutters">
            <div class="col-md-4">
              <img src="https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1237400132l/325451.jpg" class="card-img img-fluid" alt="ItemPicture">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">Doctor Dolittle Novel</h5>
                <p class="card-text">In Doctor Dolittle in the Moon Doctor Dolittle has landed on the Moon. He meets Otho Bludge the Moon Man, a Stone Age artist who was the only human on the Moon when it broke away from the Earth. Hugh John Lofting
                  was a British author who created the character of Doctor Dolittle - one of the classics of children's literature.</p>
                <div class="row text-primary">
                  <p class="card-text col-lg-4">Current Bid: $10.00</p>
                  <p class="card-text col-lg-4">Minimum Increment: $1.00</p>
                  <p class="card=text col-lg-4">Starting Bid: $4.00</p>
                </div>
                <p class="card-text"><small class="text-muted">Donated by: The Dolittle Association</small></p>
                <p class="card-text"><small class="text-muted">Auction: Rendevous Haiti's Auction</small></p>
                <a href="viewItem.php?id=2" class="btn stretched-link"></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-6 card mb-3">
          <div class="row no-gutters">
            <div class="col-md-4">
              <img src="https://upload.wikimedia.org/wikipedia/en/c/c0/Murder_on_the_Orient_Express_First_Edition_Cover_1934.jpg" class="card-img img-fluid" alt="ItemPicture">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">Agatha Christie Novel</h5>
                <p class="card-text">Written by accalimed novelist Agatha Christie this is a copy of her famous Murder On The Orient Express with annotations
                  from her written in the margins and a signature at the beginning of the novel. </p>
                <div class="row text-primary">
                  <p class="card-text col-lg-4">Current Bid: $14,000.00</p>
                  <p class="card-text col-lg-4">Minimum Increment: $14,000.00</p>
                  <p class="card=text col-lg-4">Starting Bid: $10,000.00</p>
                </div>
                <p class="card-text"><small class="text-muted">Donated by: The Agatha Foundation</small></p>
                <p class="card-text"><small class="text-muted">Auction: The Children's Auction</small></p>
                <a href="#" class="btn stretched-link"></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-6 card mb-3">
          <div class="row no-gutters">
            <div class="col-md-4">
              <img src="https://i.imgur.com/DsOqW3G.jpg" class="card-img" alt="...">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">1988 Shelby Mustang</h5>
                <p class="card-text">If you love classic cars, then look no further than this fully refurbished and detailed 1968 Shelby Mustang.Sporting all the original features,
                  this is the true classic driving experience. </p>
                <div class="row text-primary">
                  <p class="card-text col-lg-4">Current Bid: $140,000.00</p>
                  <p class="card-text col-lg-4">Minimum Increment: $1,000.00</p>
                  <p class="card=text col-lg-4">Starting Bid: $100,000.00</p>
                </div>
                <p class="card-text"><small class="text-muted">Donated by: Auto Retailers of America</small></p>
                <p class="card-text"><small class="text-muted">Auction: Cars for Kids</small></p>
                <a href="#" class="btn stretched-link"></a>
              </div>
            </div>
          </div>
        </div>
      -->
      </div>
    </div>
    <!--TODO: make this dynamicly active-->
    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center">
        <li class="page-item"><a class="page-link" href="DashboardPage.php?page=<?php echo $pageNumber-1;?>">Previous</a></li>
        <li class="page-item"><a class="page-link" href="DashboardPage.php?page=1">1</a></li>
        <li class="page-item"><a class="page-link" href="DashboardPage.php?page=2">2</a></li>
        <li class="page-item"><a class="page-link" href="DashboardPage.php?page=3">3</a></li>
        <li class="page-item"><a class="page-link" href="DashboardPage.php?page=<?php echo $pageNumber+1;?>">Next</a></li>
      </ul>
    </nav>

    <div class="footer footer-dark container-fluid">
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
