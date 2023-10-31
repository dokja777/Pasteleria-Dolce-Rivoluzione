<?php
// Conectar a la base de datos (reemplaza los valores por los tuyos)
include('../../../Servidor/conexion.php');

// Obtener el ID del pedido de manera segura
$idpedido = $_GET['id'];
$idpedido = mysqli_real_escape_string($conexion, $idpedido);

// Consulta SQL con INNER JOIN para obtener detalles de pedido y nombre/imagen del producto
$sql = "SELECT dp.ID_D_PEDIDO, dp.DEDICATORIA, dp.PRECIO, dp.CANTIDAD, p.N_PRODUCTO, p.IMG, dp.FECHA_RECOJO
        FROM detalle_pedido dp
        INNER JOIN producto p ON dp.ID_PRODUCTO = p.ID_PRODUCTO
        WHERE dp.ID_PEDIDO = $idpedido";

$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["ID_D_PEDIDO"] . "</td>";
        echo "<td>" . $row["DEDICATORIA"] . "</td>";
        echo "<td>" . $row["PRECIO"] . "</td>";
        echo "<td>" . $row["CANTIDAD"] . "</td>";
        echo "<td>" . $row["N_PRODUCTO"] . "</td>";
        echo "<td><img class='img-small' src='data:image/jpeg;base64," . base64_encode($row['IMG']) . "' /></td>";
        echo "<td>" . $row["FECHA_RECOJO"] . "</td>";
        echo "</tr>";
    }
} else {
    echo "No se encontraron detalles para este pedido.";
}

$conexion->close();
?>
