<?PHP
	session_start();
	$_SESSION['ID'] = 'PRUEBAS';
	header('Location: tienda.php');
?>