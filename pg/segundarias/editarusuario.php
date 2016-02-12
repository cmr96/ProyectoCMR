<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<style>
.container-page {
  margin-left: 50px;
  margin-top: 40px;
}
#nor {
  font-size: 20px;
}
</style>

    <?php
      //CREATING THE CONNECTION
      if (isset($_GET['id_usuario'])) {
      $connection = new mysqli("localhost", "root", "1234", "hardbyte");
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
                    echo "<div class='container-page'>";
                    echo "<div class='col-md-6'>";
                    echo "<form action='editarusuario.php' method='post'>";
                    echo "<div id='nor' class='form-group col-lg-6'><b>id_usuario: </b>".$obj->id_usuario."</div></br></br>";
                    echo "<div class='form-group col-lg-6'><input class='ev' type='hidden'></div>";
                    echo "<div class='form-group col-lg-6'>Permiso: <input class='form-control' type='text' name='dos' required value='".$obj->id_permiso."'></div>";
                    echo "<div class='form-group col-lg-6'>Nombre: <input class='form-control' type='text' name='tres' required value='".$obj->nombre."'></div>";
                    echo "<div class='form-group col-lg-6'>Apellidos: <input class='form-control' type='text' name='cuatro' required value='".$obj->apellidos."'></div>";
                    echo "<div class='form-group col-lg-6'>Correo: <input class='form-control' type='email' name='seis' required value='".$obj->correo."'></div>";
                    echo "<div class='form-group col-lg-6'>Telefono: <input class='form-control' type='number' name='siete' value='".$obj->telefono."'></div>";
                    echo "<div class='form-group col-lg-6'>Direccion: </td><td><input class='form-control' type='text' name='ocho' required value='".$obj->direccion."'></div>";
                    echo "<div class='form-group col-lg-6'><input class='form-control' type='hidden' name='uno' required value='".$obj->id_usuario."'></div>";
                    echo "<div class='form-group col-lg-6'><input class='ev' type='hidden'></div>";
                    echo "<div class='form-group col-lg-6'><input class='form-control' type='submit' name='guardar' value='Guardar'></div>";
                    echo "</form>";
                    echo "</div>";
                    echo "</div>";
                }




          //Liberar la consulta
          $result->close();
          unset($obj);
          unset($connection);
        }
        }
if (isset($_POST["guardar"])){

      $connection = new mysqli("localhost", "root", "1234", "hardbyte");

        //TESTING IF THE CONNECTION WAS RIGHT
        if ($connection->connect_errno) {
            printf("Conexion fallida: %s\n", $mysqli->connect_error);
            exit();
        }

        $consulta="UPDATE usuario SET id_usuario='".$_POST['uno']."', id_permiso='".$_POST['dos']."',nombre='".$_POST['tres']."',apellidos='".$_POST['cuatro']."',correo='".$_POST['seis']."',telefono='".$_POST['siete']."',direccion='".$_POST['ocho']."' WHERE id_usuario='".$_POST['uno']."';";
                   if ($connection->query($consulta)) {
                   echo "Actualizado realizado correctamente";
                   }
       $connection->close();
       header("refresh:0; url=usuario.php");

  }

       //END OF THE IF CHECKING IF THE QUERY WAS RIGHT
    ?>
  </body>
</html>
