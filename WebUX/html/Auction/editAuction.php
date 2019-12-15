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
$sql = "SELECT * FROM Auction WHERE id = ". $_GET["id"];

$result = $mysqli->query($sql);
$row = $result->fetch_assoc( );

$auction_title = $row["auctionName"];
$auction_description = $row["description"];
$auction_beneficiary= $row["beneficiary"];
$auction_start_time= strtotime($row["startTime"]);
$auction_end_time = strtotime($row["endTime"]);
}
else{
  $auction_title = "Chessboard TEST";
  $auction_description = "This chessboard was owned by King George back in 1945, seeing use by over three generations of royal family. It was sold to the French after the Battle of 1765 and was gifted to the King after the former owner when in against a Sicilian when death was on the line.";
  $auction_beneficiary= "TEST";
  $auction_start_time= strtotime("2019-12-02 10:00:00");
  $auction_end_time = strtotime("2019-12-02 19:00:12");
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
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
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
          <input class="form-control mr-sm-2" type="search" name="query" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>

    <div class="container">
      <h1>Edit Auction</h1>

      <form class="needs-validation" action="updateAuction.php" method="post" novalidate>
        <!--TODO: Add functionality to this form -->
          <input type="hidden" name ="id" value="<?php echo $_GET["id"];?>">
        <div class="form-group">
          <label for="AuctionTitle">Auction Title</label>
          <input type="text" class="form-control" id="AuctionTitle" name="AuctionTitle" value="<?= $auction_title?>" required>
        </div>
        <div class="form-group">
          <label for="AuctionDescription">Description:</label>
          <textarea class="form-control" id="AuctionDescription" name="AuctionDescription" rows="3" required><?= $auction_description ?></textarea>
        </div>

        <!--<div class="form-group">
          <label for="AuctionCharity">Beneficary:</label>
          <! NOTE: Use dropdown from list of registerd Charities? or just text field?
          <select class="form-control" id="AuctionCharity" required>
            <option>Anonymous</option>
            <option>Charity1</option>
            <option>Charity2</option>
            <option>Charity3</option>
          </select>
        </div>
        <!TODO: ADD Validation and a date picker if possible -->
        <div class="form-group">
          <label for="StartDateTime">Start Date and Time</label>
          <input type="text" class="form-control" id="StartDateTime" name="StartDateTime" value="<?= date('m/d/Y h:i A', $auction_start_time) ?>" required>
        </div>
        <div class="form-group">
          <label for="EndDateTime">End Date and Time</label>
          <input type="text" class="form-control" name="EndDateTime" id="EndDateTime" value="<?= date('m/d/Y h:i A', $auction_end_time)?>" required>
        </div>

        <div class="form-group">
          <button class="btn btn-primary mt-3 mt-md-0" type="submit" name="submit">Submit</button>
        </div>
      </form>
    </div>
    <div class="modal fade" id="DeleteModal" aria-labelledby="deleteModalLabel" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="DeleteModalTitle">Are you sure you want to delete this auction?</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close Delete Box" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <p>This action cannot be undone.</p>
          </div>
          <div class="modal-footer">
            <form class = "m-0" method="POST" action="deleteAuction.php" novalidate>
            <input type="hidden" class="invisible" name= "auctionId" value="<?php echo $_GET["id"]?>">
            <input type="submit" value="Delete" class="btn btn-danger">
          </form>
            <button type="button" class="btn btn-outline-info" data-dismiss="modal" aria-label="Close Delete Box" aria-hidden="true" id="buttonClose">Close</button>
          </div>
        </div>
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
