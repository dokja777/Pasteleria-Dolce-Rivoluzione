<?php
    //conexion a la base de datos
    include('../../../Servidor/conexion.php');

    $idEmpleado = $_GET['ID_EMPLEADO'];
    $sql = "DELETE FROM empleado where  ID_EMPLEADO = '$idEmpleado'";

    $query = mysqli_query($conexion,$sql);

    if ($query) {
        header("Location: ../../../Cliente/vistas/Administrador/listarEmpleado.php");
    } else {
        echo "<script>alert('No se pudo eliminar'); window.history.go(-1); </script>";
    }
?> 