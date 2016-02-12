<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <title></title>
  </head>
  <body>
    <?php

      $connection = new mysqli("localhost", "root", "1234", "hardbyte");


      if ($connection->connect_errno) {
          printf("Connection failed: %s\n", $mysqli->connect_error);
          exit();
      }


      if ($result = $connection->query("SELECT * FROM producto;")) {

          printf("<h1>Productos de HardByte</h1>");

      ?>

          <!-- PRINT THE TABLE AND THE HEADER -->
          <table class="table">
            <thead>
              <tr>
                <th>id_producto</th>
                <th>Nombre</th>
                <th>Precio_unit</th>
                <th>Foto</th>
                <th>Stock</th>
                <th>Categoria</th>
                <th>Caracteristicas</th>
                <th>Editar</th>
                <th>Borrar</th>
            </thead>

          <a href="crearproducto.php"><button> Crear Producto </button></br></br>

      <?php

          //FETCHING OBJECTS FROM THE RESULT SET
          //THE LOOP CONTINUES WHILE WE HAVE ANY OBJECT (Query Row) LEFT
          while($obj = $result->fetch_object()) {
              //PRINTING EACH ROW
              echo "<tr align='center'>";
              echo "<td>".$obj->id_producto."</td>";
              echo "<td>".$obj->nombre."</td>";
              echo "<td>".$obj->precio_unit."</td>";
              echo "<td>".$obj->foto."</td>";
              echo "<td>".$obj->stock."</td>";
              echo "<td>".$obj->categoria."</td>";
              echo "<td>".$obj->caracteristicas."</td>";
              echo "<td><a href='editarproducto.php?id_producto=$obj->id_producto'><img style='height: 25px;width: 25px;' src='img/sec2.jpg'></a></td>";
              echo "<td><a href='borrarproducto.php?id_producto=$obj->id_producto'><img style='height: 25px;width: 25px;' src='img/sec1.png'></a></td>";
              echo "</tr>";
          }

          //Free the result. Avoid High Memory Usages
          $result->close();
          unset($obj);
          unset($connection);

      } //END OF THE IF CHECKING IF THE QUERY WAS RIGHT

    ?>
  </body>
</html>
