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
  margin-top: -22px;
}
#crear {
  margin-left: 20px;
}
</style>

    <?php

      $connection = new mysqli("localhost", "root", "1234", "hardbyte");


      if ($connection->connect_errno) {
          printf("Connection failed: %s\n", $mysqli->connect_error);
          exit();
      }


      if ($result = $connection->query("SELECT * FROM usuario;")) {

          printf("<h1>Usuarios de HardByte</h1>");

      ?>

          <!-- PRINT THE TABLE AND THE HEADER -->
          <table class="table">
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

          <a href="crearusuario.php"><button id="crear"> Crear Usuario </button></br></br>

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
              echo "<td><a href='editarusuario.php?id_usuario=$obj->id_usuario'><img style='height: 25px;width: 25px;' src='img/sec2.jpg'></a></td>";
              echo "<td><a href='borrarusuario.php?id_usuario=$obj->id_usuario'><img style='height: 25px;width: 25px;' src='img/sec1.png'></a></td>";
              echo "</tr>";
          }

          //Free the result. Avoid High Memory Usages
          $result->close();
          unset($obj);
          unset($connection);

      } //END OF THE IF CHECKING IF THE QUERY WAS RIGHT

    ?>