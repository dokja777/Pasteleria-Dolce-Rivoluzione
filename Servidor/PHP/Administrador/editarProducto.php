
  <?php
  $imagenExistente = "";
  include("../../../Servidor/conexion.php");

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si se ha cargado una nueva imagen
    if ($_FILES["nuevaImagenP"]["tmp_name"]) {
      $imagenP = $_FILES["nuevaImagenP"]["tmp_name"];
      $imagenData = file_get_contents($imagenP);
    } else {
      // Si no se cargó una nueva imagen, utiliza la imagen existente.
      $imagenData = $imagenExistente;
    }
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

    // Realizar la actualización en la base de datos
    $sql = "UPDATE producto SET N_PRODUCTO=?, DESCRIPCION=?, PRECIO=?, STOCK=?, ID_CATEGORIA=?, IMG=?, MEDIDA=?, ID_ADMIN=? WHERE ID_PRODUCTO=?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssdiibsii", $nombreP, $descripcionP, $precioP, $stockP, $categoriaP, $imagenData, $medidaP, $adminP, $idProducto);

    if ($stmt->execute()) {
      // JavaScript para mostrar la ventana emergente y redirigir
      echo '<script>';
      echo 'alert("Producto actualizado correctamente.");';
      echo 'window.location.href = "../../../Cliente/vistas/Administrador/listaproductos.php";';
      echo '</script>';
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
    // Aquí, obtén los datos de la imagen existente y almacénalos en $imagenExistente
    $sqlImagenExistente = "SELECT IMG FROM producto WHERE ID_PRODUCTO = ?";
    $stmtImagenExistente = $conexion->prepare($sqlImagenExistente);
    $stmtImagenExistente->bind_param("i", $idProducto);

    if ($stmtImagenExistente->execute()) {
      $stmtImagenExistente->bind_result($imagenExistente);
      $stmtImagenExistente->fetch();
      $stmtImagenExistente->close();
    }

  }
  ?>