<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
   
</head>
    <title>Lista producto</title>
</head>
<body style="background-color:#EAE6CA;">

    <!-- Configuración del navbar user y lista -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color:#f9cb9c;">
  <div class="container-fluid">
  <img src="img/logo.png" alt="" style="width:5em ;margin-botton:1em;">
    <a class="navbar-brand" href="indexAdministrador.php"  style="font-family:var;color:#783f04;margin-left:1em;font-weight:600;font-size:22px;">Pastelería Dolce Rivoluzione</a>
    
    <div class="collapse navbar-collapse" id="bar" >
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="btn btn-outline-light" href="indexAdministrador.php"  aria-current="page"  style="color:#783f04;margin-left:3em;font-weight:600;">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-outline-light" href="pedidos.php" style="margin-left:2em;color:#783f04;font-weight:600;">Pedidos</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-outline-light" href="listaproductos.php"  style="color:#783f04;margin-left:2em;font-weight:600;" >Productos </a>
        </li>
        <li class="nav-item">
          <a class="btn btn-outline-light" href="listarAdministrador.php" style="color:#783f04;margin-left:2em;font-weight:600;" >Usuarios</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-outline-light" href="listarEmpleados.php" style="color:#783f04;margin-left:2em;font-weight:600;" >Empleados</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-outline-light" href="demanda.php" style="color:#783f04;margin-left:2em;font-weight:600;">Demandas</a>
        </li>
        <li class="nav-item">
          <a  class="btn btn-outline-light"  href="ingreso.php" style="color:#783f04;margin-left:2em;font-weight:600;">Ingresos</a>
        </li>
      </ul>
     
    </div>
  </div>
</nav>
   
  <style>
    #bar a{
        border-style:none;
        background-color:;
        border-radius:10px;
    }
  </style>

  
    <!-- Tabla de  lista de  producto  titulo -->
    <br>
    <div class="container">
      <h1 class="text-center" style=" background-color:black;color:white; height: 80px; font-family:var; padding-top: 12px;"> Lista de productos</h1>
    </div>

    <!-- Tabla de lista de productos  -->
    
    
    <div class="container" >

          <form action="buscar.php" method="post" style="border: 2px solid #783f04; text-align:right; margin-bottom:10px; padding: 10px">
                <a style="margin-right:20px">Buscar por:</a>
                <select name="filtro" id="filtro" style="margin-right:10px">
                    <option value="nombre">Nombre del Producto</option>
                </select>
                <input type="text" name="buscar" id="buscar" style="margin-right:10px; border-color:black;">
                <input type="submit" class="btn" style="background-color:#f9cb9c" value="Buscar">
            </form>

        <div class="container ">
        <a href="agregar.php"class="btn btn-success">Agregar producto</a>
   
    </div>

    <table class="table  table-striped"   style="background-color:#f9cb9c; font-family:var; text-align:justify;">
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
      <th scope ="col">MEDIDA DEL PASTEL</th>
      <th scope="col">ACCIONES</th>

    </tr>
  </thead>
      <tbody>
      <?php
    include('../../../Servidor/conexion.php');
    // Definir la cantidad de productos por página
    $productosPorPagina = 5;

    // Obtener el número de página actual desde la URL
    $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

    // Calcular el límite y el desplazamiento para la consulta SQL
    $limite = $productosPorPagina;
    $desplazamiento = ($pagina - 1) * $productosPorPagina;

    // Consulta SQL con LIMIT y OFFSET para la paginación
    $sql = $conexion->query("SELECT producto.ID_PRODUCTO, admin.NOMBRE AS ADMIN_NOMBRE, producto.N_PRODUCTO, categoria_producto.N_CATEGORIA, producto.DESCRIPCION, producto.IMG, producto.PRECIO, producto.STOCK, producto.MEDIDA
                             FROM PRODUCTO
                             INNER JOIN CATEGORIA_PRODUCTO ON PRODUCTO.ID_CATEGORIA = CATEGORIA_PRODUCTO.ID_CATEGORIA
                             INNER JOIN ADMIN ON PRODUCTO.ID_ADMIN = ADMIN.ID_ADMIN
                             LIMIT $limite OFFSET $desplazamiento");

    if ($sql) {
        while ($resultado = $sql->fetch_assoc()) {
            // (Tu código para mostrar los productos aquí)
            $idProducto = $resultado['ID_PRODUCTO'];
            $nombreAdmin = $resultado['ADMIN_NOMBRE'];
            $nombreProducto = $resultado['N_PRODUCTO'];
            $nombreCategoria = $resultado['N_CATEGORIA'];
            $imagen = $resultado['IMG'];
            $descripcion = $resultado['DESCRIPCION'];
            $precio = $resultado['PRECIO'];
            $stock = $resultado['STOCK'];
            $medida=$resultado['MEDIDA'];

            // Imprime las filas de la tabla con las columnas específicas
            echo "<tr  data-aos=\"zoom-in-up\"  >";
            echo "<th scope='row'>$idProducto</th>";
            echo "<td>$nombreAdmin</td>";
            echo "<td>$nombreProducto</td>";
            echo "<td>$nombreCategoria</td>";
            echo "<td><img  style='width: 120px; border-radius: 30px;'  src='data:image/jpg;base64," . base64_encode($imagen) . "'></td>";
            echo "<td>$descripcion</td>";
            echo "<td> S/ $precio </td>";
            echo "<td>$stock</td>";
            echo "<td>$medida</td>";
            echo "<th>
            <a href='Formulario/editar.php?id=$idProducto' class=\"btn btn-warning\">Editar</a>
            <br>
            <br>
            <a href='CRUD/eliminar.php?ID_PRODUCTO=$idProducto'class=\"btn btn-danger\">Eliminar</a>
            </th>";
            echo "</tr>";
        }
    }

        // Calcular la cantidad total de páginas
        $sqlTotal = $conexion->query("SELECT COUNT(*) as total FROM PRODUCTO");
        $totalProductos = $sqlTotal->fetch_assoc()['total'];
        $totalPaginas = ceil($totalProductos / $productosPorPagina);

        // Mostrar enlaces de paginación
        echo '<div class="container">';
        for ($i = 1; $i <= $totalPaginas; $i++) {
            $active = $i == $pagina ? 'active' : '';
            echo "<a class='btn btn-secondary $active' href='listaproductos.php?pagina=$i'>$i</a>";
        }
        echo '</div>';

        // Cierra la conexión a la base de datos cuando hayas terminado
        $conexion->close();
        ?>



      </tbody>
    </table>
    

    </div>



  <style>
    .container{
        font-family: monospace;
    margin-top:1em;
    margin-bottom:1em;
   border-radius:1em;
    }

.container a{
    letter-spacing: 3px
 }
  </style>   
        
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>

    <!-- Incluir Bootstrap JS y jQuery (opcional) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
