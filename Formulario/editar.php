<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Editar producto</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 800px;
      margin: 20px auto;
      padding: 20px;
      background-color: #fff;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .header {
      text-align: center;
      color: #333;
      background-color: black;
      color: white;
      height: 80px;
      font-family: var;
    }

    h1 {
      text-align: center;
    }

    .sub-header {
      text-align: center;
      color: #333;
    }

    form {
      margin-top: 20px;
    }

    label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    input[type="text"],
    select {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    #descripcionP {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      max-height: 200px;
      overflow-y: auto;
    }

    button {
      display: block;
      width: 100%;
      padding: 10px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    button:hover {
      background-color: #0056b3;
    }

    .img-preview {
      max-width: 100%;
      max-height: 400px;
      width: auto;
      height: auto;
      margin-bottom: 10px;
    }
  </style>
</head>

<body>
  <?php
  $imagenExistente = "";
  include("../config/conexion.php");

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idProducto = $_POST["idProducto"];
    $nombreP = $_POST["nombreP"];
    $descripcionP = $_POST["descripcionP"];
    $precioP = $_POST["precioP"];
    $stockP = $_POST["stockP"];
    $categoriaP = $_POST["categoriaP"];
    $medidaP = $_POST["medidaP"];
    $adminP = $_POST["adminP"];

    // Asegurar y validar los datos (ejemplo utilizando MySQLi)
    $nombreP = mysqli_real_escape_string($conexion, $nombreP);
    $descripcionP = mysqli_real_escape_string($conexion, $descripcionP);
    $precioP = floatval($precioP);
    $stockP = intval($stockP);
    $categoriaP = intval($categoriaP);
    $medidaP = mysqli_real_escape_string($conexion, $medidaP);
    $adminP = intval($adminP);

    // Manejo de la imagen
    if (!empty($_FILES["imagenP"]["tmp_name"])) {
      $imagenP = $_FILES["imagenP"]["tmp_name"];
      $imagenData = file_get_contents($imagenP);
    } else {
      $imagenData = $imagenExistente;
    }

    // Realizar la actualización en la base de datos
    $sql = "UPDATE producto SET N_PRODUCTO=?, DESCRIPCION=?, PRECIO=?, STOCK=?, ID_CATEGORIA=?, IMG=?, MEDIDA=?, ID_ADMIN=? WHERE ID_PRODUCTO=?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssdibisii", $nombreP, $descripcionP, $precioP, $stockP, $categoriaP, $imagenData, $medidaP, $adminP, $idProducto);

    if ($stmt->execute()) {
      echo "Producto actualizado correctamente.";
    } else {
      echo "Error al actualizar el producto: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
  } else {
    $idProducto = $_GET["id"];
    $sql = "SELECT p.N_PRODUCTO, p.DESCRIPCION, p.PRECIO, p.STOCK, p.ID_CATEGORIA, p.IMG, c.N_CATEGORIA, p.MEDIDA, a.NOMBRE AS NOMBRE_ADMIN, p.ID_ADMIN 
            FROM producto p
            INNER JOIN categoria_producto c ON p.ID_CATEGORIA = c.ID_CATEGORIA
            INNER JOIN admin a ON p.ID_ADMIN = a.ID_ADMIN
            WHERE p.ID_PRODUCTO = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $idProducto);

    if ($stmt->execute()) {
      $stmt->bind_result($nombreP, $descripcionP, $precioP, $stockP, $categoriaP, $imagenData, $categoriaDescripcion, $medidaP, $adminNombre, $adminP);
      $stmt->fetch();
      $stmt->close();
    }
  }
  ?>

  <!-- Agregar este bloque de código PHP para mostrar información antes del envío -->

  <div class="container">
    <h1>Editar Producto</h1>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      echo "<div class='container'>";
      echo "<h2>Información antes de enviar el formulario:</h2>";
      echo "<p>Nombre Producto: " . htmlspecialchars($nombreP) . "</p>";
      echo "<p>Descripción: " . htmlspecialchars($descripcionP) . "</p>";
      echo "<p>Precio: " . $precioP . "</p>";
      echo "<p>Stock: " . $stockP . "</p>";
      echo "<p>Categoría (ID): " . $categoriaP . "</p>";
      echo "<p>Medida: " . htmlspecialchars($medidaP) . "</p>";
      echo "<p>Admin: " . $adminP . "</p>";
      echo "</div>";
    }
    ?>

    <form action="editar.php" method="POST" enctype="multipart/form-data">
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
      <?php endif; ?>
      <input type="file" id="imagenP" name="imagenP">

      <button type="submit" class="btn-primary">Guardar Cambios</button>
    </form>
  </div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
</body>

</html>