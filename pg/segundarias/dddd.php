

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
  margin-top: 7.5px;
  margin-bottom: 7.5px;
  margin-left: 15px;
  overflow: auto;
  width: 130px;
  height: 170px;
  background-color: #FFFFFF;
  border: 2px solid black;
  float: left;
  display: inline;
  border-radius: 4px;
}
#pro2 {
  width: 80px;
  height: 80px;
  background-color: white;
  margin-left: 25px;
  margin-top: 5px;
  float: left;
  display: inline;
}
#pro2 img {
  width: 80px;
  height: 80px;
  border-radius: 7.5px;
}
#pro3 {
  width: 115px;
  background-color: white;
  margin: 7.5 auto auto 7.5;
  float: left;
  display: inline;
  height: auto;
  overflow: auto;
}
#pro3 h2 {
  margin-top: 2.5px;
  margin-left: 2.5px;
  text-align: center;
}
#pro3 h2 a {
  color: black;
  text-decoration: none;
  font-size: 10px;
  text-align: center;
}
#pro4 {
  width: 40px;
  height: 13px;
  color: black;
  margin: 147 auto auto auto;
  border-radius: 10px;
  border: 1px solid #000000;
  background-color: #0C5484;
  display: block;
  text-align: center;
}
#pro4 h2{
  margin-left: 2.5px;
  margin-top: 0px;
  font-size: 10px;
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
