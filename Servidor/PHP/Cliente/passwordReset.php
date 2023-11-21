<?php

date_default_timezone_set('America/Lima');
$hora_actual = date('Y-m-d H:i:s');
include('../../conexion.php');

$token = $_POST["token"];

$token_hash = hash("sha256", $token);

$sql = "SELECT * FROM cliente
        WHERE token = ?";

$stmt = $conexion->prepare($sql);

$stmt->bind_param("s", $token_hash);

$stmt->execute();

$result = $stmt->get_result();

$cliente = $result->fetch_assoc();

if ($cliente === null) {
    echo "<script>alert('Token no encontrado');</script>";
} elseif (strtotime($cliente["expiracion"]) <= strtotime($hora_actual)) {
    echo "<script>alert('El token ha expirado');</script>";
} elseif ($_POST["password"] !== $_POST["password_confirmation"]) {
    echo "<script>alert('Ambas contraseñas deben coincidir');</script>";
} else {
    $contra = $_POST["password"];

    $sql = "UPDATE cliente
            SET CONTRASEÑA = ?,
                token = NULL,
                expiracion = NULL
            WHERE ID_CLIENTE = ?";

    $stmt = $conexion->prepare($sql);

    $stmt->bind_param("ss", $contra, $cliente["ID_CLIENTE"]);

    if ($stmt->execute()) {
        echo "<script>alert('Contraseña actualizada. Ya puede logearse.');</script>";
        echo "<script>window.location.href = '../../../Cliente/vistas/Cliente/inicioSesion.php';</script>";
        exit();  // Agrega un exit para evitar que el resto del código se ejecute
    } else {
        echo "<script>alert('Error al actualizar la contraseña');</script>";
    }
}

?>
