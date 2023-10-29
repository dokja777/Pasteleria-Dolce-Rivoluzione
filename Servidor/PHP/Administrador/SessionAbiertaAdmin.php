<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['ID_ADMIN'])) {
    // Si no está autenticado, redirigir al formulario de inicio de sesión
    header('Location: ../../../Cliente/vistas/Administrador/LoginAdministrador.php');
    exit;
}
?>