<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../StyleLista.css">
   
</head>
    <title>Lista producto</title>
</head>
<body>

    <!-- Configuración del navbar user y lista -->
    <div class="navbar">
        <div class="navbar-left">
            <div class="menu-icon" onclick="toggleMenu()">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>
        </div>
        <div class="navbar-right">
            <i class="fas fa-user"></i>
        </div>
    </div>


<!-- tabla nomrbes -->
    <div class="menu" id="menu">
        <!-- Coloca aquí los elementos de menú -->
        <a href="#">Inicio</a>
        <a href="#">Acerca de</a>
        <a href="#">Servicios</a>
        <a href="#">Contacto</a>
    </div>
  
    <!-- Tabla de  lista de  producto  titulo -->
    <br>
    <div class="container">
      <h1 class="text-center" style=" background-color:black;color:white; height: 80px; font-family:var;"> Lista de productos</h1>
    </div>

    <!-- Tabla de lista de productos  -->
    
    <div class="container" >

        <<form action="buscarProductoEmpleado.php" method="post" style="border: 2px solid #783f04; text-align:right; margin-bottom:10px; padding: 10px">
            <a style="margin-right:20px">Buscar por:</a>
            <select name="filtro" id="filtro" style="margin-right:10px">
                <option value="nombre">Nombre del Producto</option>
            </select>
            <input type="text" name="buscar" id="buscar" style="margin-right:10px; border-color:black;">
            <input type="submit" class="btn" style="background-color:#f9cb9c" value="Buscar">
        </form>

    <table class="table  table-striped"   style="background-color:#f9cb9c; font-family:var;">
  <thead >
    <tr>
      <th scope="col">ID</th>
      <th scope="col">ADMIN</th>
      <th scope="col">NOMBRE DEL PRODUCTO</th>
      <th scope="col">CATEGORIA</th>
      <th scope="col">IMAGEN</th>
      <th scope="col">DESCRIPCION</th>
      <th scope="col">PRECIO</th>
      <th scope="col">STOCK</th>
      <th scope="col">ACCIONES</th>

    </tr>
  </thead>
  <tbody>


  <?php
require("../config/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $buscar = mysqli_real_escape_string($conexion, $_POST['buscar']);

    // Consulta para buscar por nombre de producto y mostrar coincidencias
    $sql = "SELECT producto.ID_PRODUCTO, admin.NOMBRE AS ADMIN_NOMBRE, producto.N_PRODUCTO, categoria_producto.N_CATEGORIA, producto.DESCRIPCION, producto.IMG, producto.PRECIO, producto.STOCK
            FROM PRODUCTO
            INNER JOIN CATEGORIA_PRODUCTO ON PRODUCTO.ID_CATEGORIA = CATEGORIA_PRODUCTO.ID_CATEGORIA
            INNER JOIN ADMIN ON PRODUCTO.ID_ADMIN = ADMIN.ID_ADMIN
            WHERE producto.N_PRODUCTO LIKE '%$buscar%'";

    $result = $conexion->query($sql);

    if ($result) {
        while ($resultado = $result->fetch_assoc()) {
            $idProducto = $resultado['ID_PRODUCTO'];
            $nombreAdmin = $resultado['ADMIN_NOMBRE'];
            $nombreProducto = $resultado['N_PRODUCTO'];
            $nombreCategoria = $resultado['N_CATEGORIA'];
            $imagen = $resultado['IMG'];
            $descripcion = $resultado['DESCRIPCION'];
            $precio = $resultado['PRECIO'];
            $stock = $resultado['STOCK'];

            // Imprime las filas de la tabla con las columnas específicas
            echo "<tr>";
            echo "<th scope='row'>$idProducto</th>";
            echo "<td>$nombreAdmin</td>";
            echo "<td>$nombreProducto</td>";
            echo "<td>$nombreCategoria</td>";
            echo "<td><img  style='width: 120px; border-radius: 30px;'  src='data:image/jpg;base64," . base64_encode($imagen) . "'></td>";
            echo "<td>$descripcion</td>";
            echo "<td> S/ $precio </td>";
            echo "<td>$stock</td>";
            echo "<th>
            <a href='Formulario/editar.php?id=$idProducto' class=\"btn btn-warning\">Editar</a>
            <br>
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
}
?>

        </tbody>
    </table>
    <div class="container">
        <a href="../agregar.php"class="btn btn-success">Agregar producto</a>

    </div>

    </div>

  <style>
    .container{
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
}
  </style>



    

    <!-- Script de hambuerguesa -Lista -->
    <script>
        function toggleMenu() {
            var menu = document.getElementById('menu');
            menu.classList.toggle('active');
        }
    </script>
    


    <!-- Incluir Bootstrap JS y jQuery (opcional) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
