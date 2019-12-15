<?php

session_start();
if(!isset($_SESSION["login"]) || $_SESSION["login"] !== true){
  //if not login in
  $_SESSION["secure_Attempt"] = true;
  header("location: ../index.php");
  exit();
}
require_once 'config.php';

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

function auctionCard($id, $title, $description, $charity, $start, $end) {
  #TODO: Change hard coded picture to link
  return '<div class="card mb-3">
  <div class="card-body">
    <h5 class="card-title">'.$title.'</h5>
    <p class="card-text">'.$description.'</p>
    <p class="card-text"><strong>Beneficary:</strong> '.$charity.'</p>
    <div class="row text-primary">
      <p class="card-text col-lg-6">Start Date and Time: '.date("l jS \of F Y h:i:s A",strtotime( $start)).'</p>
      <p class="card-text col-lg-6">End Date and Time: '.date("l jS \of F Y h:i:s A",strtotime($end)).'</p>
      </div>
      <a href="viewAuction.php?id='.$id.'" class="btn btn-secondary stretched-link mt-2">More Details</a>
    </div> </div>';
}



function auctionGrid($pageNum, $mysqli, $query){
  $htmlResult = "";
  $startRow = ($pageNum-1)*4;
  $sql = "SELECT * from Auction where (auctionName like '%$query%') order by auctionName LIMIT $startRow , 4";
  $result = $mysqli->query($sql);
  if ($result->num_rows <= 0) {
      $sql = "SELECT * from Auction where (description like '%$query%') LIMIT $startRow , 4";
      $result = $mysqli->query($sql);
  }
  echo $mysqli->error;
  while( $row = $result->fetch_assoc( ) ){
     $htmlResult .= auctionCard($row["id"],$row["auctionName"],$row["description"], $row['beneficary'],$row["startTime"],$row["endTime"]);
  }
  return $htmlResult;
}
?>

<html lang="en" dir="ltr">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/SASS/AuctionProject.css">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script type="text/javascript" src="../javascript/formValidation.js"></script>
  <title>Search Results</title>
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
      <form class="form-inline" method="get" action="../search.php">
        <!--TODO: Add functionality to Search bar -->
        <input class="form-control mr-sm-2" type="search" name="query" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>

  <h2 class="text-center">Your query of <strong><?= $query ?></strong> returned:</h2>
  <br><br>
  <div class="content">
    <?php echo auctionGrid($pageNumber, $mysqli, $query);?>
  </div>
  </div>
  <!--TODO: make this dynamicly active-->
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
      <li class="page-item"><a class="page-link" href="searchAuctions.php?query=<?= $query?>&page=<?= $pageNumber-1;?>">Previous</a></li>
      <li class="page-item"><a class="page-link" href="searchAuctions.php?query=<?= $query?>&page=1">1</a></li>
      <li class="page-item"><a class="page-link" href="searchAuctions.php?query=<?= $query?>&page=2">2</a></li>
      <li class="page-item"><a class="page-link" href="searchAuctions.php?query=<?= $query?>&page=3">3</a></li>
      <li class="page-item"><a class="page-link" href="searchAuctions.php?query=<?= $query?>&page=<?= $pageNumber+1;?>">Next</a></li>
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
