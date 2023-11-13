<?php
include('../../../Servidor/conexion.php');


$usuarioA = $_POST['usuarioA'];
$nombreA = $_POST['nombreA'];
$contraseñaA = $_POST['contraseñaA'];

$sql = "INSERT INTO admin (USUARIO, NOMBRE, CONTRASEÑA) VALUES ('$usuarioA', '$nombreA', '$contraseñaA')";
$rta = mysqli_query($conexion, $sql);
if(!$rta){
    echo "No se Inserto!";
} else{
    header("Location: ../../../Cliente/vistas/Administrador/listarAdministrador.php");
}
?>
