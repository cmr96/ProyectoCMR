<?php
session_start();
if(isset($_SESSION['permisos']) && $_SESSION['permisos']['usuarios'][1]){
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
    .desp24 a {
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
            <div class="desp24" class="hide2" style="background-color:#0C5484;color:#ffffff;">
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
.container-page {
  padding-top: 30px;
  color: white;
}
#nor {
  font-size: 20px;
}
</style>

    <?php
      //CREATING THE CONNECTION
      if (isset($_GET['id_usuario'])) {
      $connection = new mysqli($db_host, $db_user, $db_password, $db_name);
        //TESTING IF THE CONNECTION WAS RIGHT

        if ($connection->connect_errno) {
            printf("Conexion fallida: %s\n", $mysqli->connect_error);
            exit();
          }

            //MAKING A SELECT QUERY
            /* Consultas de selección que devuelven un conjunto de resultados */
            if ($result = $connection->query("SELECT * FROM usuario WHERE id_usuario=".$_GET['id_usuario'])) {

                //FETCHING OBJECTS FROM THE RESULT SET
                //THE LOOP CONTINUES WHILE WE HAVE ANY OBJECT (Query Row) LEFT
                while($obj = $result->fetch_object()) {
                    //PRINTING EACH ROW
                    echo "<form action='editarusuario.php' method='post'>";
                    echo "<div class='container-page'>";
                    echo "<div id='nor' class='form-group col-lg-6'><b>id_usuario: </b>".$obj->id_usuario."</div></br></br>";
                    echo "<div class='form-group col-lg-6'><input class='ev' type='hidden'></div>";
                    echo "<div class='form-group col-lg-6'>Permiso: <select class='form-control'name='dos'>";
                    $result=$connection->query("select id_permiso from permiso");
                    while ($fila=$result->fetch_object()) {
              //va de fila en fila y guarda en $fila
                    echo  "<option value='$fila->id_permiso'>$fila->id_permiso</option>";
                //Muestre dentro de cada opcion el valor
              }
                    echo '</select></div>';
                    echo "<div class='form-group col-lg-6'>Nombre: <input class='form-control' type='text' name='tres' required value='".$obj->nombre."'></div>";
                    echo "<div class='form-group col-lg-6'>Apellidos: <input class='form-control' type='text' name='cuatro' required value='".$obj->apellidos."'></div>";
                    echo "<div class='form-group col-lg-6'>Correo: <input class='form-control' type='email' name='seis' required value='".$obj->correo."'></div>";
                    echo "<div class='form-group col-lg-6'>Telefono: <input class='form-control' type='number' name='siete' value='".$obj->telefono."'></div>";
                    echo "<div class='form-group col-lg-6'>Direccion: <input class='form-control' type='text' name='ocho' required value='".$obj->direccion."'></div>";
                    echo "<div class='form-group col-lg-6'><input class='form-control' type='hidden' name='uno' required value='".$obj->id_usuario."'></div>";
                    echo "<div class='form-group col-lg-6'><input class='ev' type='hidden'></div>";
                    echo "<div class='form-group col-lg-6'><input class='form-control' type='submit' name='guardar' value='Guardar'></div>";
                    echo "</div>";
                    echo "</form>";

                }



          //Liberar la consulta
          $result->close();
          unset($obj);
          unset($connection);
        }
        }
if (isset($_POST["guardar"])){

      $connection = new mysqli($db_host, $db_user, $db_password, $db_name);

        //TESTING IF THE CONNECTION WAS RIGHT
        if ($connection->connect_errno) {
            printf("Conexion fallida: %s\n", $mysqli->connect_error);
            exit();
        }

        $consulta="UPDATE usuario SET id_usuario='".$_POST['uno']."', id_permiso='".$_POST['dos']."',nombre='".$_POST['tres']."',apellidos='".$_POST['cuatro']."',correo='".$_POST['seis']."',telefono='".$_POST['siete']."',direccion='".$_POST['ocho']."' WHERE id_usuario='".$_POST['uno']."';";
                   if ($connection->query($consulta)) {
                   echo "<div class='alert alert-success'><strong>¡Hecho!</strong> La accion se ha realizado con exito.</div>";
                   }
       $connection->close();
       header("refresh:1; url=usuario.php");

  }

       //END OF THE IF CHECKING IF THE QUERY WAS RIGHT
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

<?php
}
else{
  header("Location:home.php");
}
  ?>
