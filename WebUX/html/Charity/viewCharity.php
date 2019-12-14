<?php
// Start the session
session_start();
require_once '../config.php';
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if (isset($_GET["id"])) {
    $sql = "SELECT * FROM Charity WHERE charityId = ". $_GET["id"];

    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    $charity_edit_link= "editCharity.php?id=".$row["charityId"];
    $charity_title = $row["orgName"];

    $charity_repName = $row["repName"];
    $charity_phoneNum= $row["phoneNumber"];
    $charity_email= $row["email"];
    $charity_address = $row["address"];
} else {
    $charity_title = "Cars for Kids";
    $charity_repName = "DEFAULT NAME";
    $charity_phoneNum= "213-123-2312";
    $charity_email= "jane@cars4Kids.org";
    $charity_address = "123 Main Street <br> Baltimore, MD";
}

if (isset($_SESSION["charityNotice"])) {
    if ($_SESSION["charityNotice"] == true) {
        $alert =  '<div class="alert alert-secondary alert-dismissible fade show" role="alert">
        '.$_SESSION["charityMessage"].'
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
    </div>';
    } else {#($_SESSION["auctionNotice"] == False){
        $alert =  '<div class="alert alert-danger alert-dismissible fade show" role="alert">
       '.$_SESSION["charityMessage"].'
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
    </div>';
    }
}

#Donaton table
function auctionRow($id,$name, $descript, $startTime, $endTime) {
  return '<tr>
      <td>
        <h5><a href="../Auction/viewAuciton.php?id='.$id.'">'.$name.'</a></h5>
      </td>
      <td>'.$description.'</td>
      <td>'.date('l dS \o\f F Y h:i:s A', $startTime);.'</td>
      <td>'.date('l dS \o\f F Y h:i:s A', $endTime).'</td>
      <td><a class="btn btn-primary"href="../Auction/viewAuction.php?id='.$id.'">View Auction</a></td>
    </tr>';
}

function auctionTable($mysqli, $orgName){
  $htmlResult = "";
  $sql = 'SELECT *  FROM Auction WHERE beneficiary LIKE "'.$orgName.'"';
  $result = $mysqli->query($sql);
  echo $mysqli->error;
  while( $row = $result->fetch_assoc( ) ){
     $htmlResult .= auctionRow($row["id"],$row["auctionName"],$row["description"],strtotime($row["startTime"]),strtotime($row["endTime"]));
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
          <li class="nav-item ">
            <a class="nav-link" href="../index.php">Login</a>
          </li>
            <li class="nav-item">
              <a class="nav-link" href="../StartHere.php">Host an Event</a>
            </li>
          <li class="nav-item active">
            <a class="nav-link" href="../Settings.php">Settings</a>
          </li>
        </ul>
        <form class="form-inline">
          <!--TODO: Add functionality to Search bar -->
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-h5="Search">
          <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>
<?php echo $alert; ?>
    <div class="container">

        <h1 class="text-center"><?php echo $charity_title;?></h1>
        <div class="row">

        </div>
        <div class="col pl-0">
            <h3>Contact Information</h3>
            <h5><?php echo $charity_repName;?><br><?php echo $charity_phoneNum;?><br><?php echo $charity_email;?><br><?php echo $charity_address;?></h5>
        </div>
        <a class="btn btn-primary" href="<?php echo $charity_edit_link?>">Edit Charity's Details</a>


      <h3 class="mt-3">Related Auctions:</h3>
      <table class="table table-responsive mb-4">
        <tr>
          <th>Name</th>
          <th>Description</th>
          <th>Start Time</th>
          <th>End Time</th>
          <th></th>
        </tr>
        <?php echo auctionTable($mysqli, $charity_title);?>
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
