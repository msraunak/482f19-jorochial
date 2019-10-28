<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/SASS/AuctionProject.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script  type="text/javascript" src="../js/formValidation.js"></script>
    <title>Dashboard</title>
    <style>
        .content{
          min-height:70vh;
        }
    </style>
  </head>
  <body>

    <nav class="navbar navbar-light navbar-expand-lg bg-light">
      <a class="navbar-brand" href="index.html">AuctionForHaiti</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarColor02">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="DashboardPage.php">Dashboard<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../index.html">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="addItem.html">Add Item</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="createAuction.html">Create Auction</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Settings.php">Settings</a>
          </li>
        </ul>
        <form class="form-inline">
          <!--TODO: Add functionality to Search bar -->
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>




    <div class="content">

      <div class="container">
        <h3 class="text-center">Your Dashboard: </h3>

        <!-- Large input -->
        <div class="md-form form-lg">
          <input type="text" id="inputLGEx" class="form-control form-control-lg" placeholder="search for an existing item at auction">
          <label for="inputLGEx"></label>
        </div>
      </div>


      <h5 class="text-center">See what is currently on bid:</h5>


      <div class="card mb-3" >
        <div class="row no-gutters">
          <div class="col-md-4">
            <img src="https://i.etsystatic.com/10797882/r/il/00ee9c/1373183800/il_794xN.1373183800_3udm.jpg" class="card-img" alt="...">
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

      <div class="card mb-3" >
        <div class="row no-gutters">
          <div class="col-md-4">
            <img src="https://upload.wikimedia.org/wikipedia/en/c/c0/Murder_on_the_Orient_Express_First_Edition_Cover_1934.jpg" class="card-img" alt="...">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title">Agatha Christie Novel</h5>
              <p class="card-text">Written by accalimed novelist Agatha Christie this is a copy of her famous Murder On The Orient Express with annotations
              from her written in the margins and a signature at the beginning of the novel. </p>
              <p class="card-text"><small class=>Current Bid: $14,000.00</small></p>
              <p class="card-text"><small class="text-muted">Donated by: The Agatha Foundation</small></p>
              <a href="#" class="btn stretched-link"></a>
            </div>
          </div>
        </div>
      </div>

      <div class="card mb-3">
        <div class="row no-gutters">
          <div class="col-md-4">
            <img src="https://i.imgur.com/DsOqW3G.jpg" class="card-img" alt="...">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title">1988 Shelby Mustang</h5>
              <p class="card-text">If you love classic cars, then look no further than this fully refurbished and detailed 1968 Shelby Mustang.Sporting all the original features,
              this is the true classic driving experience. </p>
              <p class="card-text"><small class>Current Bid: $140,000.00</small></p>
              <p class="card-text"><small class="text-muted">Donated by: Auto Retailers of America</small></p>
              <a href="#" class="btn stretched-link"></a>
            </div>
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



    <div class="footer">
      <h3> Contact Us </h3>
      <p>Main Campus<br>
        4501 N. Charles Street<br>
        Baltimore, MD 21210<br>
        410-617-2000 or 1-800-221-9107<br>
        <br>
        Timonium Graduate Center<br>
        2034 Greenspring Drive<br>
        Timonium, MD 21093<br>
        410-617-1903<br>
        <br>
        Columbia Graduate Center<br>
        8890 McGaw Road<br>
        Columbia, MD 21045<br>
        410-617-7600</p>
    </div>

  </body>
</html>
