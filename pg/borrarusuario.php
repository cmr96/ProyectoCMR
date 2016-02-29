
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

$connection->query( $delete1 );

header("refresh:0; url=usuario.php");
?>



</body>
</html>
