<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="hardbytecss.css"/> <!-- CAMBIA -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>

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
  width: 1000px;
  height: 180px;
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
  margin-top: 10px;
  float: left;
  display: inline;
}
#pro2 img {
  width: 160px;
  height: 160px;
  border-radius: 7.5px;
}
#pro3 {
  width: 700px;
  background-color: white;
  margin: 10 auto auto 70;
  float: left;
  display: inline;
  height: 30px;
}
#pro3 h2 {
}
#pro3 h2 a {
  color: black;
  font-size: 20px;
  text-align: center;
  margin: 0 0 0 0;
}
#pro4 {
  width: 80px;
  height: 40px;
  color: #B12704;
  margin: 70 auto auto 260;
  display: block;
}
#pro5 {
  width: 221px;
  height: 75px;
  background-color: white;
  margin-left: 770px;
  margin-top: -120px;
  float: left;
  display: inline;
}
#pro5 img {
  width: 75px;
  height: 75px;
}
#pro7 {
  width: 140px;
  height: 30px;
  color: #008a00;
  margin: -20 auto auto 260;
  display: block;
  font-size: 20px;
}
#medio {
  overflow: auto;
  height: auto;
}
#encabezado {
  height: 62px;
}
.tot {
  width: 300px;
  height: 120px;
  background-color: #0C5484;
  display: inline-block;
  margin-right: 15px;
  margin-top: 5px;
  border: 2px solid black;
  border-radius: 4px;
  float: right;
}
.tot2 {
  width: 300px;
  height: 60px;
  background-color: green;
  display: inline-block;
  margin-right: 15px;
  margin-top: 5px;
  border: 2px solid black;
  border-radius: 4px;
  float: right;
}
.tot3 {
  width: 300px;
  height: 60px;
  background-color: #EF0506;
  display: inline-block;
  margin-right: 15px;
  margin-top: 5px;
  border: 2px solid black;
  border-radius: 4px;
  float: right;
}
.tot p {
  margin: 35 65 auto;
  font-size: 28px;
  color: white;
  font-family: 'Montserrat', sans-serif;
}
.tot2 p {
  margin: 10 40 auto;
  font-size: 25px;
  color: white;
  font-family: 'Montserrat', sans-serif;
}
.tot3 p {
  margin: 10 100 auto;
  font-size: 25px;
  color: white;
  font-family: 'Montserrat', sans-serif;
}
.tot3 p a {
    text-decoration: none;
    color: white;
}


</style>

<?PHP
  session_start();
  $connection = new mysqli("localhost", "root", "1234", "hardbyte");
  $sumatotal=0;
  foreach($_SESSION['carrito'] as $id => $cantidad){
        if($cantidad > 0){
        if ($result = $connection->query("SELECT * FROM producto WHERE id_producto='$id'")) {
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
              echo "<p>Cantidad: $cantidad</p>";
              echo "</div>";

              echo "<div id='pro5'>";
              echo "<a href='borrarcarrito.php?id_producto=$obj->id_producto'><img src='img/delete.jpg'></a>";
              echo "</div>";

              echo "</div>";
              $sumatotal= $sumatotal + ($obj->precio_unit * $cantidad);
            }
          }


  }
}


?>

<div class="tot">
  <p>
      <?PHP
        echo "Total: ".$sumatotal." €";
      ?>
  </p>
</div>
<div class="tot3">
  <p><a href="home.php">Volver</a></p>
</div>

<div class="tot2">
  <p><a href="tramitar.php?sumatotal=$sumatotal">Tramitar Pedido</a></p>
</div>
