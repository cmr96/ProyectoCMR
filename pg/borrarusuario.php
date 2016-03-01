<?php
session_start();
if(isset($_SESSION['permisos']) && $_SESSION['permisos']['usuarios'][2]){
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
$link=$_GET["id_usuario"];


$delete1="DELETE FROM usuario WHERE id_usuario='$link'";
$delete2="DELETE FROM pedido WHERE id_usuario='$link'";

$result=$connection->query("SELECT id_pedido FROM pedido WHERE id_usuario='$link'");
$fila = $result->fetch_assoc();
$id = $fila['id_pedido'];

    $delete3="DELETE FROM entrada_pedido WHERE id_pedido='$id'";
$connection->query($delete3);
$connection->query( $delete2 );
$connection->query( $delete1 );





header("refresh:0; url=usuario.php");
?>



</body>
</html>

<?php
}
else{
  header("Location:home.php");
}
  ?>
