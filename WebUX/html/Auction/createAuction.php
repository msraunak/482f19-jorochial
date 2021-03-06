<?php
// Start the session
session_start();
if (!isset($_SESSION["login"]) || $_SESSION["login"] !== true) {
    //if not login in
    $_SESSION["secure_Attempt"] = true;
    header("location: ../index.php");
    exit();
}
require_once '../config.php';
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);



$charites = array();

$sql = "Select orgName from Charity";
$result = $mysqli->query($sql);
$threadId = 0;
while ($row = $result->fetch_assoc()) {
    $charites =  $row['orgName'];
}



?>

<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/SASS/AuctionProject.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../js/formValidation.js"></script>
    <title>Create Auction</title>
  </head>
  <body>
    <body class="bg-dark text-light-primary">
      <!--differences -->
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

              <li class="nav-item active">
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
      <nav class="nav nav-pills nav-justified mb-3">
        <a class="nav-item nav-link " href="../Charity/addCharity.php">Add Charity</a>
        <a class="nav-item nav-link active" href="../Auction/createAuction.php">Create Auction</a>
        <a class="nav-item nav-link text-primary" href="../Donor/addDonor.php"> Add Donor</a>
        <a class="nav-item nav-link " href="../AddItem.php">Add an Item</a>
        <a class="nav-item nav-link" href="../AuctionReview.php">Results Summary</a>
      </nav>
      <div class="container">
        <h1>Create Auction</h1>

        <form class="needs-validation" action="addAuctionForm.php" method="post" novalidate>
          <!--TODO: Add functionality to this form -->
          <div class="form-group">
            <label for="AuctionTitle">Auction Title</label>
            <input type="text" class="form-control" id="AuctionTitle" name="AuctionTitle" placeholder="My Auction" required>
          </div>
          <div class="form-group">
            <label for="AuctionDescription">Description:</label>
            <textarea class="form-control" id="AuctionDescription" name="AuctionDescription" rows="3" required></textarea>
          </div>

          <div class="form-group">
            <label for="AuctionCharity">Beneficary:</label>
            <!-- NOTE: Use dropdown from list of registerd Charities? or just text field?-->
            <select class="form-control" name="AuctionCharity" id="AuctionCharity" required>
              <option>Anonymous</option>
              <option>Charity1</option>
              <option>Charity2</option>
              <option>Charity3</option>
            </select>
          </div>
          <!--TODO: ADD Validation and a date picker if possible -->
          <div class="form-group">
            <label for="StartDateTime">Start Date and Time</label>
            <input type="text" class="form-control" id="StartDateTime" name="StartDateTime" placeholder="01/01/1970 10:00AM" required>
          </div>
          <div class="form-group">
            <label for="EndDateTime">End Date and Time</label>
            <input type="text" class="form-control" name="EndDateTime" id="EndDateTime" placeholder="01/01/1970 10:01AM" required>
          </div>

          <div class="form-group">
            <button class="btn btn-primary mt-3 mt-md-0" type="submit" name="submit">Submit</button>
          </div>
        </form>
      </div>
      <div class="footer">
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
