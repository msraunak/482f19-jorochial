<?php
$auction_title = "The Children's Auction";
$auction_description = "This auction is in support of the XYZ group and features items from Donors.";
$auction_start_date = date("l jS \of F Y h:i:s A", 1530054626);;
$auction_end_date= date("l jS \of F Y h:i:s A", 1530154626);
$auction_charity = "The Children's Project";
$item_arr = array(1){array("Chessboard","This chessboard was owned by King George back in 1945, seeing use by over three generations of royal family. It was sold to the French after the Battle of 1765 and was gifted to the King after the former owner when in against a Sicilian when death was on the line.","The Royal Family",1000, 500.00,100.02,)}
 ?>

<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/SASS/AuctionProject.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../js/formValidation.js"></script>
  </head>
  <body>
    <nav class="navbar navbar-light navbar-expand-lg bg-light">
      <a class="navbar-brand" href="../index.html">AuctionForHaiti</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-h5="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarColor02">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item ">
            <a class="nav-link" href="DashboardPage.php">Dashboard<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="index.html">Login</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="addItem.html">Add Item</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="createAuction.html">Create Auction</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="Settings.php">Settings</a>
          </li>

        </ul>
        <form class="form-inline">
          <!--TODO: Add functionality to Search bar -->
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-h5="Search">
          <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>

    <div class="container">
      <h1><?php echo $auction_title;?></h1>
      <div class="row">
        <p><?php echo $auction_description;?></p>
      </div>
      <div class="row">
        <div class="col">
          <h5 class="text-primary">Start Date and Time: <?php echo $auction_start_date;?></h5>
        </div>
        <div class="col">
          <h5>End Date and Time: <?php echo $auction_end_date;?></h5>
        </div>
      </div>
      <div class="row">
        <h5>Beneficiary: <?php echo "$".$auction_charity;?></h5>
      </div>
      <a class="btn btn-primary" href="editAuction.html">Edit Auction Details</a>
      <div class="row">
        <table class="table">
          <thead>
            <th>Item Title</th>
            <th>Item Description</th>
            <th>Item's Donor</th>
            <th>Current Bid</th>
            <th>Minimum Bid</th>
            <th>Starting Bid</th>
          </thead>
          <?php echo "
          <tr>
            <td></td>
            <td>".$item_arr[0][0]."</td>
            <td>".$item_arr[0][1]."</td>
            <td>".$item_arr[0][2]."</td>
            <td>".$item_arr[0][3]."</td>
            <td>".$item_arr[0][4]."</td>
          </tr>
        </table>
      </div>
      <div class="footer fixed-bottom footer-dark">
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