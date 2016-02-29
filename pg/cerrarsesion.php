
<?php
 include_once("./db_configuration.php");
?>
<?php
  session_start();
?>
<?php
session_destroy();
header("Location: home.php");
?>
