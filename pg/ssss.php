

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
  margin-top: 15px;
  margin-bottom: 15px;
  margin-left: 30px;
  overflow: auto;
  width: 260px;
  height: 340px;
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
  margin-left: 50px;
  margin-top: 10px;
  float: left;
  display: inline;
}
#pro2 img {
  width: 160px;
  height: 160px;
  border-radius: 15px;
}
#pro3 {
  width: 230px;
  background-color: white;
  margin: 15 auto auto 15;
  float: left;
  display: inline;
  height: auto;
  overflow: auto;
}
#pro3 h2 {
  margin-top: 5px;
  margin-left: 5px;
  text-align: center;
}
#pro3 h2 a {
  color: black;
  text-decoration: none;
  font-size: 20px;
  text-align: center;
}
#pro4 {
  width: 80px;
  height: 26px;
  color: black;
  margin: 280 auto auto auto;
  border-radius: 10px;
  border: 1px solid #000000;
  background-color: #0C5484;
  display: block;
  text-align: center;
}
#pro4 h2{
  margin-left: 5px;
  margin-top: 0px;
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

                echo "<div id='pro3'>";
                echo "<h2><a href='pedido.php'>$obj->nombre</a></h2>";
                echo "</div>";

                echo "<div id='pro4'>";
                echo "<h2>";
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
