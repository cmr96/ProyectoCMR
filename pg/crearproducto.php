
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


<style>
#medio td {
  color: #FFFFFF;
  padding-left: 20px;
  padding-top: 5px;
}
#medio h1 {
  color: #FFFFFF;
  padding-top: 20px;
  padding-left: 20px;
}
#medio {
  margin-top: -22px
}
</style>


      <?php

      printf("<h1>Insertar producto</h1>");
      if (!isset($_POST["id_producto"])) :
      $connection = new mysqli("localhost", "root", "1234", "hardbyte");
      if ($connection->connect_errno) {
          printf("Connection failed: %s\n", $mysqli->connect_error);
          exit();


      }

        ?>
        <?php
        echo "<div class='container-page'>";
        echo "<div class='col-md-6'>";
        ?>
      <form action="" method="post" class="id_producto">
          <div class='form-group col-lg-6'>
            id_producto:


              <?php
               // elegir producto:
               $result=$connection->query("select MAX(id_producto) as id from producto");
               while ($fila=$result->fetch_object()) {
               $res=$fila->id;
               $res=$res+1;
               echo "<input class='form-control' type=text name='id_producto' value=$res>";
                }
               ?>


          </div>

              <div class='form-group col-lg-6'>
                Nombre:

                  <input class='form-control' type=text name='nombre' required>

              </div>
              <div class='form-group col-lg-6'>
                Precio_unit:
                <input class='form-control' type='text' name='precio_unit' required>
              </div>
              <div class='form-group col-lg-6'>
                Foto:
                <input class='form-control' type='text' name='foto' required>
              </div>
              <div class='form-group col-lg-6'>
                Stock:
                <input class='form-control' type='text' name='stock' required>
              </div>
              <div class='form-group col-lg-6'>
                Categoria:
                <input class='form-control' type='text' name='categoria' required>
              </div>
              <div class='form-group col-lg-6'>
                Caracteristicas:
                <textarea class="form-control" name='caracteristicas' rows="5"></textarea>
              </div>
              <?php
              echo "<div class='form-group col-lg-6'><input class='ev' type='hidden'></div>";
              ?>
              <div class='form-group col-lg-6'>
              <input class='form-control' type=submit value="Crear" id="enviar">
              </div>
            </form>


        <?php  else: ?>

        <?php
        $connection = new mysqli("localhost", "root", "1234", "hardbyte");
        $id_producto=$_POST["id_producto"];
        $nombre=$_POST["nombre"];
        $precio_unit=$_POST["precio_unit"];
        $foto=$_POST["foto"];
        $stock=$_POST["stock"];
        $categoria=$_POST["categoria"];
        $caracteristicas=$_POST["caracteristicas"];

        $insert="INSERT INTO producto VALUES ('$id_producto', '$nombre', '$precio_unit', '$foto', '$stock', '$categoria', '$caracteristicas')";
        $connection->query( $insert );
        header("refresh:0; url=producto.php");

      ?>


        <?php endif ?>
