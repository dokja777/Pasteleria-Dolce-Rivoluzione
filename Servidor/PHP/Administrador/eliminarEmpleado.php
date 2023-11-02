<?php
    //conexion a la base de datos
    include('../../../Servidor/conexion.php');

    $idEmpleado = $_GET['ID_EMPLEADO'];
    $sql = "DELETE FROM empleado where  ID_EMPLEADO = '$idEmpleado'";

    $query = mysqli_query($conexion, $sql);

    if ($query) {
        // Empleado eliminado exitosamente
        echo "<script>alert('Empleado eliminado exitosamente'); window.location.href='../../../Cliente/vistas/Administrador/listarEmpleados.php';</script>";
    } else {
        // No se pudo eliminar
        echo "<script>alert('No se pudo eliminar'); window.history.go(-1);</script>";
    }
?>
