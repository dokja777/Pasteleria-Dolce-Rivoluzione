<?php
include("../config/conexion.php");

$idpedido = $_GET['ID_PEDIDO'];
$sql = "DELETE FROM pedido WHERE ID_PEDIDO = '$idpedido'";

try {
    $query = mysqli_query($conexion, $sql);
    if ($query === TRUE) {
        echo '<script>';
        echo 'alert("Pedido eliminado correctamente.");';
        echo 'window.location.href = "../Empleado/pedidos.php";';  // Reemplaza "ruta_a_tu_pagina_de_pedidos.php" con la URL correcta
        echo '</script>';
        
    } else {
        echo '<script>';
        echo 'alert("No se puede eliminar .");';
        echo 'window.location.href = "../Empleado/pedidos.php";';  // Reemplaza "ruta_a_tu_pagina_de_pedidos.php" con la URL correcta
        echo '</script>';
        
    }

} catch (mysqli_sql_exception $e) {
    echo '<script>';
    echo 'alert("Primero elimine los datos de la tabla Detalle producto");';
    echo 'window.location.href = "../Empleado/pedidos.php";';  // Reemplaza "ruta_a_tu_pagina_de_pedidos.php" con la URL correcta
    echo '</script>';
}
?>
