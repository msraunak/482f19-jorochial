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
    <script  type="text/javascript" src="../javascript/formValidation.js"></script>
    <title>Search Results</title>
  </head>
  <body>

    <nav class="navbar navbar-light navbar-expand-lg bg-light" >
      <a class="navbar-brand" href="index.php">AuctionForHaiti</a>
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
        <form class="form-inline" method="get" action="search.php"><!--TODO: Add functionality to Search bar -->
          <input class="form-control mr-sm-2" type="search" name="query" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>

<h2 class="text-center">Your query of ________ returned:</h2>
<br><br>

<div style="height: 60vh;">
  <div class="card mb-3">
      <div class="row no-gutters">
        <div class="col-md-4">
          <img src="https://i.etsystatic.com/14428349/r/il/94b17a/1668929559/il_fullxfull.1668929559_1w6g.jpg" class="card-img" alt="...">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title">Chessboard</h5>
            <p class="card-text">This chessboard was owned by King George back in 1945, seeing use by over three generation sof royal family....</p>
            <p class="card-text"><small class>Current Bid: $1,000.00</small></p>
            <p class="card-text"><small class="text-muted">Donated by: The Royal Family</small></p>
            <a href="#" class="btn stretched-link"></a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="footer">
    <h3> Contact Us </h3>
    <div class="row"><div class="col">Main Campus<br>
      4501 N. Charles Street<br>
      Baltimore, MD 21210<br>
      410-617-2000 or 1-800-221-9107<br>
    </div><div class="col">
      Timonium Graduate Center<br>
      2034 Greenspring Drive<br>
      Timonium, MD 21093<br>
      410-617-1903<br>
    </div><div class="col">
      Columbia Graduate Center<br>
      8890 McGaw Road<br>
      Columbia, MD 21045<br>
      410-617-7600
    </div></div>
  </div>


  </body>
</html>
