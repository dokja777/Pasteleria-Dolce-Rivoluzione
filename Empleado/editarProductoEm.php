<?php
include('../Empleado/SessionAbierta.php');
?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/styleAdmin.css">
  <title>Editar producto</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

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
<?php include '../headerEmpleado.php';?>
  <?php
  $imagenExistente = "";
  include("../config/conexion.php");

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si se ha cargado una nueva imagen
    
    $idProducto = $_POST["idProducto"];
    $stockP = $_POST["stockP"];
   

    // Asegurar y validar los datos (ejemplo utilizando MySQLi)
   
    $stockP = intval($stockP);
    

    // Realizar la actualización en la base de datos
    $sql = "UPDATE producto SET  STOCK=? WHERE ID_PRODUCTO=?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ii",  $stockP, $idProducto);

    if ($stmt->execute()) {
      // JavaScript para mostrar la ventana emergente y redirigir
      echo '<script>';
      echo 'alert("Producto actualizado correctamente.");';
      echo 'window.location.href = "../Empleado/productoEmpleado.php";';
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

  <!-- Agregar este bloque de código PHP para mostrar información antes del envío -->

  <div class="container">
    <h1>Editar Stock</h1>


    <form action="../Empleado/editarProductoEm.php" method="POST">
  <input type="hidden" name="idProducto" value="<?php echo $idProducto; ?>">

  <label for="stockP">Stock</label>
  <input type="text" id="stockP" name="stockP" value="<?php echo $stockP; ?>">

  <button type="submit" class="btn-primary">Guardar Cambios</button>
</form>
  </div>

  <script src="../js/inicioAdministrador.js"></script>


</body>

</html>