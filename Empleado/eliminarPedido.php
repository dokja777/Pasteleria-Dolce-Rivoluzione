<?php
// esto sirve para elimar las productos de la base de datos en el formulario listaproductos 
include ("../config/conexion.php");

$idpedido=$_GET['ID_PEDIDO'];
$sql="DELETE FROM pedido where  ID_PEDIDO ='$idpedido'";


$query = mysqli_query($conexion,$sql);
if ($query === TRUE) {
    header("Location:../Empleado/pedido.php");
}
?>