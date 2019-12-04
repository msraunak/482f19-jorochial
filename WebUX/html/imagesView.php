<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>imagesView</title>
  </head>
  <body>


<?php
$dbh = new PDO("mysql:host=cs-database.cs.loyola.edu;dbname=jorochial", "jbennett", "1670682");
$id = isset($_GET['id'])? $_GET['id'] : "";
$stat = $dbh->prepare("select * from myblolb where id=?");
$stat->bindParam(1, $id);
$stat->execute();
$row = $stat->fetch();
header('Content-Type:' .$row['mime']);
echo $row['data'];
?>


</body>
</html>
