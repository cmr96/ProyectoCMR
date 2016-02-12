    <link rel="stylesheet" type="text/css" href="../hardbytecss.css"/>

    <style>
    #titu {
      margin-left: 300px;
      color: white;
      font-family: 'Lobster', cursive;
      font-size: 36px;
    }
    #pro1 {
      padding-top: 1px;
      margin-top: 5px;
      margin-bottom: 5px;
      margin-left: 30px;
      overflow: auto;
      width: 1180px;
      height: 410px;
      background-color: #FFFFFF;
      border: 2px solid black;
      float: left;
      display: inline;
      border-radius: 4px;
    }
    #pro2 {
      width: 160px;
      height: 160px;
      background-color: white;
      margin-left: 30px;
      margin-top: 55px;
      float: left;
      display: inline;
    }
    #pro2 img {
      width: 300px;
      height: 300px;
      border-radius: 7.5px;
    }
    #pro3 {
      width: 600px;
      background-color: white;
      margin: 10 auto auto 200;
      float: left;
      display: inline;
      height: 30px;
    }
    #pro3 h2 a {
      color: black;
      font-size: 30px;
      text-align: center;
      margin: 0 0 0 0;
    }
    #pro4 {
      width: 80px;
      height: 40px;
      color: #B12704;
      margin: 100 auto auto 390;
      display: block;
    }
    #pro5 {
      width: 221px;
      height: 75px;
      background-color: white;
      margin-left: 860px;
      margin-top: -30px;
      float: left;
      display: inline;
    }
    #pro5 img {
      width: 221px;
      height: 75px;
    }
    #pro6 {
      width: 400px;
      background-color: white;
      margin: 10 auto auto 200;
      float: left;
      display: inline;
      height: 30px;
    }
    #pro6 p {
      color: black;
      font-size: 25px;
      margin: -15 0 0 0;
    }
    #pro7 {
      width: 80px;
      height: 30px;
      color: #008a00;
      margin: -30 auto auto 390;
      display: block;
    }
    #medio {
      overflow: auto;
      height: auto;
    }
    #encabezado {
      height: 62px;
    }
    </style>

    <?php

$connection = new mysqli("localhost", "root", "", "hardbyte");
$link=$_GET["id_producto"];

$query1="SELECT * FROM producto WHERE id_producto='$link'";


      if ($result = $connection->query( $query1 )) {


      ?>


      <?php

          //FETCHING OBJECTS FROM THE RESULT SET
          //THE LOOP CONTINUES WHILE WE HAVE ANY OBJECT (Query Row) LEFT
          while($obj = $result->fetch_object()) {
              //PRINTING EACH ROW

              echo "<div id='pro1'>";

              echo "<div id='pro2'>";
              echo "<img src='img/$obj->foto.'>";
              echo "</div>";

              echo "<div id='pro3'>";
              echo "<h2><a href='descripcion.php?id_producto=$obj->id_producto'>$obj->nombre</a></h2>";
              echo "</div>";

              echo "<div id='pro4'>";
              echo "<p>EUR $obj->precio_unit</p>";
              echo "</div>";

              echo "<div id='pro7'>";
              echo "<p>STOCK $obj->stock</p>";
              echo "</div>";

              echo "<div id='pro6'>";
              echo "<p>$obj->caracteristicas</p>";
              echo "</div>";

              echo "<div id='pro5'>";
              echo "<img src='img/addcar.jpg'>";
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
