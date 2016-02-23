
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

      printf("<h1>Insertar Usuario</h1>");
      if (!isset($_POST["id_usuario"])) :
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
      <form action="" method="post" class="id_usuario">
          <div class='form-group col-lg-6'>
            id_usuario:


              <?php
               // elegir usuario:
               $result=$connection->query("select MAX(id_usuario) as id from usuario");
               while ($fila=$result->fetch_object()) {
               $res=$fila->id;
               $res=$res+1;
               echo "<input class='form-control' type=text name='id_usuario' value=$res>";
                }
               ?>


          </div>

              <div class='form-group col-lg-6'>
                id_permiso:

                  <input class='form-control' type=text name='id_permiso' placeholder='user, mod o admin' required>

              </div>
              <div class='form-group col-lg-6'>
                Nombre:
                <input class='form-control' type=text name='nombre' required>
              </div>
              <div class='form-group col-lg-6'>
                Apellidos:
                <input class='form-control' type=text name='apellidos' required>
              </div>
              <div class='form-group col-lg-6'>
                Password:
                <input class='form-control' type=text name='password' required>
              </div>
              <div class='form-group col-lg-6'>
                Correo:
                <input class='form-control' type=email name='correo' required>
              </div>
              <div class='form-group col-lg-6'>
                Telefono:
                <input class='form-control' type=text name='telefono'>
              </div>
              <div class='form-group col-lg-6'>
              Direccion:
              <input class='form-control' type=text name='direccion'required>
              </div>
              <?php
              echo "<div class='form-group col-lg-6'><input class='ev' type='hidden'></div>";
              echo "<div class='form-group col-lg-6'><input class='ev' type='hidden'></div>";
              ?>
              <div class='form-group col-lg-6'>
              <input class='form-control' type=submit value="Crear" id="enviar">
              </div>
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
