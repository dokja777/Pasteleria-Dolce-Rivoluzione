<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['ID_EMPLEADO'])) {
    // Si no está autenticado, redirigir al formulario de inicio de sesión
    header('Location: ../Empleado/LoginEmpleado.php');
    exit;
}
?>