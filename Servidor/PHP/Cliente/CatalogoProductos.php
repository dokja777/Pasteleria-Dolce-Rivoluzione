<?php
include(__DIR__ . '/../../conexion.php');
$query = "SELECT * FROM producto";
$resultado = $conexion->query($query);
$productos = array();

while ($row = $resultado->fetch_assoc()) {
    $productos[] = $row;
}
?>
