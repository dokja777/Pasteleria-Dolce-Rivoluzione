

<?php
// listaProductos.php
include('../../../Servidor/conexion.php');
// Obtener los valores de los filtros desde las variables
$valorCliente = isset($_GET['cliente']) ? $_GET['cliente'] : '';

// Definir la cantidad de productos por página
$productosPorPagina = isset($_GET['cantidad']) ? $_GET['cantidad'] : 5;

// Obtener el número de página actual desde la URL
$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

// Calcular el límite y el desplazamiento para la consulta SQL
$limite = $productosPorPagina;
$desplazamiento = ($pagina - 1) * $productosPorPagina;

// Construir la consulta SQL
$sql = "SELECT pedido.ID_PEDIDO, cliente.NOMBRE AS CLIENTE_NOMBRE, empleado.N_EMPLEADO AS EMPLEADO_NOMBRE, pedido.FECHA, pedido.MONTO_FINAL, pedido.METODO_PAGO, pedido.ESTADO 
    FROM pedido
    INNER JOIN cliente ON pedido.ID_CLIENTE = cliente.ID_CLIENTE
    INNER JOIN empleado ON pedido.ID_EMPLEADO = empleado.ID_EMPLEADO
    WHERE 1";


if (!empty($valorCliente)) {
    $sql .= " AND cliente.NOMBRE LIKE '%$valorCliente%'";
}

// LIMIT y OFFSET para la paginación
$sql .= " ORDER BY pedido.ID_PEDIDO";
$sql .= " LIMIT $limite OFFSET $desplazamiento";

$query = $conexion->query($sql);

if ($sql) {
    while ($resultado = $query->fetch_assoc()) {
        // (Tu código para mostrar los productos aquí)
        $idpedido = $resultado['ID_PEDIDO'];
        $idcliente = $resultado['CLIENTE_NOMBRE'];
        $idempleado = $resultado['EMPLEADO_NOMBRE'];
        $fecha = $resultado['FECHA'];
        $montofinal = $resultado['MONTO_FINAL'];
        $metodopago = $resultado['METODO_PAGO'];
        $estado = $resultado['ESTADO'];

        // Imprime las filas de la tabla con las columnas específicas
        echo "<tr data-aos=\"zoom-in-up\">";
        echo "<th scope='row'>$idpedido</th>";
        echo "<td>$idcliente</td>";
        echo "<td>$idempleado</td>";
        echo "<td>$fecha</td>";
        echo "<td>$montofinal</td>";
        echo "<td>$metodopago</td>";
        echo "<td>$estado</td>";
 
        echo "<td>
        <a href='../Empleado/editarPedidoEm.php?id=$idpedido' class=\"btn btn-warning\"><i class='fas fa-pencil-alt'></i></a>
        <br>
        <br>
        <a href='../../../Servidor/PHP/EmpleadoServidor/eliminarPedido.php?ID_PEDIDO=$idpedido'class=\"btn btn-danger eliminar_pedido\"><i class='fas fa-trash-alt'></i>
        </a>
        </td>";
        echo "<td><a href='../Empleado/detallePedidoEm.php?id=$idpedido'  class=\"btn btn-success\">Ver detalle de pedido</a></td>";

        echo "</tr>";
    }
}

 // Calcular la cantidad total de páginas
 $sqlTotal = $conexion->query("SELECT COUNT(*) as total FROM pedido");
 $totalProductos = $sqlTotal->fetch_assoc()['total'];
 $totalPaginas = ceil($totalProductos / $productosPorPagina);

 // Mostrar enlaces de paginación
 echo '<div class="container">';
 for ($i = 1; $i <= $totalPaginas; $i++) {
     $active = $i == $pagina ? 'active' : '';
     echo "<a class='btn btn-secondary $active' href='pedidos.php?pagina=$i'>$i</a>";
 }
 echo '</div>';

 // Cierra la conexión a la base de datos cuando hayas terminado
 $conexion->close();
 ?>