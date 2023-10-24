<?php
// Incluir el archivo de conexión
include('../Config/conexion.php');

// Iniciar la sesión
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conexion, $_POST['Correo']);
    $password = mysqli_real_escape_string($conexion, $_POST['Contraseña']);

    // Consulta para verificar las credenciales del usuario en la base de datos
    $query = "SELECT ID_EMPLEADO, N_EMPLEADO FROM empleado WHERE USUARIO_EMPLEADO = '$username' AND CONTRASEÑA_EMPLEADO = '$password'";
    $result = mysqli_query($conexion, $query);

    if (mysqli_num_rows($result) == 1) {
        // Las credenciales son válidas, obtener la información del usuario
        $row = mysqli_fetch_assoc($result);

        // Establecer variables de sesión para el usuario
        $_SESSION['ID_EMPLEADO'] = $row['ID_EMPLEADO'];
        $_SESSION['nombre_usuario'] = $row['N_EMPLEADO'];

        // Redirigir al panel principal
        header('Location: ../Empleado/indexEmpleado.php');
    } else {
        header('Location: ../Empleado/LoginEmpleado.php');
    }
}
?>
