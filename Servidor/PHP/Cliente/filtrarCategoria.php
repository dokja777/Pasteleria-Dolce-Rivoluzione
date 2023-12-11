<?php
// consultas.php
include('../../../Servidor/conexion.php');

$sqlCategorias = "SELECT * FROM categoria_producto";
$resultCategorias = $conexion->query($sqlCategorias);

// Verifica si hay categorías
if ($resultCategorias->num_rows > 0) {
    // Guarda las categorías en un array
    while ($rowCategoria = $resultCategorias->fetch_assoc()) {
        $categorias[] = $rowCategoria;
    }
} else {
    // No hay categorías disponibles
    $categorias = [];
}

// ... el resto de tu código ...
?>


