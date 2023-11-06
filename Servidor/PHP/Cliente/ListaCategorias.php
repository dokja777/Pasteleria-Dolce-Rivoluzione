<?php
include('../../../Config/conexion.php');
// Consulta de categorías
$sql_categorias = $conexion->query("SELECT * FROM categoria_producto") or die($conexion->error);
?>