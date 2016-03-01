<?php
session_start();
if(isset($_SESSION['permisos']) && $_SESSION['permisos']['productos'][2]){
?>
<?php
 include_once("./db_configuration.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
  </head>
  <body>


<?php
$connection = new mysqli($db_host, $db_user, $db_password, $db_name);
$link=$_GET["id_producto"];

$delete1="DELETE FROM producto WHERE id_producto='$link'";

$connection->query( $delete1 );

header("refresh:0; url=producto.php");
?>

</body>
</html>

<?php
}
else{
  header("Location:home.php");
}
  ?>
