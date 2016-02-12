<?PHP
	if(isset($_REQUEST['id_producto']) && $_REQUEST['id_producto'] != ''){
		session_start();
		if(isset($_SESSION['carrito'][$_REQUEST['id_producto']])){
			$_SESSION['carrito'][$_REQUEST['id_producto']]++;
		}else{
			$_SESSION['carrito'][$_REQUEST['id_producto']] = 1;
		}
	}
	header('Location: tienda.php');
?>