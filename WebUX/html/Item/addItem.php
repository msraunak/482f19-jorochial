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


?>

<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/SASS/AuctionProject.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../../js/formValidation.js"></script>
    <title>Add Item</title>
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
            <a class="nav-link" href="DashboardPage.php">Dashboard<span class="sr-only">(current)</span></a>
          </li>
        
            <li class="nav-item">
              <a class="nav-link" href="../StartHere.php">Host an Event</a>
            </li>
          <li class="nav-item">
            <a class="nav-link" href="../Settings.php">Settings</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../logout.php">Logout</a>
          </li>
        </ul>
        <form class="form-inline">
          <!--TODO: Add functionality to Search bar -->
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>

    <div class="container">
      <h1>Add Item to Auction</h1>

      <form class="needs-validation" action="insertItem.php" method="post" novalidate>
        <!--TODO: Add functionality to this form -->
        <div class="form-group">
          <label for="ItemAuction">Auction:</label>
          <select class="form-control" id="ItemAuction" name="ItemAuction">
          <?php
          $sql = $mysqli->query("SELECT * FROM Auction");
          while ($row = $sql->fetch_assoc()){
          echo '<option value="'.$row['auctionName'].'">' . $row['auctionName'] . '</option>';
          }
          ?>
          </select>
        </div>
        <div class="form-group">
          <label for="ItemTitle">Item Title</label>
          <input type="text" class="form-control" id="ItemTitle" name="ItemTitle" placeholder="My Item" required>
        </div>
        <div class="form-group">
          <label for="ItemDescription">Description:</label>
          <textarea class="form-control" id="ItemDescription" name="ItemDescription" rows="3" required></textarea>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="ItemStartingBid">Starting Bid:</label>
            <input type="number" class="form-control" id="ItemStartingBid" name="ItemStartingBid" placeholder="0.00" step="0.01" min="0" required>
          </div>
          <div class="form-group col-md-6">
            <label for="ItemMinIncrement">Minimum Bid Increment:</label>
            <input type="number" class="form-control" id="ItemMinIncrement" name="ItemMinIncrement" placeholder="0.00" step="0.01" min="0" required>
          </div>
        </div>
        <div class="form-group">
          <label for="ItemDonor">Donor:</label>
          <!-- NOTE: Use dropdown from list of registerd Donors? or just text field?-->
          <select class="form-control" id="ItemDonor" name="ItemDonor" required>
            <option value="null">Anonymous</option>
            <?php
            $sql = $mysqli->query("SELECT orgName FROM Donor");
            while ($row = $sql->fetch_assoc()){
            echo '<option value="'.$row['orgName'].'">' . $row['orgName'] . '</option>';
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="file-input">Picture:</label>
          <!--TODO: add Javascript to change the label txt to the name of the file. see https://getbootstrap.com/docs/4.0/components/forms/#file-browser -->
          <div class="custom-file" id="file-input" required>
            <input type="file" class="custom-file-input" id="ItemPicture" name="ItemPicture" onchange="changeLabel( this )" required>
            <label class="custom-file-label" for="ItemPicture">Choose file</label>
          </div>
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
