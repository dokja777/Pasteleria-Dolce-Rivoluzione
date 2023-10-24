<?php
// Incluir el archivo de conexión
include('../Config/conexion.php');

// Iniciar la sesión
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conexion, $_POST['Usuario']); // Cambia 'Correo' a 'Usuario'
    $password = mysqli_real_escape_string($conexion, $_POST['Contraseña']); // Cambia 'Contraseña' a 'Contraseña'

    // Consulta para verificar las credenciales del usuario en la tabla admin
    $query = "SELECT ID_ADMIN, USUARIO, CONTRASEÑA FROM admin WHERE USUARIO = '$username' AND CONTRASEÑA = '$password'";
    $result = mysqli_query($conexion, $query);

    if (mysqli_num_rows($result) == 1) {
        // Las credenciales son válidas, obtener la información del administrador
        $row = mysqli_fetch_assoc($result);

        // Establecer variables de sesión para el administrador
        $_SESSION['ID_ADMIN'] = $row['ID_ADMIN'];
        $_SESSION['nombre_usuario'] = $row['USUARIO']; // Puedes cambiar 'nombre_usuario' al nombre deseado

        // Redirigir al panel principal del administrador
        header('Location: ../indexAdministrador.php');
    } else {
        header('Location: ../Administrador/LoginAdministrador.php?error=Los datos son incorrectos'); // Redirige nuevamente a la página de inicio de sesión si las credenciales son incorrectas
        exit();
    }
}
?>
