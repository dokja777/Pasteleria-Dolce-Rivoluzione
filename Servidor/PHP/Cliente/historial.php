<?php
include('../../../Config/conexion.php');

// Realiza la consulta SQL para obtener los pedidos del cliente
$sql = "SELECT c.ID_CLIENTE, c.NOMBRE, c.APELLIDO, c.NUMERO_DOC, c.TELEFONO, c.CORREO, p.ID_PEDIDO, p.FECHA, p.METODO_PAGO, p.MONTO_FINAL, d.ID_D_PEDIDO, d.CANTIDAD, pro.PRECIO, pro.ID_PRODUCTO, pro.N_PRODUCTO, pro.IMG
FROM detalle_pedido AS d
JOIN producto AS pro ON d.ID_PRODUCTO = pro.ID_PRODUCTO
JOIN pedido AS p ON d.ID_PEDIDO = p.ID_PEDIDO
JOIN cliente AS c ON p.ID_CLIENTE = c.ID_CLIENTE
WHERE p.ID_CLIENTE = '$iduser';";

$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Genera el código HTML para mostrar cada resultado
        echo '<div class="container1">';
        echo '<div class="top">';
        echo '<p><strong>Fecha de Compra:</strong> ' . $row['FECHA'] . '</p>';
        echo '<p><strong>Método de Pago: </strong>' . $row['METODO_PAGO'] . '</p>';
        echo '<p class="total"><strong>Total de compra: S/ ' . $row['MONTO_FINAL'] . '</p>';
        echo '</div>';
        echo '<div class="lefMid">';
        echo '<h3><strong>Productos</strong></h3>';
        echo '<div class="table-responsive">';
        echo '<table class="table  table-borderless table-hover">';
        echo '<thead>';
        echo '<tr>';
        echo '<th scope="col"></th>';
        echo '<th scope="col">Nombre del Producto</th>';
        echo '<th scope="col">Precio</th>';
        echo '<th scope="col">Cantidad</th>';
        echo '<th scope="col">Subtotal</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        echo '<tr>';
        echo '<td><img  style="width:90px; "  src="data:image/jpg;base64, ' . base64_encode($row['IMG']) . '"></td>';
        echo '<td >' . $row['N_PRODUCTO'] . '</td>';
        echo '<td>S/ ' . $row['PRECIO'] . '</td>';
        echo '<td>' . $row['CANTIDAD'] . '</td>';
        echo '<td>S/ 15</td>';
        echo '</tr>';
        echo '</tbody>';
        echo '</table>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo 'No se encontraron resultados.';
}
?>
