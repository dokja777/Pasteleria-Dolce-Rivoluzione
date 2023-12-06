<?php
session_start();

include('../../../Config/conexion.php');

if (!isset($_SESSION['Id'])){
    header("Location: ../../../Cliente/vistas/Cliente/inicioSesion.php");
    exit();
}

if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['numero_doc']) && isset($_POST['telefono']) && isset($_POST['correo'])) {
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $nombre = validate($_POST['nombre']);
    $apellido = validate($_POST['apellido']);
    $numero_doc = validate($_POST['numero_doc']);
    $telefono = validate($_POST['telefono']);
    $correo = validate($_POST['correo']);

    if (empty($nombre) || empty($apellido) || empty($numero_doc) || empty($telefono) || empty($correo)){
        header("Location: editarClient.php?error=Todos los campos son requeridos");
        exit();
    } else {
        $cliente_id = $_SESSION['Id'];

        // Actualiza los datos del cliente en la base de datos
        $sql = "UPDATE cliente SET NOMBRE = '$nombre', APELLIDO = '$apellido', NUMERO_DOC = '$numero_doc', TELEFONO = '$telefono', CORREO = '$correo' WHERE ID_CLIENTE = $cliente_id";

        if (mysqli_query($conexion, $sql)) {
            // Redirige al perfil del cliente después de guardar los cambios
            header("Location: ../../../Cliente/vistas/Cliente/perfil.php");
            exit();
        } else {
            echo "Error al actualizar los datos del cliente: " . mysqli_error($conexion);
        }
    }
} else {
    header("Location: editarCliente.php");
    exit();
}
