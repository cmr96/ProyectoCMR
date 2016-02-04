<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
  </head>
  <body>
    <?php printf("<h1>Insertar Producto</h1>");
    if (!isset($_POST["id_producto"])) : ?>


    <form action="" method="post" class="id_producto">
      <table border="0">

        <tr>
          <td>id_producto:  </td>
          <td>

          </td>
        </tr>
              <td>Nombre:  </td>
              <td><input type=number name='nombre' value=0 min=0 max=100 required></td>
            </tr>
            <tr>
              <td>precio_unit:  </td>
              <td><input type=number name='precio_unit' value=0 min=0 max=100 required></td>
            </tr>
            <tr>
              <td>foto:  </td>
              <td><input type=number name='foto' value=0 min=0 max=100></td>
            </tr>
            <tr>
              <td>stock:  </td>
              <td><input type=number name='stock' value=0 min=0 max=100></td>
            </tr>
            <tr>
              <td>categoria:  </td>
              <td><input type=number name='categoria' value=0 min=0 max=100></td>
            </tr>
            <tr>
            <td>caracteristicas:  </td>
            <td><textarea rows='4' cols='50' name='caracteristicas'></textarea></td>
            </tr>
            <tr>
              <td colspan="2"><input type=submit value="Entrar" id="enviar"></td>
            </tr>
            </table>
          </form>


      <?php  else: ?>

      <?php
      $connection = new mysqli("localhost", "root", "1234", "hardbyte");
      $id_producto=$_POST["id_producto"];
      $nombre=$_POST["nombre"];
      $precio_unit=$_POST["precio_unit"];
      $foto=$_POST["foto"];
      $stock=$_POST["stock"];
      $categoria=$_POST["categoria"];
      $caracteristicas=$_POST["caracteristicas"];

      $insert="INSERT INTO producto VALUES (NULL, '$id_producto', $nombre, '$precio_unit', '$foto', $stock, '$categoria', '$caracteristicas')";
      $connection->query( $insert );
      header("refresh:0; url=producto.php");

    ?>


      <?php endif ?>





  </body>
</html>
