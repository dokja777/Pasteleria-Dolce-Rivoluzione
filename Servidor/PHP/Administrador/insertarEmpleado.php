<?php
include('../../../Servidor/conexion.php');


$usuarioE = $_POST['usuarioE'];
$nombreE = $_POST['nombreE'];
$contraseñaE = $_POST['contraseñaE'];

$sql = "INSERT INTO empleado(USUARIO_EMPLEADO, N_EMPLEADO, CONTRASEÑA_EMPLEADO) VALUES ('$usuarioE', '$nombreE', '$contraseñaE')";
$rta = mysqli_query($conexion, $sql);
if(!$rta){
    echo "No se Inserto!";
} else{
    header("Location: ../../../Cliente/vistas/Administrador/listarEmpleados.php");
}
?>
