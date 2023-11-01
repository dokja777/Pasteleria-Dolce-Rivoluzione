<?php
include('../../../Servidor/PHP/EmpleadoServidor/SessionAbierta.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <title>Document</title>
</head>

<body>
<?php include '../../../Cliente/vistas/Empleado/headerSecundario.php'; ?>
  <br>
  <div class="container">
    <h1 class="text-center" style=" background-color:black;color:white; height: 80px; font-family:var; padding-top: 12px;"> Lista de productos</h1>
  </div>

  

  <!-- Tabla de lista de productos  -->


  <div class="container">

    <form action="buscarProductoEmpleado.php" method="post" style="border: 2px solid #783f04; text-align:right; margin-bottom:10px; padding: 10px">
      <a style="margin-right:20px">Buscar por:</a>
      <select name="filtro" id="filtro" style="margin-right:10px">
        <option value="nombre">Nombre del Producto</option>
      </select>
      <input type="text" name="buscar" id="buscar" style="margin-right:10px; border-color:black;">
      <input type="submit" class="btn" style="background-color:#f9cb9c" value="Buscar">
    </form>

    <div class="container ">


    </div>

    <table class="table  table-striped" style="background-color:#f9cb9c; font-family:var; text-align:justify;">
      <thead>
        <tr  >
          <th scope="col" style="background-color:#f9cb9c;">ID</th>
          <th scope="col" style="background-color:#f9cb9c;">NOMBRE DEL PRODUCTO</th>
          <th scope="col" style="background-color:#f9cb9c;">CATEGORIA</th>
          <th scope="col" style="background-color:#f9cb9c;">IMAGEN</th>
          <th scope="col" style="background-color:#f9cb9c;">DESCRIPCION</th>
          <th scope="col" style="background-color:#f9cb9c;">PRECIO</th>
          <th scope="col" style="background-color:#f9cb9c;">STOCK</th>
          <th scope="col" style="background-color:#f9cb9c;">MEDIDA DEL PASTEL</th>
          <th scope="col" style="background-color:#f9cb9c;">ACCIONES</th>

        </tr>
      </thead>
      <tbody>


        <?php
        //  conexion para mostrar los productos
        require("../../../Config/conexion.php");

        $sql = $conexion->query("SELECT producto.ID_PRODUCTO, admin.NOMBRE AS ADMIN_NOMBRE, producto.N_PRODUCTO, categoria_producto.N_CATEGORIA, producto.DESCRIPCION, producto.IMG, producto.PRECIO, producto.STOCK, producto.MEDIDA
 FROM PRODUCTO
 INNER JOIN CATEGORIA_PRODUCTO ON PRODUCTO.ID_CATEGORIA = CATEGORIA_PRODUCTO.ID_CATEGORIA
 INNER JOIN ADMIN ON PRODUCTO.ID_ADMIN = ADMIN.ID_ADMIN");

        if ($sql) {
          while ($resultado = $sql->fetch_assoc()) {

            $idProducto = $resultado['ID_PRODUCTO'];
            $nombreProducto = $resultado['N_PRODUCTO'];
            $nombreCategoria = $resultado['N_CATEGORIA'];
            $imagen = $resultado['IMG'];
            $descripcion = $resultado['DESCRIPCION'];
            $precio = $resultado['PRECIO'];
            $stock = $resultado['STOCK'];
            $medida = $resultado['MEDIDA'];

            // Imprime las filas de la tabla con las columnas específicas
            echo "<tr  data-aos=\"zoom-in-up\"  >";
            echo "<th scope='row' style='background-color:#f9cb9c;'>$idProducto</th>";
            echo "<td style='background-color:#f9cb9c;'>$nombreProducto</td>";
            echo "<td style='background-color:#f9cb9c;'>$nombreCategoria</td>";
            echo "<td style='background-color:#f9cb9c;'><img  style='width: 120px; border-radius: 30px;'  src='data:image/jpg;base64," . base64_encode($imagen) . "'></td>";
            echo "<td style='background-color:#f9cb9c;'>$descripcion</td>";
            echo "<td style='background-color:#f9cb9c;' > S/ $precio </td>";
            echo "<td style='background-color:#f9cb9c;' >$stock</td>";
            echo "<td style='background-color:#f9cb9c;' >$medida</td>";
            echo "<th  style='background-color:#f9cb9c;'>
        <a href='../../../Cliente/vistas/Empleado/editarProductoEm.php?id=$idProducto' class=\"btn btn-warning\"> <i class='fas fa-edit'></i></a>
        <br>
      </th>";
            echo "</tr>";
          }
        } else {
          // Maneja el error si la consulta no se ejecuta correctamente
          echo "Error en la consulta: " . $conexion->error;
        }

        // Cierra la conexión a la base de datos cuando hayas terminado
        $conexion->close();
        ?>

      </tbody>
    </table>


  </div>



  <style>
    tbody td{
      background-color:#f9cb9c;
    }
    .container {
      font-family: monospace;
      margin-top: 1em;
      margin-bottom: 1em;
      border-radius: 1em;
    }

    .container a {
      letter-spacing: 3px
    }
  </style>

  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>

</body>

</html>