<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../../../Cliente/css/productosAdmin.css">
  <title>Editar producto</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>

  
</head>

<body>
    <?php
        include('../../../Servidor/PHP/Administrador/editarProducto.php');
    ?>

  <!-- Agregar este bloque de código PHP para mostrar información antes del envío -->

  <div class="container">
    <h1>Editar Producto</h1>


    <form action="../../../Servidor/PHP/Administrador/editarProducto.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="idProducto" value="<?php echo $idProducto; ?>">

      <label for="nombreP">Nombre Producto</label>
      <input type="text" id="nombreP" name="nombreP" value="<?php echo $nombreP; ?>">

      <label for="descripcionP">Descripción</label>
      <textarea id="descripcionP" name="descripcionP"><?php echo $descripcionP; ?></textarea>

      <label for="precioP">Precio</label>
      <input type="text" id="precioP" name="precioP" value="<?php echo $precioP; ?>">

      <label for="stockP">Stock</label>
      <input type="text" id="stockP" name="stockP" value="<?php echo $stockP; ?>">

      <label for="categoriaP">Categoría</label>
      <select id="categoriaP" name="categoriaP">
        <?php
        // Obtener todas las categorías de la base de datos
        $sqlCategorias = "SELECT ID_CATEGORIA, N_CATEGORIA FROM categoria_producto";
        $resultCategoria = $conexion->query($sqlCategorias);
        while ($rowCategoria = $resultCategoria->fetch_assoc()) {
          $categoriaID = $rowCategoria["ID_CATEGORIA"];
          $categoriaDescripcion = $rowCategoria["N_CATEGORIA"];
          $selectedCategoria = ($categoriaID == $categoriaP) ? "selected" : "";
          echo "<option value='$categoriaID' $selectedCategoria>$categoriaDescripcion</option>";
        }
        ?>
      </select>

      <label for="medidaP">Medida</label>
      <input type="text" id="medidaP" name="medidaP" value="<?php echo $medidaP; ?>">

      <label for="adminP">Admin</label>
      <select id="adminP" name="adminP">
        <?php
        // Obtener todos los administradores de la base de datos
        $sqlAdmins = "SELECT ID_ADMIN, NOMBRE FROM admin";
        $resultAdmins = $conexion->query($sqlAdmins);
        while ($rowAdmin = $resultAdmins->fetch_assoc()) {
          $adminID = $rowAdmin["ID_ADMIN"];
          $adminNombre = $rowAdmin["NOMBRE"];
          $selectedAdmin = ($adminID == $adminP) ? "selected" : "";
          echo "<option value='$adminID' $selectedAdmin>$adminNombre</option>";
        }
        ?>
      </select>

      <label for="imagenP">Imagen (JPG, JPEG o PNG)</label>
      <?php if (!empty($imagenData)): ?>
        <img src="data:image/jpeg;base64,<?php echo base64_encode($imagenData); ?>" alt="Imagen" class="img-preview">
        <input type="file" id="nuevaImagenP" name="nuevaImagenP">
      <?php else: ?>
        <input type="file" id="imagenP" name="imagenP">
      <?php endif; ?>

      <button type="submit" class="btn-primary">Guardar Cambios</button>
    </form>
  </div>



</body>

</html>