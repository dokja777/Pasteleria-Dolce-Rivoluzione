<?php
include('../../../Servidor/conexion.php');

$idE = $_POST['idE'];
$usuarioE = $_POST['usuarioE'];
$nombreE = $_POST['nombreE'];
$contraseñaE = $_POST['contraseñaE'];

$sql = "UPDATE empleado SET USUARIO_EMPLEADO='$usuarioE', N_EMPLEADO='$nombreE', CONTRASEÑA_EMPLEADO='$contraseñaE' WHERE ID_EMPLEADO = $idE";

$rta = mysqli_query($conexion, $sql);
if(!$rta){
    echo "No se Actualizo!";
} else{
    header("Location: ../../../Cliente/vistas/Administrador/listarEmpleados.php");
}
?>
