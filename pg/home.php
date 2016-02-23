<?php
  session_start();
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
    .desp21 a {
      color: white;
    }
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

		  $connection = new mysqli("localhost", "root", "1234", "hardbyte");

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

				header("Location: home.php");
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
					<div class="desp21" style="background-color:#0C5484;color:#ffffff;"> <!-- CAMBIA -->
					<p>
						<a href="home.php"> INICIO </a> <!-- CAMBIA -->
					</p>
				</div>
					  <div class="desp22" style="color:#0C5484">
					<p><a href="tienda.php"> TIENDA </a> <!-- CAMBIA -->
				  </p></div>
					  <div class="desp23" class="hide1" style="color:#0C5484">
						<p><a href="producto.php"> PRODUCTOS </a> <!-- CAMBIA -->
					  </p></div>
						  <div class="desp24" class="hide2" style="color:#0C5484">
					  <p><a href="usuario.php"> USUARIOS </a> <!-- CAMBIA -->
					  </p></div>
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

      	$connection = new mysqli("localhost", "root", "1234", "hardbyte");
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
			<p id="remem">Lideres del Sector</p>
			<img id="fotodos" src="img/img1.jpg"> <!-- CAMBIA -->
			<img id="fotodos" src="img/img2.jpg"> <!-- CAMBIA -->
			<img id="fotodos" src="img/img3.jpg"> <!-- CAMBIA -->
			<div id="cap"><h2>Lo mejor en componentes</h2>Elige las mejores piezas para tu PC en HardByte.</div>
			<div id="acc"><h2>Productos nuevos</h2>Cada dia hay productos nuevos, no te los pierdas</div>
			<div id="fin"><h2>Entrega ahora mas rapida</h2>Compra ahora rapido y mejor, con nuestro nuevo servicio de entrega a domicilio.</div>
		 <div id="boton">
			 <img id="bot" src="img/boton.jpg"> <!-- CAMBIA -->
			 <div id="get"><p><a href="tienda.php"><b>IR A LA TIENDA</b></a></p></div> <!-- CAMBIA -->

		</div>
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
