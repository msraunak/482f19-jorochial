<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

<?php

$dbh = new PDO("mysql:host=cs-database.cs.loyola.edu;dbname=jorochial", "root", "");
if (isset($_POST['btn'])) {
  // code...
  $name = $_FILES['myfile']['name'];
  $type = $_FILES['myfile']['type'];
  $data = file_get_contents($_FILES['myfile']['tmp_name']);
  $stmt = $dbh->prepare("insert into myblob values ('', ?, ?, ? )");
  $stmt->bindParam(1,$name);
  $stmt->bindParam(2,$type);
  $stmt->bindParam(3,$data);
  $stmt->execute();
}
?>

<form method="post" enctype="multipart/form-data">
  <input type="file" name="myfile"/>
  <button name="btn">Upload</button>
</form>
<p></p>
<ol>
<?php
$stat = $dbh->prepare("select * from myblob");
$stat->execute();


//To add:
//display immediate image allocation
//executed img type selection
//working on now 6:20PM


?>
</ol>



  </body>
</html>
