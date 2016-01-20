<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
  </head>
  <body>
    <?php

      $connection = new mysqli("localhost", "root", "1234", "hardbyte");


      if ($connection->connect_errno) {
          printf("Connection failed: %s\n", $mysqli->connect_error);
          exit();
      }


      if ($result = $connection->query("SELECT * FROM usuario;")) {

          printf("<h1>Clientes de HardByte</h1>");

      ?>

          <!-- PRINT THE TABLE AND THE HEADER -->
          <table border=1>
          <thead>
            <tr>
              <th>id_usuario</th>
              <th>id_permiso</th>
              <th>Nombre</th>
              <th>Apellidos</th>
              <th>password</th>
              <th>Correo</th>
              <th>Telefono</th>
              <th>Direccion</th>
              <th>Editar</th>
              <th>Borrar</th>
          </thead>

          <a href="crear.php"><button> Crear Reparacion </button>

      <?php

          //FETCHING OBJECTS FROM THE RESULT SET
          //THE LOOP CONTINUES WHILE WE HAVE ANY OBJECT (Query Row) LEFT
          while($obj = $result->fetch_object()) {
              //PRINTING EACH ROW
              echo "<tr align='center'>";
              echo "<td>".$obj->id_usuario."</td>";
              echo "<td>".$obj->id_permiso."</td>";
              echo "<td>".$obj->nombre."</td>";
              echo "<td>".$obj->apellidos."</td>";
              echo "<td>".$obj->password."</td>";
              echo "<td>".$obj->correo."</td>";
              echo "<td>".$obj->telefono."</td>";
              echo "<td>".$obj->direccion."</td>";
              echo "<td><a href='editar.php?id=$obj->id_usuario'><img style='height: 25px;width: 25px;' src='../img/sec1.jpg'></a></td>";
              echo "<td><a href='borrar.php?id=$obj->id_usuario'><img style='height: 25px;width: 25px;' src='../img/sec4.jpg'></a></td>";
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
