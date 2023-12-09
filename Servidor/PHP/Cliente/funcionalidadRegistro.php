<?php
session_start();

include('../../conexion.php');


if (isset($_POST['NUMERO_DOC']) && isset($_POST['Correo']) && isset($_POST['Nombre']) && isset($_POST['Apellido']) && isset($_POST['Telefono']) && isset($_POST['Contraseña']) && isset($_POST['RContraseña'])) {
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $NUMERO_DOC = validate($_POST['NUMERO_DOC']);
    $Correo = validate($_POST['Correo']);
    $Nombre = validate($_POST['Nombre']);
    $Apellido = validate($_POST['Apellido']);
    $Telefono = validate($_POST['Telefono']);
    $Contraseña = validate($_POST['Contraseña']);
    $RContraseña = validate($_POST['RContraseña']);

    $datosUsuario = 'NUMERO_DOC=' . $NUMERO_DOC . '&Correo=' . $Correo . '&Nombre=' . $Nombre . '&Apellido=' . $Apellido . '&Telefono=' . $Telefono;

    if(empty($NUMERO_DOC)){
        header("Location: ../../../Cliente/vistas/Cliente/registro.php?error=El número de documento es requerido&$datosUsuario");
        exit();
    } elseif (empty($Correo)){
        header("Location: ../../../Cliente/vistas/Cliente/registro.php?error=El correo es requerido&$datosUsuario");
        exit();
    } elseif (empty($Nombre)){
        header("Location: ../../../Cliente/vistas/Cliente/registro.php?error=El nombre es requerido&$datosUsuario");
        exit();
    } elseif (empty($Apellido)){
        header("Location: ../../../Cliente/vistas/Cliente/registro.php?error=El apellido es requerido&$datosUsuario");
        exit();
    } elseif (empty($Telefono)){
        header("Location: ../../../Cliente/vistas/Cliente/registro.php?error=El número de teléfono es requerido&$datosUsuario");
        exit();
    } elseif (empty($Contraseña)){
        header("Location: ../../../Cliente/vistas/Cliente/registro.php?error=La contraseña es requerida&$datosUsuario");
        exit();
    } elseif (empty($RContraseña)){
        header("Location: ../../../Cliente/vistas/Cliente/registro.php?error=Tiene que repetir la contraseña&$datosUsuario");
        exit();
    } elseif($Contraseña !== $RContraseña){
        header("Location: ../../../Cliente/vistas/Cliente/registro.php?error=Las contraseñas no coinciden&$datosUsuario");
        exit();
    } else {
        // Verifica si el número de documento ya existe en la base de datos
        $sql_check_documento = "SELECT * FROM cliente WHERE NUMERO_DOC = '$NUMERO_DOC'";
        $query_check_documento = $conexion->query($sql_check_documento);

        if(mysqli_num_rows($query_check_documento) > 0){
            header("Location: ../../../Cliente/vistas/Cliente/registro.php?error=El número de documento ya existe&$datosUsuario");
            exit();
        } else {
            $Sql2 = "INSERT INTO cliente(NUMERO_DOC, Correo, Nombre, Apellido, Telefono, Contraseña) VALUES ('$NUMERO_DOC', '$Correo', '$Nombre', '$Apellido', '$Telefono', '$Contraseña')";
            $query2 = $conexion->query($Sql2);

            if($query2){
                header("Location: ../../../Cliente/vistas/Cliente/registro.php?success=Usuario creado con éxito&$datosUsuario");
                exit();
            } else {
                header("Location: ../../../Cliente/vistas/Cliente/registro.php?error=Ocurrió un error al registrar el usuario&$datosUsuario");
                exit();
            }
        }
    }
} else {
    header("Location: ../../../Cliente/vistas/Cliente/registro.php");
    exit();
}
?>
