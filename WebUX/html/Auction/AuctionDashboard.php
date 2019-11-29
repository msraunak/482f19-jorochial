<!DOCTYPE html>
<?php
// Start the session
session_start();
?>

<html lang="en" dir="ltr">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/SASS/AuctionProject.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../js/formValidation.js"></script>
    <title>Dashboard</title>
    <style>
      .content {
        min-height: 70vh;
      }
    </style>
  </head>
  <body>

    <nav class="navbar navbar-light navbar-expand-lg bg-light">
      <a class="navbar-brand" href="../index.php">AuctionForHaiti</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarColor02">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="../Item/DashboardPage.php">Dashboard<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../index.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../Item/addItem.php">Add Item</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Auction/createAuction.php">Create Auction</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../Settings.php">Settings</a>
          </li>
        </ul>
        <form class="form-inline">
          <!--TODO: Add functionality to Search bar -->
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>

    <div class="container-fluid">
      <nav class="nav nav-pills nav-justified mb-3">
        <a class="nav-item nav-link" href="../Item/DashboardPage.php">All Items</a>
        <a class="nav-item nav-link active" href="AuctionDashboard.php">Auctions</a>
        <a class="nav-item nav-link" href="../Donor/DonorsDashboard.php">Donors</a>
        <a class="nav-item nav-link" href="../Charity/CharitiesDashboard.php">Charities</a>
        <a class="nav-item nav-link" href="#">Results Summary</a>
      </nav>

      <!-- Large input -->
      <form class="md-form form-lg">
        <input type="text" id="inputLGEx" class="form-control form-control-lg" placeholder="Search for an existing item at auction">
        <label for="inputLGEx"></label>
      </form>
      <div class="content">
      <div class="card mb-3">
        <div class="card-body">
          <h5 class="card-title">The Children's Auction</h5>
          <p class="card-text">This Auction is about xyz...</p>
          <p class="card-text"><strong>Beneficary:</strong> The Children's Project</p>
          <div class="row text-primary">
            <p class="card-text col-lg-6">Start Date and Time: 11/23/2019 6:00:00 PM</p>
            <p class="card-text col-lg-6">End Date and Time: 11/23/2019 11:00:00 PM</p>
          </div>
            <a href="viewAuction.php" class="btn btn-secondary stretched-link mt-2">More Details</a>
          </div>
        </div>

      <div class="card mb-3">
        <div class="card-body">
          <h5 class="card-title">Cars for Kids</h5>
          <p class="card-text">This Auction is about xyz...</p>
          <p class="card-text"><strong><strong>Beneficary:</strong></strong> Kars for Kids</p>
          <div class="row text-primary">
            <p class="card-text col-lg-6">Start Date and Time: 12/12/2019 6:00:00 PM</p>
            <p class="card-text col-lg-6">End Date and Time: 12/12/2019 11:00:00 PM</p>
          </div>
            <a href="viewAuction.php" class="btn btn-secondary stretched-link mt-2">More Details</a>
        </div>
      </div>
      <div class="card mb-3">
        <div class="card-body">
          <h5 class="card-title">Rendevous Haiti's Auction</h5>
          <p class="card-text">This Auction is about xyz...</p>
          <p class="card-text"><strong>Beneficary:</strong> Rendevous Haiti</p>
          <div class="row text-primary">
            <p class="card-text col-lg-6">Start Date and Time: 11/09/2019 6:00:00 PM</p>
            <p class="card-text col-lg-6">End Date and Time: 11/09/2019 11:00:00 PM</p>
            </div>
            <a href="viewAuction.php" class="btn btn-secondary stretched-link mt-2">More Details</a>

        </div>
      </div>
    </div>
  </div>
    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center">
        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">Next</a></li>
      </ul>
    </nav>

    <!--
      $servername = "cs-database.cs.loyola.edu";
      $username = "jdbennett";
      $password = "1670682";
      $dbName = "jorochial";
      $mysqli = new mysqli($servername, $username, $password, $dbName);

      #Connects
      if($mysqli->connect_error) {
          die("Database connection failed: " . $mysqli->connect_error);
      }

      $sql1 = "select * from testItems";
      $result = $mysqli->query($sql1);
      echo "<p>";

      while($row = $result->fetch_assoc()){
        echo "id: " . $row["id"]. " - name: " . $row["name"]. " - description: " . $row["description"]. " - date: " . $row["date"]. "<br><br>";
      }

      echo "</p>";

      $mysqli->close();
      -->

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
