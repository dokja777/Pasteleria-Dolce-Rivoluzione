<?php
    //conexion a la base de datos
    include('../../../Servidor/conexion.php');

    $idAdmin = $_GET['ID_ADMIN'];
    $sql = "DELETE FROM admin where ID_ADMIN = '$idAdmin'";

    $query = mysqli_query($conexion, $sql);

    if ($query) {
        // Usuario eliminado exitosamente
        echo "<script>alert('Usuario eliminado exitosamente'); window.location.href='../../../Cliente/vistas/Administrador/listarAdministrador.php';</script>";
    } else {
        // No se pudo eliminar
        echo "<script>alert('No se pudo eliminar'); window.history.go(-1);</script>";
    }
?>
