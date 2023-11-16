<?php
include('../../../Config/conexion.php');

$porPagina = 5;


$pagina = isset($_GET['page']) ? $_GET['page'] : 1;


$offset = ($pagina - 1) * $porPagina;


$query = "SELECT pedido.ID_PEDIDO, cliente.NOMBRE, empleado.N_EMPLEADO, pedido.FECHA, pedido.MONTO_FINAL, pedido.METODO_PAGO, pedido.ESTADO, dp.FECHA_RECOJO AS FECHA_RECOJO_PEDIDO
          FROM pedido 
          INNER JOIN cliente ON pedido.ID_CLIENTE = cliente.ID_CLIENTE 
          INNER JOIN empleado ON pedido.ID_EMPLEADO = empleado.ID_EMPLEADO
          INNER JOIN detalle_pedido dp ON pedido.ID_PEDIDO = dp.ID_PEDIDO
          LIMIT $porPagina OFFSET $offset";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener valores de fecha de inicio y fecha de fin
    $fechaInicio = isset($_POST['fecha_inicio']) ? $_POST['fecha_inicio'] : '';
    $fechaFin = isset($_POST['fecha_fin']) ? $_POST['fecha_fin'] : '';

   
    if (strtotime($fechaInicio) && strtotime($fechaFin)) {
        
        $query = "SELECT pedido.ID_PEDIDO, cliente.NOMBRE, empleado.N_EMPLEADO, pedido.FECHA, pedido.MONTO_FINAL, pedido.METODO_PAGO, pedido.ESTADO, dp.FECHA_RECOJO AS FECHA_RECOJO_PEDIDO, dp.FECHA_RECOJO AS FECHA_RECOJO_PRODUCTO
                  FROM pedido 
                  INNER JOIN cliente ON pedido.ID_CLIENTE = cliente.ID_CLIENTE 
                  INNER JOIN empleado ON pedido.ID_EMPLEADO = empleado.ID_EMPLEADO
                  INNER JOIN detalle_pedido dp ON pedido.ID_PEDIDO = dp.ID_PEDIDO
                  WHERE dp.FECHA_RECOJO BETWEEN '$fechaInicio' AND '$fechaFin'
                  LIMIT $porPagina OFFSET $offset";
    } else {
        
        echo "Las fechas ingresadas no son válidas.";
        exit; 
    }
}


$resultado = $conexion->query($query);

if ($resultado) {
    echo '<table class="table table-hover text-center">
            <thead>
                <tr>
                <th scope="col" style="background-color:#f9cb9c;">ID</th>
                <th scope="col" style="background-color:#f9cb9c;">Cliente</th>
                <th scope="col" style="background-color:#f9cb9c;">Empleado</th>
                <th scope="col" style="background-color:#f9cb9c;">Fecha</th>
                <th scope="col" style="background-color:#f9cb9c;">Monto final</th>
                <th scope="col" style="background-color:#f9cb9c;">Metodo de pago</th>
                <th scope="col" style="background-color:#f9cb9c;">Estado</th>
                <th scope="col" style="background-color:#f9cb9c;">Fecha de Recojo </th>
                <th scope="col" style="background-color:#f9cb9c;">Acciones</th>
                <th scope="col" style="background-color:#f9cb9c;">Detalle Pedido</th>
                </tr>
            </thead>
            <tbody>';

    while ($row = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<th scope='row'>{$row['ID_PEDIDO']}</th>";
        echo "<td>{$row['NOMBRE']}</td>";
        echo "<td>{$row['N_EMPLEADO']}</td>";
        echo "<td>{$row['FECHA']}</td>";
        echo "<td>S/ {$row['MONTO_FINAL']}</td>";
        echo "<td>{$row['METODO_PAGO']}</td>";
        echo "<td>{$row['ESTADO']}</td>";
        echo "<td>{$row['FECHA_RECOJO_PEDIDO']}</td>";
       
        
        echo "<td>
              <a href='../Empleado/editarPedidoEm.php?id={$row['ID_PEDIDO']}' class=\"btn btn-warning\"><i class='fas fa-pencil-alt'></i></a>
              <br>
              <br>
              <a href='../../../Servidor/PHP/EmpleadoServidor/eliminarPedido.php?ID_PEDIDO={$row['ID_PEDIDO']}' class=\"btn btn-danger\"><i class='fas fa-trash-alt'></i>
              </a>
              </td>";
        echo "<td>
              <a href='../Empleado/detallePedidoEm.php?id={$row['ID_PEDIDO']}' class=\"btn btn-success\">Ver detalle de pedido</a>
                </td>";

        echo "</tr>";
    }

    echo '</tbody></table>';

    
    $resultado->free();
} else {
    echo "Error en la consulta: " . $conexion->error;
}


$conexion->close();
?>
