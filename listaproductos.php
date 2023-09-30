<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="StyleLista.css">
   
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
      <h1 class="text-center" style=" background-color:black;color:white; height: 80px; "> Lista de productos</h1>
    </div>

    <!-- Tabla de lista de productos  -->
    
    <div class="container" >
    <table class="table  table-striped"   style="background-color:#f9cb9c;">
  <thead >
    <tr>
      <th scope="col">ID</th>
      <th scope="col">ADMIN</th>
      <th scope="col">NOMBRE DEL PRODUCTO</th>
      <th scope="col">CATEGORIA</th>
      <th scope="col">DESCRIPCION</th>
      <th scope="col">PRECIO</th>
      <th scope="col">STOCK</th>
      <th scope="col">ACCIONES</th>

    </tr>
  </thead>
  <tbody>


  <?php
  //  conexion para mostrar los productos
 require("config/conexion.php");

$sql = $conexion->query("SELECT producto.ID_PRODUCTO, admin.NOMBRE AS ADMIN_NOMBRE, producto.N_PRODUCTO, categoria_producto.N_CATEGORIA, producto.DESCRIPCION, producto.PRECIO, producto.STOCK
                        FROM PRODUCTO
                        INNER JOIN CATEGORIA_PRODUCTO ON PRODUCTO.ID_CATEGORIA = CATEGORIA_PRODUCTO.ID_CATEGORIA
                        INNER JOIN ADMIN ON PRODUCTO.ID_ADMIN = ADMIN.ID_ADMIN");

if ($sql) {
    while ($resultado = $sql->fetch_assoc()) {

        $idProducto = $resultado['ID_PRODUCTO'];
        $nombreAdmin = $resultado['ADMIN_NOMBRE'];
        $nombreProducto = $resultado['N_PRODUCTO'];
        $nombreCategoria = $resultado['N_CATEGORIA'];
        $descripcion = $resultado['DESCRIPCION'];
        $precio = $resultado['PRECIO'];
        $stock = $resultado['STOCK'];

        // Imprime las filas de la tabla con las columnas específicas
        echo "<tr>";
        echo "<th scope='row'>$idProducto</th>";
        echo "<td>$nombreAdmin</td>";
        echo "<th>$nombreProducto</th>";
        echo "<th>$nombreCategoria</th>";
        echo "<th>$descripcion</th>";
        echo "<th> S/ $precio </th>";
        echo "<th>$stock</th>";
        echo "<th>
        <a href='editar.php?id=$idProducto' class=\"btn btn-warning\">Editar</a>

        <a href='CRUD/eliminar.php?ID_PRODUCTO=$idProducto'class=\"btn btn-danger\">Eliminar</a>
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
    <div class="container">
        <a href="agregar.php"class="btn btn-success">Agregar producto</a>

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
