<?php
    //conexion a la base de datos
    include('../../../Servidor/conexion.php');

    $idpedido = $_GET['ID_PEDIDO'];
    $sql = "DELETE FROM pedido where ID_PEDIDO = '$idpedido'";

    $query = mysqli_query($conexion, $sql);

    if ($query) {
        // Empleado eliminado exitosamente
        echo "<script>alert('Pedido eliminado exitosamente'); window.location.href='../../../Cliente/vistas/Empleado/pedidos.php';</script>";
    } else {
        // No se pudo eliminar
        echo "<script>alert('No se pudo eliminar'); window.history.go(-1);</script>";
    }
?>
