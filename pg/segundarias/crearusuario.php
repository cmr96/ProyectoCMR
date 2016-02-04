
    <link rel="stylesheet" type="text/css" href="../hardbytecss.css"/>


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

      printf("<h1>Insertar Usuario</h1>");
      if (!isset($_POST["id_usuario"])) :
      $connection = new mysqli("localhost", "root", "1234", "hardbyte");
      if ($connection->connect_errno) {
          printf("Connection failed: %s\n", $mysqli->connect_error);
          exit();


      }

        ?>


      <form action="" method="post" class="id_usuario">
        <table border="0">
          <tr>
            <td>id_usuario:  </td>
            <td>

              <?php
               // elegir usuario:
               $result=$connection->query("select MAX(id_usuario) as id from usuario");
               while ($fila=$result->fetch_object()) {
               $res=$fila->id;
               $res=$res+1;
               echo "<input type=text name='id_usuario' value=$res>";
                }
               ?>

            </td>
          </tr>

              <tr>
                <td>id_permiso:  </td>
                <td>
                  <input type=text name='id_permiso' placeholder='user, mod o admin' required>
                </td>
              </tr>
              <tr>
                <td>Nombre:  </td>
                <td><input type=text name='nombre' required></td>
              </tr>
              <tr>
                <td>Apellidos:  </td>
                <td><input type=text name='apellidos' required></td>
              </tr>
              <tr>
                <td>Password:  </td>
                <td><input type=text name='password' required></td>
              </tr>
              <tr>
                <td>Correo:  </td>
                <td><input type=text name='correo' required></td>
              </tr>
              <tr>
                <td>Telefono:  </td>
                <td><input type=text name='telefono'></td>
              </tr>
              <tr>
              <td>Direccion:  </td>
              <td><input type=text name='direccion'required></td>
              </tr>
              <tr>
                <td colspan="2"><input type=submit value="Entrar" id="enviar"></td>
              </tr>
              </table>
            </form>


        <?php  else: ?>

        <?php
        $connection = new mysqli("localhost", "root", "1234", "hardbyte");
        $id_usuario=$_POST["id_usuario"];
        $id_permiso=$_POST["id_permiso"];
        $nombre=$_POST["nombre"];
        $apellidos=$_POST["apellidos"];
        $password=$_POST["password"];
        $correo=$_POST["correo"];
        $telefono=$_POST["telefono"];
        $direccion=$_POST["direccion"];

        $insert="INSERT INTO usuario VALUES ('$id_usuario', '$id_permiso', '$nombre', '$apellidos', MD5('$password'), '$correo', '$telefono', '$direccion')";
        $connection->query( $insert );
        header("refresh:0; url=usuario.php");

      ?>


        <?php endif ?>
