
<?php
 include_once("./db_configuration.php");
?>
<?PHP
		session_start();

	if(isset($_REQUEST['id_producto']) && $_REQUEST['id_producto'] != ''){

		if(isset($_SESSION['carrito'][$_REQUEST['id_producto']])){

			$_SESSION['carrito'][$_REQUEST['id_producto']]--;
			if($_SESSION['carrito'][$_REQUEST['id_producto']] = 0){
		unset($_SESSION['carrito'][intval($_REQUEST['id_producto'])]);
			}
		}
	}
	header('Location: pedido.php');
?>
