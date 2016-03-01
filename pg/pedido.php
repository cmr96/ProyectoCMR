<?php
  session_start();
        if(isset($_SESSION['carrito'])){
?>

<?php
 include_once("./db_configuration.php");
?>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hardbyte S.L</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link rel="stylesheet" type="text/css" href="hardbytecss.css"/> <!-- CAMBIA -->
    <link href='https://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Candal' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>
<body>
	<div id="main">
	  <!-- Inicio LOGIN-REGISTRO -->

	  <script type="text/javascript">
	  $(document).ready(function() {

	  $('#dialog_link').click( function() {
		  $('#dialog').dialog();
	  });

	});
	  </script>

	  <style>
	  #enviar {float:right;}
	  </style>



	<div id="dialog" title="Identificate" style="display:none">
	  <form action="home.php" method="post" class="login">
	  <table border="0">
		<tr>
		  <td id="son">E-mail:  </td>
		  <td><input type="text" name="usu" maxlength="40" size="10" required></td>
		</tr>
		<tr>
		  <td id="son">Contraseña:  </td>
		  <td><input type="password" name="pass"  maxlength="40" size="10" required></td>
		</tr>
		<tr>
		  <td colspan="2"><input type="submit" value="Entrar" id="enviar"></td>
		</tr>
	  </table>
	  </form>
	</div>

	<?php

		if (isset($_POST["usu"])) {

		  $connection = new mysqli($db_host, $db_user, $db_password, $db_name);

		  if ($connection->connect_errno) {
			  printf("Connection failed: %s\n", $connection->connect_error);
			  exit();
		  }

		  $query = $connection->prepare("SELECT * FROM usuario
			WHERE correo=? AND password=md5(?)");

		  $query->bind_param("ss",$_POST["usu"],$_POST["pass"]);

		  if ($query->execute()) {

			$query->store_result();

			  if ($query->num_rows===0) {
				header("Location: home.php");
			  } else {

				$_SESSION["usu"]=$_POST["usu"];
				$_SESSION["language"]="es";

				$_SESSION['permiso'] = [];

				$result=$connection->query("
				SELECT
				permiso.usuarios AS usuarios,
				permiso.productos AS productos,
        permiso.pedidos AS pedidos
				FROM usuario, permiso
				WHERE
				usuario.correo = '".$_SESSION['usu']."'
				AND
				usuario.id_permiso = permiso.id_permiso
				");
				$permisos=$result->fetch_assoc();

				foreach($permisos as $clave => $valor){
					$permisos[$clave] = explode(":", $valor);
				}
				$_SESSION['permisos'] = $permisos;

				$query->close();

				//header("Location: home.php");
			  }
		  } else {
			echo "Wrong Query";
			var_dump($consulta);
		  }
	  }
	?>

	<!-- Fin LOGIN-REGISTRO -->

		<div id="encabezado">
			<img id="fotouno" src="img/logo.jpg"> <!-- CAMBIA -->
			<div class="desp">
				<div class="desp3">
					<div class="desp21" style="color:#0C5484"> <!-- CAMBIA -->
					<p>
						<a href="home.php"> INICIO </a> <!-- CAMBIA -->
					</p>
				</div>
						<div class="desp22" style="color:#0C5484">
							<p><a href="tienda.php"> TIENDA </a> <!-- CAMBIA -->
							</p>
						</div>
					<?PHP
						if(isset($_SESSION['permisos']) && $_SESSION['permisos']['productos'][0]){
					?>
						<div class="desp23" class="hide1" style="color:#0C5484">
							<p><a href="producto.php"> PRODUCTOS </a> <!-- CAMBIA -->
							</p>
						</div>
					<?PHP
						}
						if(isset($_SESSION['permisos']) && $_SESSION['permisos']['usuarios'][0]){
					?>
						<div class="desp24" class="hide2" style="color:#0C5484">
							<p><a href="usuario.php"> USUARIOS </a> <!-- CAMBIA -->
							</p>
						</div>
            <?PHP
  						}
            if(isset($_SESSION['permisos']) && $_SESSION['permisos']['pedidos'][0]){
          ?>
            <div class="desp25" class="hide3" style="color:#0C5484">
              <p><a href="gestion_pedido.php"> PEDIDOS </a> <!-- CAMBIA -->
              </p>
            </div>
          <?PHP
            }
          ?>
          </div>
  				  </div>
			<div id="ul">
				<ul>
				  <!-- Inicio Conect/Desconect -->
				  <?php

					  if (!isset($_SESSION["usu"])) {
						echo "<li id='dialog_link'>Conectarse</li>";
						}

				  ?>
				  <?php

					  if (isset($_SESSION["usu"])) {
						echo "<li><a href='cerrarsesion.php'>Desconectarse</a></li>";
						}

				  ?>

          <?php

              if (!isset($_SESSION["usu"])) {
                echo "<li><a href='crearuser.php'>Crear Cuenta</a></li>";
                }

          ?>

				  <!-- Fin Conect/Desconect -->
				</ul>
			</div>

			<!-- Inicio Carrito -->

      <div class="dropdown">
			  <button class="dropbtn"><i class="fa fa-shopping-cart fa-2x fa-lg"></i></button>
			  <div class="dropdown-content">
			<?PHP
      if(isset($_SESSION['carrito'])){

      	$connection = new mysqli($db_host, $db_user, $db_password, $db_name);
        foreach($_SESSION['carrito'] as $id => $cantidad){
                    if($cantidad > 0){

              if ($result = $connection->query("SELECT * FROM producto WHERE id_producto='$id'")) {
                  while($obj = $result->fetch_object()) {
                      echo "<a href='descripcion.php?id_producto=$obj->id_producto'><img src='img/".$obj->foto."'><br>";
                      echo substr($obj->nombre, 0, 12)."...<br>";
                      echo "Cantidad: ".$cantidad."</a><br>";
                  }
                }
        }
      }
    }
			?>
        <a href="pedido.php"><p>Ver Carrito</p></a>
			  </div>
			</div>

			<!-- Fin Carrito -->

		</div>
		<div id="medio">


<style>
#titu {
  margin-left: 300px;
  color: white;
  font-family: 'Lobster', cursive;
  font-size: 36px;
}
#pro1 {
  padding-top: 1px;
  margin-top: 5px;
  margin-bottom: 5px;
  margin-left: 30px;
  overflow: auto;
  width: 1000px;
  height: 180px;
  background-color: #FFFFFF;
  border: 2px solid black;
  float: left;
  display: inline;
  border-radius: 4px;
}
#pro2 {
  width: 160px;
  height: 160px;
  background-color: white;
  margin-left: 30px;
  margin-top: 10px;
  float: left;
  display: inline;
}
#pro2 img {
  width: 160px;
  height: 160px;
  border-radius: 7.5px;
}
#pro3 {
  width: 700px;
  background-color: white;
  margin: 10 auto auto 70;
  float: left;
  display: inline;
  height: 30px;
}
#pro3 h2 {
}
#pro3 h2 a {
  color: black;
  font-size: 20px;
  text-align: center;
  margin: 0 0 0 0;
}
#pro4 {
  width: 80px;
  height: 40px;
  color: #B12704;
  margin: 70 auto auto 260;
  display: block;
}
#pro5 {
  width: 221px;
  height: 75px;
  background-color: white;
  margin-left: 770px;
  margin-top: -120px;
  float: left;
  display: inline;
}
#pro5 img {
  width: 75px;
  height: 75px;
}
#pro7 {
  width: 140px;
  height: 30px;
  color: #008a00;
  margin: -20 auto auto 260;
  display: block;
  font-size: 20px;
}
#medio {
  overflow: auto;
  height: auto;
}
#encabezado {
  height: 62px;
}
.tot {
  width: 230px;
  height: 120px;
  background-color: #ffffff;
  margin-right: 15px;
  margin-top: 5px;
  border: 2px solid black;
  border-radius: 4px;
  float: right;
}
.tot2 {
  width: 230px;
  height: 60px;
  background-color: green;
  margin-right: 15px;
  margin-top: 5px;
  border: 2px solid black;
  border-radius: 4px;
  float: right;
}
.tot3 {
  width: 230px;
  height: 60px;
  background-color: #EF0506;
  margin-right: 15px;
  margin-top: 5px;
  border: 2px solid black;
  border-radius: 4px;
  float: right;
}
.tot p {
  margin: 35 30 auto;
  font-size: 28px;
  color: #0C5484;
  font-family: 'Montserrat', sans-serif;
}
.tot2 p {
  margin: 10 15 auto;
  font-size: 25px;
  color: white;
  font-family: 'Montserrat', sans-serif;
}
.tot2 p a {
    text-decoration: none;
    color: white;
}

.tot3 p {
  margin: 10 65 auto;
  font-size: 25px;
  color: white;
  font-family: 'Montserrat', sans-serif;
}
.tot3 p a {
    text-decoration: none;
    color: white;
}
.opcio {
  display: grid;
  overflow: auto;

}


</style>

<?PHP

  $connection = new mysqli($db_host, $db_user, $db_password, $db_name);
  $sumatotal=0;
  foreach($_SESSION['carrito'] as $id => $cantidad){
        if($cantidad > 0){
        if ($result = $connection->query("SELECT * FROM producto WHERE id_producto='$id'")) {
          while($obj = $result->fetch_object()) {
              //PRINTING EACH ROW
              echo "<div id='pro1'>";

              echo "<div id='pro2'>";
              echo "<img src='img/$obj->foto'>";
              echo "</div>";

              echo "<div id='pro3'>";
              echo "<h2><a href='descripcion.php?id_producto=$obj->id_producto'>$obj->nombre</a></h2>";
              echo "</div>";

              echo "<div id='pro4'>";
              echo "<p>EUR $obj->precio_unit</p>";
              echo "</div>";

              echo "<div id='pro7'>";
              echo "<p>Cantidad: $cantidad</p>";
              echo "</div>";

              echo "<div id='pro5'>";
              echo "<a href='borrarcarrito.php?id_producto=$obj->id_producto'><img src='img/delete.jpg'></a>";
              echo "</div>";

              echo "</div>";
              $sumatotal= $sumatotal + ($obj->precio_unit * $cantidad);
            }
          }


  }
}


?>
<div class="opcio">
<div class="tot">
  <p>
      <?PHP
        echo "Total: ".$sumatotal." €";
      ?>
  </p>
</div>
<div class="tot3">
  <p><a href="tienda.php">Volver</a></p>
</div>

<div class="tot2">
  <p><a href="tramitar.php?sumatotal=<?=$sumatotal?>">Tramitar Pedido</a></p>
</div>
</div>
<?PHP
}else{
       header("Location:home.php");
     }
?>

</div>

<div id="final">
  <div id="f">
  </br>
    <p style="text-decoration: none;"><a href="conocenos.php">Conocenos</a></p>
    <p style="text-decoration: none;"><a href="asistencia.php">Asistencia 24h</a></p>
  </div>
</div>
</div>
</body>
</html>
