<!DOCTYPE html>
<?php
// Start the session
session_start();
if(!isset($_SESSION["login"]) || $_SESSION["login"] !== true){
  //if not login in
  $_SESSION["secure_Attempt"] = true;
  header("location: index.php");
  exit();
}
?>

<html lang="en" dir="ltr">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/SASS/AuctionProject.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../js/formValidation.js"></script>
    <title>Host an Event</title>
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
            <a class="nav-link" href="Item/DashboardPage.php">Dashboard<span class="sr-only">(current)</span></a>
          </li>
            <li class="nav-item">
              <a class="nav-link" href="StartHere.php">Host an Event</a>
            </li>
          <li class="nav-item active">
            <a class="nav-link" href="Settings.php">Settings</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../logout.php">Logout</a>
          </li>
        </ul>
        <form class="form-inline" method="get" action="search.php">
          <!--TODO: Add functionality to Search bar -->
          <input class="form-control mr-sm-2" type="search" name="query" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>
    <div class="container-fluid">
      <nav class="nav nav-pills nav-justified mb-3">
        <a class="nav-item nav-link" href="Charity/addCharity.php">Add Charity</a>
        <a class="nav-item nav-link" href="Auction/createAuction.php">Create Auction</a>
        <a class="nav-item nav-link" href="Donor/addDonor.php"> Add Donor</a>
        <a class="nav-item nav-link " href="Item/addItem.php">Add an Item</a>
        <a class="nav-item nav-link" href="AuctionReview.php">Results Summary</a>
      </nav>

    </div>

    <div class="container">
      <h1 class="text-primary text-center">Host an Event!</h1>
      <h4>Follow these steps to setup your next event.</h4>

      <ol>
        <li>Add the <a href="Charity/addCharity.php">Charity</a> to benefit.</li>
        <li>Input the <a href="Auction/createAuction.php">Auction</a> details.</li>
        <li>Add the <a href="Donor/addDonor.php"> Donor's</a> information.</li>
        <li>Add the <a href="Item/addItem.php">Items</a> that have been donated.</li>
        <li>Run Your Event with our Andriod Application.</li>
        <li>Review Your Results!</li>
      </ol>
    </div>

    <div class="footer footer-dark fixed-bottom container-fluid">
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
