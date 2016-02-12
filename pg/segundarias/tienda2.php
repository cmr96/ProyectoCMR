<?PHP


/*
	
	foreach($array as $valor){
		
	}
	
	foreach($array as $clave => $valor){
		
	}

*/




?>

    

<?php
  session_start();
  if(isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0){
	  //QUERY PARA EXTRAER LOS PRODUCTOS CON LAS ID INDICADAS
	  /*
			$cadena = '';
			foreach($_SESSION['carrito'] as $id_producto => $cantidad){
				if($cadena != ''){$cadena .= ', ';}
				$cadena .= $id_producto;
			}
	  */
	  //SELECT * FROM PRODUCTOS WHERE ID_PRODUCTO IN($cadena)
  }
?>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hardbyte S.L</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link rel="stylesheet" type="text/css" href="../hardbytecss.css"/> <!-- CAMBIA -->
    <link href='https://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Candal' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>
<body>
	<?PHP
	
		echo '<pre>'.print_r($_REQUEST, true).'</pre><br>';
		echo '<pre>'.print_r($_SESSION, true).'</pre>';
	
	?>
	<div>
	  <!-- Inicio LOGIN-REGISTRO -->

	  <script type="text/javascript">
	  $(document).ready(function() {

	  $('#dialog_link').click( function() {
		  $('#dialog').dialog();
	  });


	  $('#dialog_link2').click( function() {
		  $('#dialog2').dialog();
	  });

	});
	  </script>

	  <style>
	  #enviar {float:right;}
	  </style>

	  <div id="dialog2" title="Crear Usuario" style="display:none">
		<form action="" method="post" class="login">
		<table border="0">
		  <tr>
			<td>Nombre:  </td>
			<td><input type="text" name="usu" maxlength="40" size="10" required></td>
		  </tr>
		  <tr>
			<td>Apellidos:  </td>
			<td><input type="text" name="usu" maxlength="40" size="10" required></td>
		  </tr>
		  <tr>
			<td>E-mail:  </td>
			<td><input type="text" name="usu" maxlength="40" size="10" required></td>
		  </tr>
		  <tr>
			<tr>
			  <td>Direccion:  </td>
			  <td><input type="text" name="usu" maxlength="40" size="10" required></td>
			</tr>
			<tr>
			<tr>
				<td>Telefono:  </td>
				<td><input type="text" name="usu" maxlength="40" size="10"></td>
			  </tr>
			  <tr>
			<td>Contrase�a:  </td>
			<td><input type="password" name="pass"  maxlength="40" size="10" required></td>
		  </tr>
		  <tr>
			<td colspan="2"><input type="submit" value="Crear" id="enviar"></td>
		  </tr>
		</table>
		</form>
	  </div>


	<div id="dialog" title="Identificate" style="display:none">
	  <form action="home.php" method="post" class="login">
	  <table border="0">
		<tr>
		  <td>E-mail:  </td>
		  <td><input type="text" name="usu" maxlength="40" size="10" required></td>
		</tr>
		<tr>
		  <td>Contrase�a:  </td>
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

		  $connection = new mysqli("localhost", "root", "", "hardbyte");

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
			<img id="fotouno" src="./img/logo.jpg"> <!-- CAMBIA -->
			<div id="desp">
				<div id="desp3">
					<div id="desp21"> <!-- CAMBIA -->
					<p>
						<a href="../home.php"> INICIO </a> <!-- CAMBIA -->
					</p>
				</div>
					  <div id="desp22" style="background-color:#97C5E4;color:#fff;">
					<p><a href="./segundarias/tienda.php"> TIENDA </a> <!-- CAMBIA -->
				  </p></div>
					  <div id="desp23" class=hide1>
						<p><a href="./producto.php"> PRODUCTOS </a> <!-- CAMBIA -->
					  </p></div>
						  <div id="desp24" class=hide2>
					  <p><a href="./usuario.php"> USUARIOS </a> <!-- CAMBIA -->
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
						echo "<li><a href='segundarias/cerrarsesion.php'>Desconectarse</a></li>";
						}

				  ?>
				  <!-- Fin Conect/Desconect -->

					<li id="dialog_link2">Crear Cuenta</li>
				</ul>
			</div>

			<!-- Inicio Carrito -->
			<div class="dropdown">
			  <button class="dropbtn"><i class="fa fa-shopping-cart fa-2x"></i></button>
			  <div class="dropdown-content">
			<?PHP
				for($i = 0; $i < 5; $i++){
			?>
				<a href="#"><img src="./segundarias/img/no_foto.jpg"> <?PHP echo 'Producto '.($i+1); ?></a>
			<?PHP
				}
			?>
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
  margin-left: 680px;
  margin-top: -100px;
  float: left;
  display: inline;
}
#pro5 img {
  width: 221px;
  height: 75px;
}
#pro7 {
  width: 80px;
  height: 30px;
  color: #008a00;
  margin: -30 auto auto 260;
  display: block;
}
#medio {
  overflow: auto;
  height: auto;
}
#encabezado {
  height: 62px;
}
</style>


      <?php

        $connection = new mysqli("localhost", "root", "", "hardbyte");


        if ($connection->connect_errno) {
            printf("Connection failed: %s\n", $mysqli->connect_error);
            exit();
        }


        if ($result = $connection->query("SELECT * FROM producto ")) {

            printf("<p id='titu'>Tienda HardByte:</p>");

        ?>

            <!-- PRINT THE TABLE AND THE HEADER -->


        <?php

            //FETCHING OBJECTS FROM THE RESULT SET
            //THE LOOP CONTINUES WHILE WE HAVE ANY OBJECT (Query Row) LEFT
            while($obj = $result->fetch_object()) {
                //PRINTING EACH ROW

                echo "<div id='pro1'>";

                echo "<div id='pro2'>";
                echo "<img src='img/$obj->foto.'>";
                echo "</div>";

                echo "<div id='pro3'>";
                echo "<h2><a href='descripcion.php?id_producto=$obj->id_producto'>$obj->nombre</a></h2>";
                echo "</div>";

                echo "<div id='pro4'>";
                echo "<p>EUR $obj->precio_unit</p>";
                echo "</div>";

                echo "<div id='pro7'>";
                echo "<p>STOCK $obj->stock</p>";
                echo "</div>";

                echo "<div id='pro5'>";
                echo "<a href='addcart.php?id_producto=$obj->id_producto'><img src='img/addcar.jpg'></a>";
                echo "</div>";

                echo "</div>";
            }

            //Free the result. Avoid High Memory Usages
            $result->close();
            unset($obj);
            unset($connection);

        } //END OF THE IF CHECKING IF THE QUERY WAS RIGHT

      ?>

		</div>

		<div id="final">
			<div id="f">
			</br>
			  <p style="text-decoration: none;">Conocenos</p>
			  <p style="text-decoration: none;">Asistencia 24h</p>
			</div>
		</div>
	</div>
</body>
</html>