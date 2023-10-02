<?php
include ("../config/conexion.php");

$idProducto=$_GET['ID_PRODUCTO'];
$sql="DELETE FROM producto where  ID_PRODUCTO ='$idProducto'";

$query = mysqli_query($conexion,$sql);
if ($query === TRUE) {
    header("Location:../listaproductos.php");
}
?>