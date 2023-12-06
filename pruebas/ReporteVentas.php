<?php

class ReporteVentas
{
  private $conexion;

  public function __construct($conexion)
  {
    $this->conexion = $conexion;
  }

  public function generarReporteVentas($fechaInicio, $fechaFin, $cantidadProductos)
  {
    $query = "SELECT p.N_PRODUCTO, SUM(dp.CANTIDAD) AS VENTAS
              FROM detalle_pedido dp
              JOIN pedido pe ON dp.ID_PEDIDO = pe.ID_PEDIDO
              JOIN producto p ON dp.ID_PRODUCTO = p.ID_PRODUCTO
              WHERE ESTADO IN ('Entregado', 'Pendiente')
              AND pe.FECHA BETWEEN '$fechaInicio' AND '$fechaFin'
              GROUP BY p.N_PRODUCTO
              ORDER BY VENTAS DESC
              LIMIT $cantidadProductos";

    $resultado = $this->conexion->query($query);
    $data = array();

    while ($row = $resultado->fetch_assoc()) {
      $data[$row['N_PRODUCTO']] = $row['VENTAS'];
    }

    return $data;
  }
}

