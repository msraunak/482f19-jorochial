<?php
// Start the session
session_start();
require_once '../config.php';
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if(isset($_GET["id"])){
$sql = "SELECT * FROM auctionItemTb WHERE id = ". $_GET["id"];

$result = $mysqli->query($sql);
$row = $result->fetch_assoc( );

$item_title = $row["itemName"];
$item_auction = $row["auctionNameRef"];
$item_description = $row["description"];
$item_current_bid= $row["currentBid"];
$item_starting_bid= $row["startingBid"];
$item_minimum_inc = $row["minimumBidInc"];
$item_donor = $row["donor"];
#TODO: use pic from DB also Picture file ... url for now
$item_picture = "https://i.etsystatic.com/10797882/r/il/00ee9c/1373183800/il_794xN.1373183800_3udm.jpg";
}
else{
  $item_title = "Chessboard TEST";
  $item_auction = "Rendevous Haiti";
  $item_description = "This chessboard was owned by King George back in 1945, seeing use by over three generations of royal family. It was sold to the French after the Battle of 1765 and was gifted to the King after the former owner when in against a Sicilian when death was on the line.";
  $item_current_bid= 1000.00;
  $item_starting_bid= 500.00;
  $item_minimum_inc = 100.02;
  $item_donor = "The Royal Family";
  #also Picture file ... url for now
  $item_picture = "https://i.etsystatic.com/10797882/r/il/00ee9c/1373183800/il_794xN.1373183800_3udm.jpg";
}
?>

<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/SASS/AuctionProject.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../js/formValidation.js"></script>
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
          <li class="nav-item ">
            <a class="nav-link" href="../index.php">Login</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="addItem.php">Add Item</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../Auction/createAuction.php">Create Auction</a>
          </li>
          <li class="nav-item active">
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

    <div class="container">
      <h1>Edit Item from Auction</h1>

      <form class="needs-validation" method="POST" action="updateItem.php" novalidate>
        <input type="hidden" class="invisible" name="ItemId" value="<?php echo $_GET['id'];?>">
        <!--TODO: Add functionality to this form -->
        <div class="form-group">
          <label for="ItemAuction">Auction:</label>
          <select class="form-control" id="ItemAuction" name="ItemAuction">
            <?php
            $sql = $mysqli->query("SELECT * FROM auctionTb");
            while ($row2 = $sql->fetch_assoc()){
              if($row2['auctionName'] == $row['auctionNameRef']){
                echo '<option selected value="'.$row2['auctionName'].'">' . $row2['auctionName'] . '</option>';
              }
              else{
              echo '<option value="'.$row2['auctionName'].'">' . $row2['auctionName'] . '</option>';
                }
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="ItemTitle">Item Title</label>
          <input type="text" class="form-control" id="ItemTitle" name="ItemTitle" value="<?php echo $item_title ?>" required>
        </div>
        <div class="form-group">
          <label for="ItemDescription">Description:</label>
          <textarea class="form-control" name="ItemDescription" id="ItemDescription" name="ItemDescription" rows="3" required><?php echo $item_description ?></textarea>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="ItemStartingBid">Starting Bid:</label>
            <input type="number" class="form-control" id="ItemStartingBid" name="ItemStartingBid" value="<?php echo $item_starting_bid ?>" step="0.01" min="0"  required>
          </div>
          <div class="form-group col-md-6">
            <label for="ItemMinIncrement">Minimum Bid Increment:</label>
            <input type="number" class="form-control" id="ItemMinIncrement" name="ItemMinIncrement" value="<?php echo $item_minimum_inc ?>" step="0.01" min="0" required>
          </div>
        </div>
        <div class="form-group">
          <label for="ItemDonor">Donor:</label>
          <!-- NOTE: Use dropdown from list of registerd Donors? or just text field?-->
          <select class="form-control" id="ItemDonor" name="ItemDonor" required>
            <option value="null">Anonymous</option>
            <?php
            $sql = $mysqli->query("SELECT donorName FROM auctionDonorTb");
            while ($row3 = $sql->fetch_assoc()){
              if($row3['donorName'] == $item_donor)
                echo  '<option selected value="'.$row3['donorName'].'">' . $row3['donorName'] . '</option>';
              else{
                echo '<option value="'.$row3['donorName'].'">' . $row3['donorName'] . '</option>';
              }
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
          <button class="btn btn-info mt-3 mt-md-0" type="submit" name="update">Update</button>
          <button class="btn btn-danger mt-3 mt-md-0" type="button" name="delete" data-toggle="modal" data-target="#DeleteModal">Delete</button>

        </div>
      </form>
    </div>
    <div class="modal fade" id="DeleteModal" aria-labelledby="deleteModalLabel" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="DeleteModalTitle">Are you sure you want to delete this item?</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close Delete Box" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <p>This action cannot be undone.</p>
          </div>
          <div class="modal-footer">
            <form class = "m-0" method="POST" action="deleteItem.php" novalidate>
            <input type="hidden" class="invisible" name= "itemId" value="<?php echo $_GET["id"]?>">
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
