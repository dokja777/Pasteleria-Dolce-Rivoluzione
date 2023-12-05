<?php
// listaPedido.php
include('../Config/conexion.php');
include('../pruebas/PedidoController.php');

// Obtener los valores de los filtros desde las variables
$valorCliente = isset($_GET['cliente']) ? $_GET['cliente'] : '';
$productosPorPagina = isset($_GET['cantidad']) ? $_GET['cantidad'] : 5;
$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

// Crear instancia del controlador
$controlador = new PedidoController($conexion);

// Obtener pedidos paginados
$pedidos = $controlador->obtenerPedidosPaginados($valorCliente, $productosPorPagina, $pagina);

// Obtener el total de páginas
$totalPaginas = $controlador->obtenerTotalPaginas($productosPorPagina);
?>

<!-- Esto hace que la session se siga manteniendo abierta -->

<!-- ----------------------------------------------------------- -->

<!doctype html>
<html lang="es">

<head>
<meta charset="utf-8">
  

</head>

<body>
  <!-------- incluir el  navbar ----->
  <?php include '../Cliente/vistas/Empleado/headerSecundario.php'; ?>

  <!-- ... (resto del formulario y la tabla) ... -->

  <div class="container">
    <table class="table table-hover text-center">
      <thead>
        <tr>
          <th scope="col" style="background-color:#f9cb9c;">ID</th>
          <th scope="col" style="background-color:#f9cb9c;">Cliente</th>
          <th scope="col" style="background-color:#f9cb9c;">Empleado</th>
          <th scope="col" style="background-color:#f9cb9c;">Fecha</th>
          <th scope="col" style="background-color:#f9cb9c;">Monto final</th>
          <th scope="col" style="background-color:#f9cb9c;">Metodo de pagos</th>
          <th scope="col" style="background-color:#f9cb9c;">Estado</th>
          <th scope="col" style="background-color:#f9cb9c;">Acciones</th>
          <th scope="col" style="background-color:#f9cb9c;">Detalle Pedido</th>
        </tr>
      </thead>

      <tbody>
        <?php
        // Iterar sobre los pedidos y mostrar en la tabla
        foreach ($pedidos as $pedido) {
          $idpedido = $pedido['ID_PEDIDO'];
          $idcliente = $pedido['CLIENTE_NOMBRE'];
          $idempleado = $pedido['EMPLEADO_NOMBRE'];
          $fecha = $pedido['FECHA'];
          $montofinal = $pedido['MONTO_FINAL'];
          $metodopago = $pedido['METODO_PAGO'];
          $estado = $pedido['ESTADO'];

          // Imprime las filas de la tabla con las columnas específicas
          echo "<tr data-aos=\"zoom-in-up\">";
          echo "<th scope='row'>$idpedido</th>";
          echo "<td>$idcliente</td>";
          echo "<td class=\"articulos\" >$idempleado</td>";
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
          echo "<td><a href='../cliente/vistas/Empleado/detallePedidoEm.php?id=$idpedido'  class=\"btn btn-success\">Ver detalle de pedido</a></td>";

          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

<style>
    
</style>
</body>

</html>
