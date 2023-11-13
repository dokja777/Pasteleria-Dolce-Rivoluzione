<?php
include('../../../Servidor/conexion.php');

$idU = $_POST['idU'];
$usuarioU = $_POST['usuarioU'];
$usuarioN = $_POST['usuarioN'];
$usuarioP = $_POST['usuarioP']; 


$sql = "UPDATE admin SET USUARIO ='$usuarioU', NOMBRE='$usuarioN', CONTRASEÑA='$usuarioP' WHERE ID_ADMIN = $idU";

$rta = mysqli_query($conexion, $sql);
if(!$rta){
    echo "No se Actualizo!";
} else{
    header("Location: ../../../Cliente/vistas/Administrador/listarAdministrador.php");
}
?>
