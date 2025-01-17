<?php
// listaProductos.php
include('../../../Servidor/conexion.php');
// Obtener los valores de los filtros desde las variables
$valorCodigo = isset($_GET['codigo']) ? $_GET['codigo'] : '';
$valorNombre = isset($_GET['nombre']) ? $_GET['nombre'] : '';
$valorStock = isset($_GET['stock']) ? $_GET['stock'] : '';
$valorCategoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';

// Definir la cantidad de productos por página
$productosPorPagina = isset($_GET['cantidad']) ? $_GET['cantidad'] : 10;

// Obtener el número de página actual desde la URL
$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

// Calcular el límite y el desplazamiento para la consulta SQL
$limite = $productosPorPagina;
$desplazamiento = ($pagina - 1) * $productosPorPagina;

// Construir la consulta SQL
$sql = "SELECT producto.ID_PRODUCTO, admin.NOMBRE AS ADMIN_NOMBRE, producto.N_PRODUCTO, categoria_producto.N_CATEGORIA, producto.DESCRIPCION, producto.IMG, producto.PRECIO, producto.STOCK, producto.MEDIDA
    FROM PRODUCTO
    INNER JOIN CATEGORIA_PRODUCTO ON PRODUCTO.ID_CATEGORIA = CATEGORIA_PRODUCTO.ID_CATEGORIA
    LEFT JOIN ADMIN ON PRODUCTO.ID_ADMIN = ADMIN.ID_ADMIN
    WHERE 1";

if (!empty($valorCodigo)) {
    $sql .= " AND producto.ID_PRODUCTO LIKE '%$valorCodigo%'";
}

if (!empty($valorNombre)) {
    $sql .= " AND producto.N_PRODUCTO LIKE '%$valorNombre%'";
}

if (!empty($valorStock)) {
    $sql .= " AND producto.STOCK >= $valorStock";
}

if (!empty($valorCategoria)) {
    $sql .= " AND producto.ID_CATEGORIA = $valorCategoria";
}

// LIMIT y OFFSET para la paginación
$sql .= " ORDER BY producto.ID_PRODUCTO";
$sql .= " LIMIT $limite OFFSET $desplazamiento";

$query = $conexion->query($sql);

if ($sql) {
    while ($resultado = $query->fetch_assoc()) {
        // (Tu código para mostrar los productos aquí)
        $idProducto = $resultado['ID_PRODUCTO'];
        $nombreAdmin = $resultado['ADMIN_NOMBRE'];
        $nombreProducto = $resultado['N_PRODUCTO'];
        $nombreCategoria = $resultado['N_CATEGORIA'];
        $imagen = $resultado['IMG'];
        $descripcion = $resultado['DESCRIPCION'];
        $precio = $resultado['PRECIO'];
        $stock = $resultado['STOCK'];
        $medida = $resultado['MEDIDA'];

        // Imprime las filas de la tabla con las columnas específicas
        echo "<tr data-aos=\"zoom-in-up\">";
        echo "<th scope='row'>$idProducto</th>";
        echo "<td>$nombreAdmin</td>";
        echo "<td>$nombreProducto</td>";
        echo "<td>$nombreCategoria</td>";
        echo "<td><img style='width: 120px; border-radius: 30px;' src='data:image/jpg;base64," . base64_encode($imagen) . "'></td>";
        echo "<td>$descripcion</td>";
        echo "<td> S/ $precio </td>";
        echo "<td>$stock</td>";
        echo "<td>$medida</td>";
        echo "<th>
        <a href='../../../Cliente/vistas/Administrador/editarProducto.php?id=$idProducto' class=\"btn btn-warning\">Editar</a>
        <br>
        <br>
        <a href='../../../Servidor/PHP/Administrador/eliminarProducto.php?ID_PRODUCTO=$idProducto' class=\"btn btn-danger\">Eliminar</a>
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