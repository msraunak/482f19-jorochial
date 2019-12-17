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

if (isset($_GET["id"])) {
    $sql = "SELECT * FROM Donor WHERE donorId = ". $_GET["id"];

    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    $donor_edit_link= "editDonor.php?id=".$row["donorId"];
    $donor_title = $row["orgName"];

    $donor_repName = $row["repName"];
    $donor_phoneNum= $row["phoneNum"];
    $donor_email= $row["email"];
    $donor_address = $row["address"];
} else {
    $donor_title = "The Agatha Foundation";
    $donor_repName = "Jane Doe";
    $donor_phoneNum= "213-123-2312";
    $donor_email= "jane@childrenProject.org";
    $donor_address = "123 Main Street <br> Baltimore, MD";
}

if (isset($_SESSION["donorNotice"])) {
    if ($_SESSION["donorNotice"] == true) {
        $alert =  '<div class="alert alert-secondary alert-dismissible fade show" role="alert">
        '.$_SESSION["donorMessage"].'
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
    </div>';
    } else {#($_SESSION["itemNotice"] == False){
        $alert =  '<div class="alert alert-danger alert-dismissible fade show" role="alert">
       '.$_SESSION["donorMessage"].'
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
    </div>';
    }
}

#Donaton table
function itemRow($id,$name, $auction, $current_bid, $start, $min_inc) {
  #TODO: Change hard coded picture to link
  return '<tr>
      <td>
        <h5><a href="../Item/viewItem.php?id='.$id.'">'.$name.'</a></h5>
      </td>
      <td>'.$auction.'</td>
      <td> $'.$current_bid.'</td>
      <td> $'.$start.'</td>
      <td> $'.$min_inc.'</td>
      <td><a class="btn btn-primary"href="../Item/viewItem.php?id='.$id.'">View Item</a></td>
    </tr>';
}

function itemTable($mysqli, $orgName){
  $htmlResult = "";
  $sql = 'SELECT *  FROM Item WHERE donorName LIKE "'.$orgName.'"';
  $result = $mysqli->query($sql);
  echo $mysqli->error;
  while( $row = $result->fetch_assoc( ) ){
     $htmlResult .= itemRow($row["id"],$row["itemName"],$row["auctionNameRef"],$row["currentBid"],$row["startingBid"],$row["minimumBidInc"]);
  }
  return $htmlResult;
}

function sumAmounts($mysqli, $donor_title){
  $output =  "Total raised: $";
  $sql = 'SELECT sum(currentBid) FROM Item WHERE donorName LIKE "'.$donor_title.'";';
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
      <a class="navbar-brand" href="index.php">AuctionForHaiti</a>
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

        <h1 class="text-center"><?php echo $donor_title;?></h1>
        <div class="row">

        </div>
        <div class="col pl-0">
            <h3>Contact Information</h3>
            <h5><?php echo $donor_repName;?><br><?php echo $donor_phoneNum;?><br><?php echo $donor_email;?><br><?php echo $donor_address;?></h5>
            <h4><?php echo sumAmounts($mysqli, $auction_title)?></h4>
        </div>
        <a class="btn btn-primary" href="<?php echo $donor_edit_link?>">Edit Donor's Details</a>


      <h3 class="mt-3">Items Donated:</h3>
      <table class="table table-responsive mb-4">
        <tr>
          <th>Name</th>
          <th>Auction</th>
          <th>Current Bid</th>
          <th>Starting Bid</th>
          <th> Minimum Increment</th>
          <th></th>
        </tr>
        <?php echo itemTable($mysqli, $donor_title);?>
      </table>
    </div>
    <div class="footer footer-dark">
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
