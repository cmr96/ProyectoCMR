<!--
CREATE TABLE PEDIDO (
	id_usuario INT NOT NULL,
	id_pedido INT AUTO_INCREMENT PRIMARY KEY,
	fecha date NOT NULL,
	precio INT NOT NULL,
	observaciones VARCHAR(200),
	FOREIGN KEY (id_usuario)
        REFERENCES USUARIO(id_usuario)
);


CREATE TABLE ENTRADA_PEDIDO (
	id_producto INT NOT NULL,
  	id_pedido INT NOT NULL,
	cantidad INT NOT NULL,
	FOREIGN KEY (id_producto)
        REFERENCES PRODUCTO(id_producto),
	FOREIGN KEY (id_pedido)
        REFERENCES PEDIDO(id_pedido)
);
-->


<?PHP
  session_start();


 include_once("./db_configuration.php");

  $connection = new mysqli($db_host, $db_user, $db_password, $db_name);
  $id_usuario = '';
	$fechaPedido = getdate();
if (isset($_SESSION["usu"]) && $_SESSION['usu'] != '') {
	$result1 = $connection->query("SELECT id_usuario FROM usuario WHERE correo='".$_SESSION['usu']."'");
	$fila = $result1->fetch_assoc();
	$id_usuario = $fila['id_usuario'];
		// echo '<pre>'.print_r($_REQUEST, true).'</pre>';
		// echo '<pre>'.print_r($_SESSION, true).'</pre>';
	$sumatotal=$_REQUEST['sumatotal'];
	$insert1="INSERT INTO pedido VALUES ('".$id_usuario."', NULL, '".$fechaPedido['year']."-".$fechaPedido['mon']."-".$fechaPedido['mday']."', '".$sumatotal."', 'Ninguna')";
	// echo $insert1.'<BR>';
	$connection->query($insert1);
}


$result=$connection->query("SELECT MAX(id_pedido) AS id FROM pedido WHERE id_usuario = '".$id_usuario."' AND fecha = '".$fechaPedido['year']."-".$fechaPedido['mon']."-".$fechaPedido['mday']."'");
$fila=$result->fetch_object();


foreach($_SESSION['carrito'] as $id => $cantidad){
	if($cantidad > 0){
		$insert2="INSERT INTO entrada_pedido VALUES ('".$id."', '".$fila->id."', '".$cantidad."')";
			// echo $insert2;
		$connection->query($insert2);
	}
}
$_SESSION['carrito'] = [];
header("refresh:0; url=pedido.php");
?>
