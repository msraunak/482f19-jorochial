<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/SASS/AuctionProject.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script  type="text/javascript" src="../js/formValidation.js"></script>
    <style>
        .content{
          min-height: 75vh;
        }

        #myDIV1, #myDIV2, #myDIV3, #myDIV {
          width: 100%;
          padding: 50px 0;
          text-align: center;
          background-color: lightblue;
          margin-top: 10px;
          margin bottom: 10px;
          display: none;
          min-height: 50vh;
        }
    </style>
    <title>Settings</title>
  </head>
  <body>

    <nav class="navbar navbar-light navbar-expand-lg bg-light">
      <a class="navbar-brand" href="index.html">AuctionForHaiti</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarColor02">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="DashboardPage.php">Dashboard<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.html">Login</a>
          </li>
          <li class="nav-item">
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
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>



<!-- Main Body of Settings/functionality -->
    <div class="content">

      <h1 class="text-center">Settings</h1>
      <br>

      <div class="row">
      <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Reset Password</a>
        <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Add Admin</a>
        <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Update other info</a>
      </div>
      <div class="tab-content col" id="v-pills-tabContent">
        <!-- Reset password -->
        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">



          <form class="needs-validation" novalidate>
            <!--TODO: Add functionality to this form -->
            <div class="form-group text-dark">
              <div class="form-row">
                <label for="username" class="col-md-4 text-md-right pr-4">Admin Username:</label>
                <input class="form-control" style="max-width:33%;" type="text" name="username">
              </div>
              <div class="form-row mt-2">
                <label class="col-md-4 text-md-right pr-4" for="currentPassword">Current Password:</label>
                <div class="col-md-8 p-0">
                <input class="form-control" style="max-width:50%;" type="password" name="currentPassword" required>
                <div class="invalid-feedback">
                  Please enter your current password.
                </div>
              </div>
              </div>

              <div class="form-row mt-2">
                <label class="col-md-4 text-md-right pr-4" for="newPassword">New Password:</label>
                <input class="form-control" style="max-width:33%;" type="password" name="newPassword" required>
              </div>
              <div class="form-row mt-2">
                <label class="col-md-4 text-md-right pr-4" for="newPassword2">New Password again:</label>
                <div class="col-md-8 p-0">
                <input class="form-control" style="max-width:50%;" type="password" name="newPassword2" required>
                <div class="invalid-feedback">
                  Your new password must match.
                </div>
              </div>
              </div>
              <div class="form-group">
                <br>
                <button class="btn btn-primary mt-3" type="submit" name="update">Update</button>
            </form>
              </div>
          </div>
        </div>


        <!-- Second add admin -->
        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">

          <h3 class="text-center">Add Admin</h3>
          <br>

          <form class="needs-validation" novalidate>
            <!--TODO: Add functionality to this form -->
            <div class="form-group text-dark">
              <div class="form-row mt-2">
                <label for="adminUsername" class="col-md-4 text-md-right pr-4">New Admin Username:</label>
                <input class="form-control" style="max-width:33%;" type="text" name="newAdminUsername">
              </div>

              <div class="form-row mt-2">
                <label for="adminUsernameEmail" class="col-md-4 text-md-right pr-4">New Admin Email:</label>
                <input class="form-control" style="max-width:33%;" type="text" name="newAdminEmail">
              </div>

              <div class="form-row mt-2">
                <label for="adminFirstName" class="col-md-4 text-md-right pr-4">First Name:</label>
                <input class="form-control" style="max-width:33%;" type="text" name="newAdminFirstName">
              </div>

              <div class="form-row mt-2">
                <label for="adminLastName" class="col-md-4 text-md-right pr-4">Last Name:</label>
                <input class="form-control" style="max-width:33%;" type="text" name="newAdminLastName">
              </div>

              <div class="form-row mt-2">
                <label class="col-md-4 text-md-right pr-4" for="newAdminPassword">New Password</label>
                <div class="col-md-8 p-0">
                <input class="form-control" style="max-width:50%;" type="password" name="newAdminPassword" required>
                <div class="invalid-feedback">
                  Please enter a password
                </div>
              </div>
              </div>

              <div class="form-row mt-2">
                <label class="col-md-4 text-md-right pr-4" for="newPassword2">Confirm New Password:</label>
                <div class="col-md-8 p-0">
                <input class="form-control" style="max-width:50%;" type="password" name="newPassword2" required>
                <div class="invalid-feedback">
                  Your new password must match.
                </div>
              </div>
              </div>
              <div class="form-group">
                <br>
                <button class="btn btn-primary mt-3" type="submit" name="update">Update</button>
            </form>
              </div>
          </div>
        </div>


        <!-- Third update other info -->
        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">

          Enhanced features coming soon...


        </div>
      </div>
       <!-- End of pill -->
    </div>
</div>


<!--
            <form class="needs-validation" novalidate>
              <!TODO: Add functionality to this form
              <div class="form-group text-dark">
                <div class="form-row">
                  <label for="username" class="col-md-4 text-md-right pr-4">Admin Username:</label>
                  <input class="form-control" style="max-width:33%;" type="text" name="username" value="yourUsername" readonly>
                </div>
                <div class="form-row mt-2">
                  <label class="col-md-4 text-md-right pr-4" for="currentPassword">Current Password:</label>
                  <div class="col-md-8 p-0">
                  <input class="form-control" style="max-width:50%;" type="password" name="currentPassword" required>
                  <div class="invalid-feedback">
                    Please enter your current password.
                  </div>
                </div>
                </div>

                <div class="form-row mt-2">
                  <label class="col-md-4 text-md-right pr-4" for="newPassword">New Password:</label>
                  <input class="form-control" style="max-width:33%;" type="password" name="newPassword" required>
                </div>
                <div class="form-row mt-2">
                  <label class="col-md-4 text-md-right pr-4" for="newPassword2">New Password again:</label>
                  <div class="col-md-8 p-0">
                  <input class="form-control" style="max-width:50%;" type="password" name="newPassword2" required>
                  <div class="invalid-feedback">
                    Your new password must match.
                  </div>
                </div>
                </div>
                <div class="form-group">
                  <br>
                  <button class="btn btn-primary mt-3" type="submit" name="update">Update</button>
              </form>
                </div>
            </div>
          </div>



          <div id="myDIV2">

            <h3 class="text-center">Add Admin</h3>
            <br><br>

<<<<<<< HEAD
            <form class="needs-validation" action="addAdmin.php" method="POST" novalidate>
              <!--TODO: Add functionality to this form -->
=======
            <form class="needs-validation" novalidate>
              <-TODO: Add functionality to this form >
>>>>>>> d88f5ec5424f953700e76597fd6db0c370fa15b4
              <div class="form-group text-dark">
                <div class="form-row mt-2">
                  <label for="adminUsername" class="col-md-4 text-md-right pr-4">New Admin Username:</label>
                  <input class="form-control" style="max-width:33%;" type="text" name="newAdminUsername">
                </div>

                <div class="form-row mt-2">
                  <label for="adminUsernameEmail" class="col-md-4 text-md-right pr-4">New Admin Email:</label>
                  <input class="form-control" style="max-width:33%;" type="text" name="newAdminEmail">
                </div>

                <div class="form-row mt-2">
                  <label for="adminFirstName" class="col-md-4 text-md-right pr-4">First Name:</label>
                  <input class="form-control" style="max-width:33%;" type="text" name="newAdminFirstName">
                </div>

                <div class="form-row mt-2">
                  <label for="adminLastName" class="col-md-4 text-md-right pr-4">Last Name:</label>
                  <input class="form-control" style="max-width:33%;" type="text" name="newAdminLastName">
                </div>

                <div class="form-row mt-2">
                  <label class="col-md-4 text-md-right pr-4" for="newAdminPassword">New Password</label>
                  <div class="col-md-8 p-0">
                  <input class="form-control" style="max-width:50%;" type="password" name="newAdminPassword" required>
                  <div class="invalid-feedback">
                    Please enter a password
                  </div>
                </div>
                </div>

                <div class="form-row mt-2">
                  <label class="col-md-4 text-md-right pr-4" for="newPassword2">Confirm New Password:</label>
                  <div class="col-md-8 p-0">
                  <input class="form-control" style="max-width:50%;" type="password" name="newPassword2" required>
                  <div class="invalid-feedback">
                    Your new password must match.
                  </div>
                </div>
                </div>
                <div class="form-group">
                  <br>
                  <button class="btn btn-primary mt-3" type="submit" name="update">Update</button>
              </form>
                </div>
            </div>






          </div>

          <div id="myDIV3">
            Enhanced features coming soon...
          </div>


        </div>

      </div>
    </div>

    <script>
      function myFunction1() {
        var x = document.getElementById("myDIV1");

        if (x.style.display === "block") {
          x.style.display = "none";
        } else {
          x.style.display = "block";
        }
      }

      function myFunction2() {
        var y = document.getElementById("myDIV2");

        if (y.style.display === "block") {
          y.style.display = "none";
        } else {
          y.style.display = "block";
        }
      }

      function myFunction3() {
        var z = document.getElementById("myDIV3");

        if (z.style.display === "block") {
          z.style.display = "none";
        } else {
          z.style.display = "block";
        }
      }
    </script>

-->

    <div class="footer">
      <h3> Contact Us </h3>
      <div class="row"><div class="col">Main Campus<br>
        4501 N. Charles Street<br>
        Baltimore, MD 21210<br>
        410-617-2000 or 1-800-221-9107<br>
      </div><div class="col">
        Timonium Graduate Center<br>
        2034 Greenspring Drive<br>
        Timonium, MD 21093<br>
        410-617-1903<br>
      </div><div class="col">
        Columbia Graduate Center<br>
        8890 McGaw Road<br>
        Columbia, MD 21045<br>
        410-617-7600
      </div></div>
    </div>
  </body>
</html>
