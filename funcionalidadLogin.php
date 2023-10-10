<?php
session_start();

include('config/conexion.php');

session_start();
if (isset($_SESSION['Id'])){
    header("Location: perfil.php");

}


if (isset($_POST['Correo']) && isset($_POST['Contraseña'])) {
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $Correo = validate($_POST['Correo']);
    $Contraseña = validate($_POST['Contraseña']);

    if(empty($Correo)){
        header("Location: inicioSesion.php?error=El correo es requerido");
        exit();
    } elseif (empty($Contraseña)){
        header("Location: inicioSesion.php?error=La contraseña es requerida");
        exit();
    } else {
        $Sql = "SELECT * FROM cliente WHERE Correo = '$Correo'";
        $result = mysqli_query($conexion, $Sql);

        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_assoc($result);
            if($row['Contraseña'] === $Contraseña){
                $_SESSION['Correo'] = $row['Correo'];
                $_SESSION['Id'] = $row['ID_CLIENTE'];
                header("Location: perfil.php");
                exit();
            } else {
                header("Location: inicioSesion.php?error=La contraseña es incorrecta");
                exit();
            }
        } else {
            header("Location: inicioSesion.php?error=El Correo es incorrecto");
            exit();
        }
    }
} else {
    header("Location: inicioSesion.php");
    exit();
}

?>
