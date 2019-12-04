<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>imagesTool.php</title>
  </head>
  <body>

<!-- Variation of kua tube / Code Tube solution and more to insert blob data
    IMPORTANT: Simply change table name, and add appropriate column type to
              item table to make work in any field of project
-->
<?php
//Creates PDO object for database connection
$dbh = new PDO("mysql:host=cs-database.cs.loyola.edu;dbname=jorochial", "jbennett", "1670682");
if (isset($_POST['btn'])) {
  // Insert values and encoding for data in blob typing
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

<!-- Form data for submission
    IMPORTANT: Press browse button, select image, then press the upload button
-->
<form method="post" enctype="multipart/form-data">
  <input type="file" name="myfile"/>
  <button name="btn">Upload</button>
</form>
<p></p>
<ol>

<!-- Variation of Code Tube solution to get image
    IMPORTANT: Change select statement to match pertinent image request
              in project item dashboard, edit item, auctions display, etc.
-->
<?php
$stat = $dbh->prepare("select * from myblob");
$stat->execute();
while($row = $stat->fetch()){

  //Outputs to user the list of images, link data for download, translates blob data into
  //  browser image
  echo "<li><a target='_blank' href='imagesView.php?id=".$row['id']."'>".$row['name']."</a><br/>
  <embed src='data:".$row['mime'].";base64," .base64_encode($row['data'])."' width='200'/></li>";
}
?>
</ol>
  </body>
</html>
