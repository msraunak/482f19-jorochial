<?php

require_once 'config.php';

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " .  $mysqli->connect_error);
}

session_start();
//check if already logged in
 if(isset($_SESSION["login"]) && $_SESSION["login"] === true){
     header("location: Item/DashboardPage.php");
     exit();
}

//check if redirected from secure
$alertHTML = "";
if(isset($_SESSION["secure_Attempt"]) && $_SESSION["secure_Attempt"] === true){
    $_SESSION["secure_Attempt"]= "false";
    $alertHTML = "<div class=\"alert alert-danger alert-dismissible fade show mt-3\" role=\"alert\">Please login to access the site.<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">&times;</span>
  </button></div>";

}

if (isset($_SESSION["loggedOut"])) {
    if ($_SESSION["loggedOut"] == true) {
        $alertHTML =  '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Logged Out Successfully.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
    </div>';
    } else {#($_SESSION["itemNotice"] == False){
        $alertHTML =  '<div class="alert alert-danger alert-dismissible fade show" role="alert">
       Log out not successful.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
    </div>';
    }
}


$passwordClass = $userClass = 'class="form-control"';

//retrieve user entered information from form
$username = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = htmlspecialchars(trim($_POST['username']));
  $password = htmlspecialchars(trim($_POST['password']));

  if ($password == "" || $username == ""){
    $passwordClass = $userClass = 'class="form-control is-invalid"';
    exit();
  }

  //get information from Database
  $sql = 'SELECT * FROM admin WHERE uname = "' . $username . '";';
  $result = $mysqli->query($sql);

  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      if ($username == $row["uname"]){
        //verify Password
        if (password_verify($password, $row["pwd"])){
          $_SESSION["login"] = true;
          header("location: Item/DashboardPage.php");
          exit();
        }else{
          $_SESSION["login"] = false;
          $passwordClass = $userClass = 'class="form-control is-invalid"';
        }
      }
      }
  }  else{
    echo $mysqli->connect_error;
    $userClass = $passwordClass= 'class="form-control is-invalid"';
  }
}
$mysqli->close();
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
      <a class="navbar-brand" href="index.php">AuctionForHaiti</a>
    </nav>

    <div class="container">
      <h1 class="text-center">Login to Auction Manager</h1>
          <?php echo $alertHTML ?>

          <form class="needs-validation" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" novalidate>
            <label for="username">Username:</label>
            <input type="text" <?php echo $userClass; ?> <?php echo 'value="'.$username.'"'?> name="username" id="username" required>
            <label for="password">Password</label>
            <input type="password" <?php echo $passwordClass; ?> name="password" id="password" required>
            <div class="invalid-feedback">Username or Password incorrect. <a href="forgotPassword.php">Forgot Your Password?</a></div>
            <input class="btn btn-primary mt-3" type="submit" value="Login">
          </form>

    </div>

    <div class="footer footer-dark fixed-bottom container-fluid">
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
