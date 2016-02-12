<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
  </head>
  <body>


<?php
$connection = new mysqli("localhost", "root", "1234", "hardbyte");
$link=$_GET["id_producto"];

$delete1="DELETE FROM producto WHERE id_producto='$link'";

$connection->query( $delete1 );

header("refresh:0; url=producto.php");
?>

</body>
</html>
