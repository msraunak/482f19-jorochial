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
?>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/SASS/AuctionProject.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../../js/formValidation.js"></script>
    <title>Add Donor</title>
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
      <h1>Edit a Donor</h1>

      <form class="needs-validation" action="updateDonor.php" method="post" novalidate>
        <input type="hidden" name ="id" value="<?php echo $_GET["id"];?>">
        <!--TODO: Add functionality to this form -->
        <div class="form-group">
          <label for="OrgName">Organization's Name</label>
          <input type="text" class="form-control" id="OrgName" name="OrgName" value="<?php echo $donor_title ?>" required>
        </div>
        <div class="form-group">
          <label for="RepName">Reprenstative's Name</label>
          <input type="text" class="form-control" id="RepName" name="RepName" value="<?php echo $donor_repName ?>" required>
        </div>
        <div class="form-group">
          <label for="PhoneNumber">Phone Number</label>
          <input type="text" class="form-control" id="PhoneNumber" name="PhoneNumber" value="<?php echo $donor_phoneNum ?>" required>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" name="email" value="<?php echo $donor_email ?>" required>
        </div>
        <div class="form-group">
          <label for="Address">Address:</label>
          <textarea class="form-control" id="Address" name="Address" rows="3" required><?php echo $donor_address ?></textarea>
        </div>

        <div class="form-group">
          <button class="btn btn-info mt-3 mt-md-0" type="submit" name="Update">Update</button>
            <button class="btn btn-danger mt-3 mt-md-0" type="button" name="delete" data-toggle="modal" data-target="#DeleteModal">Delete</button>
        </div>
      </form>
    </div>

    <div class="modal fade" id="DeleteModal" aria-labelledby="deleteModalLabel" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="DeleteModalTitle">Are you sure you want to delete this donor?</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close Delete Box" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <p>This action cannot be undone.</p>
          </div>
          <div class="modal-footer">
            <form class = "m-0" method="POST" action="deleteDonor.php" novalidate>
            <input type="hidden" class="invisible" name= "donorId" value="<?php echo $_GET["id"]?>">
            <input type="submit" value="Delete" class="btn btn-danger">
          </form>
            <button type="button" class="btn btn-outline-info" data-dismiss="modal" aria-label="Close Delete Box" aria-hidden="true" id="buttonClose">Close</button>
          </div>
        </div>
      </div>
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
