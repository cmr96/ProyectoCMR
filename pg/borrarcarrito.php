<?PHP
	if(isset($_REQUEST['id_producto']) && $_REQUEST['id_producto'] != ''){
		session_start();
		if(isset($_SESSION['carrito'][$_REQUEST['id_producto']])){

			$_SESSION['carrito'][$_REQUEST['id_producto']]--;
		}
	}
	header('Location: pedido.php');
?>
