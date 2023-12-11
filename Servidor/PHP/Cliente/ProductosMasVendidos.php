<?php
include(__DIR__ . '/../../conexion.php');
$query = "SELECT
        p.ID_PRODUCTO,
        p.N_PRODUCTO,
        p.STOCK,
        p.IMG,
        p.PRECIO
        FROM producto p
        JOIN (
        SELECT dp.ID_PRODUCTO, SUM(dp.CANTIDAD) AS VENTAS
        FROM detalle_pedido dp
        JOIN pedido pe ON dp.ID_PEDIDO = pe.ID_PEDIDO
        WHERE pe.ESTADO = 'Entregado'
        GROUP BY dp.ID_PRODUCTO
        ORDER BY VENTAS DESC
        LIMIT 30 
        ) top_products ON p.ID_PRODUCTO = top_products.ID_PRODUCTO;";
$resultado = $conexion->query($query);
$products = array();

while ($row = $resultado->fetch_assoc()) {
    $products[] = $row;
}
?>