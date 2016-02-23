<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
  </head>
  <body>
    <style>
    h1 {
      margin-left: 300px;
    }
    #pro1 {
      padding-top: 1px;
      margin-top: 30px;
      margin-left: 100px;
      overflow: auto;
      width: 450px;
      height: 450px;
      background-color: #0C5484;
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
      height: 200px;
      background-color: white;
      margin-top: 15px;
      margin-left: 25px;
      border-radius: 10px;
      float: left;
      display: inline;
      border: 3px solid #000000;
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
    </style>
    <?php

      $connection = new mysqli("localhost", "root", "1234", "hardbyte");


      if ($connection->connect_errno) {
          printf("Connection failed: %s\n", $mysqli->connect_error);
          exit();
      }


      if ($result = $connection->query("SELECT * FROM producto;")) {

          printf("<h1>Tienda HardByte:</h1>");

      ?>

      <a style="margin-left:300px" href="../home.html"><button>Volver</button></a>
      </br>

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
              echo "<p>$obj->caracteristicas</p>";
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
  </body>
</html>
