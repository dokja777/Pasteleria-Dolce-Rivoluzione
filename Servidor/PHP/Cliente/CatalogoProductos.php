<?php
include(__DIR__ . '/../../conexion.php');

// Búsqueda por nombre
if (isset($_GET['enviar'])) {
    $busqueda = $_GET['busqueda'];

    $query = "SELECT * FROM producto WHERE N_PRODUCTO LIKE '%$busqueda%'";
    $resultado = $conexion->query($query);

    $productos = array();

    while ($row = $resultado->fetch_assoc()) {
        $productos[] = $row;
    }
} else {
    // Filtrar por categoría si se proporciona el parámetro
    $filtroCategoria = isset($_GET['id_categoria']) ? $_GET['id_categoria'] : '';

    // Filtrar por precio si se proporciona el parámetro
    $filtroPrecio = isset($_GET['ordenar']) ? $_GET['ordenar'] : '';

    // Construir la consulta SQL
    $query = "SELECT * FROM producto";

    if (!empty($filtroCategoria)) {
        $query .= " WHERE ID_CATEGORIA = '$filtroCategoria'";
    }

    // Aquí puedes agregar más condiciones según tus necesidades, por ejemplo, para filtrar por precio

    $resultado = $conexion->query($query);

    $productos = array();

    while ($row = $resultado->fetch_assoc()) {
        $productos[] = $row;
    }
}
?>
