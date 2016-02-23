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
      if (isset($_GET['id_producto'])) {
      $connection = new mysqli("localhost", "root", "1234", "hardbyte");
        //TESTING IF THE CONNECTION WAS RIGHT

        if ($connection->connect_errno) {
            printf("Conexion fallida: %s\n", $mysqli->connect_error);
            exit();
          }

            //MAKING A SELECT QUERY
            /* Consultas de selección que devuelven un conjunto de resultados */
            if ($result = $connection->query("SELECT * FROM producto WHERE id_producto=".$_GET['id_producto'])) {

                //FETCHING OBJECTS FROM THE RESULT SET
                //THE LOOP CONTINUES WHILE WE HAVE ANY OBJECT (Query Row) LEFT
                while($obj = $result->fetch_object()) {
                    //PRINTING EACH ROW
                    echo "<div class='container-page'>";
                    echo "<div class='col-md-6'>";
                    echo "<form action='editarproducto.php' method='post'>";
                    echo "<div id='nor' class='form-group col-lg-6'><b>id_producto: </b>".$obj->id_producto."</div></br></br>";
                    echo "<div class='form-group col-lg-6'><input class='ev' type='hidden'></div>";
                    echo "<div class='form-group col-lg-6'>Nombre: <input class='form-control' type='text' name='dos' required value='".$obj->nombre."'></div>";
                    echo "<div class='form-group col-lg-6'>Precio_unit: <input class='form-control' type='number' name='tres' required value='".$obj->precio_unit."'></div>";
                    echo "<div class='form-group col-lg-6'>Foto: <input class='form-control' type='text' name='cuatro' required value='".$obj->foto."'></div>";
                    echo "<div class='form-group col-lg-6'>Stock: <input class='form-control' type='number' name='seis' required value='".$obj->stock."'></div>";
                    echo "<div class='form-group col-lg-6'>Categoria: <input class='form-control' type='text' name='siete' required value='".$obj->categoria."'></div>";
                    echo "<div class='form-group col-lg-6'>Caracteristicas: <textarea class='form-control' name='ocho' rows='5'>".$obj->caracteristicas."</textarea></div>";
                    echo "<div class='form-group col-lg-6'><input class='form-control' type='hidden' name='uno' required value='".$obj->id_producto."'></div>";
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

        $consulta="UPDATE producto SET id_producto='".$_POST['uno']."', nombre='".$_POST['dos']."',precio_unit='".$_POST['tres']."',foto='".$_POST['cuatro']."',stock='".$_POST['seis']."',categoria='".$_POST['siete']."',caracteristicas='".$_POST['ocho']."' WHERE id_producto='".$_POST['uno']."';";
                   if ($connection->query($consulta)) {
                   echo "<div class='alert alert-success'><strong>¡Hecho!</strong> La accion se ha realizado con exito.</div>";
                   }
       $connection->close();
       header("refresh:0; url=producto.php");

  }

       //END OF THE IF CHECKING IF THE QUERY WAS RIGHT
    ?>
  </body>
</html>
