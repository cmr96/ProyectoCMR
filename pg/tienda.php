<?php
  session_start();
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
        .desp22 a {
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
    				permiso.productos AS productos
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
        <div class="desp21" style="color:#0C5484;"> <!-- CAMBIA -->
        <p>
          <a href="home.php"> INICIO </a> <!-- CAMBIA -->
        </p>
      </div>
          <div class="desp22" style="background-color:#0C5484">
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
  margin: -20 auto auto 260;
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

        $connection = new mysqli($db_host, $db_user, $db_password, $db_name);


        if ($connection->connect_errno) {
            printf("Connection failed: %s\n", $mysqli->connect_error);
            exit();
        }


        if ($result = $connection->query("SELECT * FROM producto;")) {

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
                echo "<img src='img/$obj->foto'>";
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
      <p style="text-decoration: none;"><a href="conocenos.php">Conocenos</a></p>
      <p style="text-decoration: none;"><a href="asistencia.php">Asistencia 24h</a></p>
      </div>
    </div>
  </div>
</body>
</html>
