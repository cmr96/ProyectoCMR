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
  $connection = new mysqli("localhost", "root", "1234", "hardbyte");
  if (!isset($_SESSION["usu"])) {
$result1 = $connection->query("SELECT id_usuario FROM usuario WHERE correo=".$_SESSION['usu']);

$sumatotal=$_GET['sumatotal'];
$insert1="INSERT INTO pedido VALUES ('$result1', NULL, 'sysdate()', '$sumatotal', 'Ninguna')";
echo $insert1;
}


$result=$connection->query("select MAX(id_pedido) as id from pedido");
while ($fila=$result->fetch_object()) {
$res=$fila->id;
$res=$res+1;
}

foreach($_SESSION['carrito'] as $id => $cantidad){
      if($cantidad > 0){
      if ($result3 = $connection->query("SELECT * FROM producto WHERE id_producto='$id'")) {
        while($obj3 = $result3->fetch_object()) {


$insert2="INSERT INTO entrada_pedido VALUES ('$obj3->id_producto', '$res', '$cantidad')";
echo $insert2;
}
}
}
}



header("refresh:20; url=pedido.php");
?>
