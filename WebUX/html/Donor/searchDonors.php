<!DOCTYPE html>
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
    die("Connection failed: " .  $mysqli->connect_error);
}

if(isset($_GET["query"])){
  $query = htmlspecialchars($_GET["query"]);
}else{
  $query = htmlspecialchars("Car");
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

function donorRow($donorId,$orgName, $repName, $phoneNum, $email, $address) {
  #TODO: Change hard coded picture to link
  return '<tr>
      <td>
        <h5><a href="viewDonor.php?id='.$donorId.'">'.$orgName.'</a></h5>
      </td>
      <td>'.$repName.'</td>
      <td>'.$phoneNum.'</td>
      <td>'.$email.'</td>
      <td>'.$address.'</td>
      <td><a class="btn btn-primary"href="viewDonor.php?id='.$donorId.'">View Details</a></td>
    </tr>';
}

function donorTable($pageNum,$tableSize ,$mysqli, $query){
  $htmlResult = "";
  $startRow = ($pageNum-1)*$tableSize;
  $sql = "SELECT * from Donor where (orgName like '%$query%') order by orgName"; # LIMIT $startRow , 4";
  $result = $mysqli->query($sql);
  if ($result->num_rows <= 0) {
      $sql = "SELECT * from Donor where (repName like '%$query%') LIMIT $startRow , 4";
      $result = $mysqli->query($sql);
  }
  echo $mysqli->error;
  while( $row = $result->fetch_assoc( ) ){
     $htmlResult .= donorRow($row['donorId'],$row['orgName'],$row['repName'], $row['phoneNum'], $row['email'], $row['address']);
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
      <a class="navbar-brand" href="index.php">AuctionForHaiti</a>
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
<?php echo $alert;?>
    <div class="container-fluid">
      <nav class="nav nav-pills nav-justified mb-3">
        <a class="nav-item nav-link" href="../Item/DashboardPage.php">All Items</a>
        <a class="nav-item nav-link" href="../Auction/AuctionDashboard.php">Auctions</a>
        <a class="nav-item nav-link active" href="../Donor/DonorsDashboard.php">Donors</a>
        <a class="nav-item nav-link" href="../Charity/CharitiesDashboard.php">Charities</a>
        <a class="nav-item nav-link" href="../AuctionReview.php">Results Summary</a>
      </nav>
      <form class="form-inline md-form form-lg " method="GET" action="searchDonors.php">
        <input type="text" id="inputLGEx" class="col-10 form-control form-control-lg" placeholder="Search for an existing Donor" name="query">
        <input class="col btn btn-lg btn-primary" type="submit" value="Submit">
        <label for="inputLGEx"></label>
      </form>

      <h2 class="text-center">Your query of <strong><?= $query ?></strong> returned:</h2>
      <br><br>
      <div class="content row justify-content-center">
        <div class="col-auto">
          <table class="table table-responsive">
            <tr>
              <th>Name</th>
              <th>Rep Name</th>
              <th>Phone Number</th>
              <th>Email</th>
              <th>Address</th>
              <th></th>
            </tr>
            <?php echo donorTable($pageNumber, 10, $mysqli, $query);?>


          </table>
        </div>
      </div>
    </div>
    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center">
        <li class="page-item"><a class="page-link" href="DonorsDashboard.php?query=<?= $query?>&page=<?php echo $pageNumber-1;?>">Previous</a></li>
        <li class="page-item"><a class="page-link" href="DonorsDashboard.php?query=<?= $query?>&page=1">1</a></li>
        <li class="page-item"><a class="page-link" href="DonorsDashboard.php?query=<?= $query?>&page=2">2</a></li>
        <li class="page-item"><a class="page-link" href="DonorsDashboard.php?query=<?= $query?>&page=3">3</a></li>
        <li class="page-item"><a class="page-link" href="DonorsDashboard.php?query=<?= $query?>&page=<?php echo $pageNumber+1;?>">Next</a></li>
      </ul>
    </nav>

    <div class="footer container-fluid">
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
