<html>
<head>
  <meta charset="utf-8">
    <title>Hardbyte S.L</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link rel="stylesheet" type="text/css" href="../hardbytecss.css"/>
    <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
</head>
<body>

<style>
#titu {
  margin-left: 300px;
  color: white;
  font-family: 'Lobster', cursive;
  font-size: 36px;
}
#pro1 {
  padding-top: 1px;
  margin-top: 15px;
  margin-bottom: 15px;
  margin-left: 100px;
  overflow: auto;
  width: 450px;
  height: 480px;
  background-color: #6A1515;
  border: 2px solid black;
  float: left;
  display: inline;
  border-radius: 25px;
}
#pro2 {
  width: 200px;
  height: 200px;
  background-color: white;
  margin-left: 50px;
  margin-top: 10px;
  border-radius: 15px;
  float: left;
  display: inline;
  border: 3px solid #000000;
}
#pro6 {
  width: 90px;
  height: 90px;
  background-color: white;
  border-radius: 50px;
  border: 3px solid #000000;
  margin-left: 310px;
  margin-top: 80px;
}
#pro2 img {
  width: 200px;
  height: 200px;
  border-radius: 15px;
}
#pro6 img {
  width: 90px;
  height: 90px;
  border-radius: 15px;
}
#pro3 {
  width: 250px;
  background-color: white;
  margin-top: 15px;
  margin-left: 25px;
  border-radius: 10px;
  float: left;
  display: inline;
  border: 3px solid #000000;
  height: auto;
  overflow: auto;
}
#pro3 h2 {
  margin-top: 5px;
  margin-left: 5px;
}
#pro3 p {
  margin-top: 0px;
  margin-left: 5px;
}
#pro4 {
  width: 100px;
  height: 40px;
  background-color: white;
  margin-top: 80px;
  margin-left: 320px;
  border-radius: 10px;
  border: 3px solid #000000;
  background-color: #2F73B2;
}
#pro4 h2{
  margin-top: 7px;
  margin-left: 7px;
}
#pro5 {
  width: 80px;
  height: 80px;
  background-color: white;
  margin-top: 30px;
  margin-left: 320px;
  border-radius: 10px;
  border: 3px solid #000000;
  background-color: #E14040;
}
#pro5 h2{
  margin-top: 10px;
  margin-left: 5px;
}
#medio {
  overflow: auto;
  height: auto;
}
#encabezado {
  height: 62px;
}
</style>

  <!-- Inicio DIVS -->

  <script type="text/javascript">
  $(document).ready(function() {

      $('#dialog_link').click( function() {
          $('#dialog').dialog();
      });


  $('#dialog_link2').click( function() {
      $('#dialog2').dialog();
  });
});
  </script>

  <style>
  #enviar {float:right;}
  </style>

  <div id="dialog2" title="Identificate" style="display:none">
    <form action="" method="post" class="login">
    <table border="0">
      <tr>
        <td>Nombre:  </td>
        <td><input type="text" name="usu" maxlength="10" size="10" required></td>
      </tr>
      <tr>
        <td>Apellidos:  </td>
        <td><input type="text" name="usu" maxlength="30" size="10" required></td>
      </tr>
      <tr>
        <td>E-mail:  </td>
        <td><input type="text" name="usu" maxlength="10" size="10" required></td>
      </tr>
      <tr>
        <tr>
          <td>Direccion:  </td>
          <td><input type="text" name="usu" maxlength="40" size="10" required></td>
        </tr>
        <tr>
        <tr>
            <td>Telefono:  </td>
            <td><input type="text" name="usu" maxlength="9" size="10" required></td>
          </tr>
          <tr>
        <td>Contraseña:  </td>
        <td><input type="password" name="pass"  maxlength="10" size="10" required></td>
      </tr>
      <tr>
        <td colspan="2"><input type=submit value="Crear" id="enviar"></td>
      </tr>
    </table>
    </form>
  </div>


<div id="dialog" title="Identificate" style="display:none">
  <form action="" method="post" class="login">
  <table border="0">
    <tr>
      <td>E-mail:  </td>
      <td><input type="text" name="usu" maxlength="10" size="10" required></td>
    </tr>
    <tr>
      <td>Contraseña:  </td>
      <td><input type="password" name="pass"  maxlength="10" size="10" required></td>
    </tr>
    <tr>
      <td colspan="2"><input type=submit value="Entrar" id="enviar"></td>
    </tr>
  </table>
  </form>
</div>

<!-- Fin DIVS -->

    <div id="encabezado">
        <img id="fotouno" src="img/logo.jpg">
        <div id="desp">
            <div id="desp3">
                  <p id="desp2">
                <a href="../home.html"> --INICIO-- </a>
                  </p>
                  <p id="desp2">
                    <a href="producto.php"> --PRODUCTOS-- </a>
                  </p>
                      <p id="desp2">
                  <a href="usuario.php"> --USUARIOS-- </a>
                  </p>
              </div>
        </div>
        <div id="ul">
            <ul>
                <li id="dialog_link">Conectarse</li>
                <li id="dialog_link2">Crear Cuenta</li>
            </ul>
        </div>
    </div>
    <div id="medio">

      <?php

        $connection = new mysqli("localhost", "root", "1234", "hardbyte");


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
                echo "<img src='img/$obj->foto.'>";
                echo "</div>";
                echo "<div id='pro6'>";
                echo "<img src='img/carrito.png.'>";
                echo "</div>";
                echo "<div id='pro3'>";
                echo "<h2>$obj->nombre</h2>";
                echo "<p><b>$obj->caracteristicas</b></p>";
                echo "</div>";
                echo "<div id='pro4'>";
                echo "<h2>Hay ";
                echo "$obj->stock</h2>";
                echo "</div>";
                echo "<div id='pro5'>";
                echo "<h2>Precio:";
                echo "</br>";
                echo "$obj->precio_unit €</h2>";
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
          <p><a href="segundarias/conocenos.html">Conocenos</a></p>
          <p><a href="segundarias/asistencia.html">Asistencia 24h</a></p>
          <p>Creado por Carlos Martinez Romero</p>
        </div>
    </div>
</body>
</html>
