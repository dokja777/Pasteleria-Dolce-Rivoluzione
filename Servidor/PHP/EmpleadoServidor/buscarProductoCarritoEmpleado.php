<?php
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
$sql = "SELECT producto.ID_PRODUCTO, producto.N_PRODUCTO, categoria_producto.N_CATEGORIA, producto.DESCRIPCION, producto.IMG, producto.PRECIO, producto.STOCK, producto.MEDIDA
    FROM PRODUCTO
    INNER JOIN CATEGORIA_PRODUCTO ON PRODUCTO.ID_CATEGORIA = CATEGORIA_PRODUCTO.ID_CATEGORIA
    WHERE 1";

if(!empty($valorCodigo)) {
    $sql .= " AND producto.ID_PRODUCTO LIKE '%$valorCodigo%'";
}

if(!empty($valorNombre)) {
    $sql .= " AND producto.N_PRODUCTO LIKE '%$valorNombre%'";
}

if(!empty($valorStock)) {
    $sql .= " AND producto.STOCK >= $valorStock";
}

if(!empty($valorCategoria)) {
    $sql .= " AND producto.ID_CATEGORIA = $valorCategoria";
}

// LIMIT y OFFSET para la paginación
$sql .= " ORDER BY producto.ID_PRODUCTO";
$sql .= " LIMIT $limite OFFSET $desplazamiento";

$query = $conexion->query($sql);

if($sql) {
    while($resultado = $query->fetch_assoc()) {
        // (Tu código para mostrar los productos aquí)
        $idProducto = $resultado['ID_PRODUCTO'];
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
        echo "<td>$nombreProducto</td>";
        echo "<td>$nombreCategoria</td>";
        echo "<td><img style='width: 120px; border-radius: 30px;' src='data:image/jpg;base64,".base64_encode($imagen)."'></td>";
        echo "<td>$descripcion</td>";
        echo "<td> S/ $precio </td>";
        echo "<td>$stock</td>";
        echo "<td>$medida</td>";
        echo "<th>
        <button class=\"btn btn-warning agregar-carrito\" data-id=\"$idProducto\">Agregar Producto</button>
                        <br>
                        <br>
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
for($i = 1; $i <= $totalPaginas; $i++) {
    $active = $i == $pagina ? 'active' : '';
    echo "<a class='btn btn-secondary $active' href='agregarPedido.php?pagina=$i'>$i</a>";
}
echo '</div>';



// Cierra la conexión a la base de datos cuando hayas terminado
$conexion->close();
?>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
  $(document).ready(function() {
    // Manejar el clic en el botón "Agregar Producto"
    $('.agregar-carrito').on('click', function() {
      // Obtener el ID del producto desde el atributo data
      var idProducto = $(this).data('id');

      // Realizar una solicitud AJAX para agregar el producto al carrito
      $.ajax({
        type: 'POST',
        url: '../../../Servidor/PHP/EmpleadoServidor/agregarProductoCarritoEmpleado.php', // Reemplaza con la ruta correcta
        data: { idProducto: idProducto },
        success: function(response) {
          // Manejar la respuesta si es necesario
          console.log('Producto agregado al carrito:', response);
          var currentUrl = window.location.href;
                window.location.href = currentUrl;
          // Puedes actualizar el número total en el carrito si es necesario
        },
        error: function(error) {
          console.error('Error al agregar al carrito:', error);
        }
      });
    });
  });
</script>


