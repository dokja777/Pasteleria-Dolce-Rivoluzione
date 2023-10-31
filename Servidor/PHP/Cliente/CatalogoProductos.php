
<?php
include(__DIR__ . '/../../conexion.php');

if (isset($_GET['enviar'])) {
    $busqueda = $_GET['busqueda'];

    $query = "SELECT * FROM producto WHERE N_PRODUCTO LIKE '%$busqueda%'";
    $resultado = $conexion->query($query);

    $productos = array();

    while ($row = $resultado->fetch_assoc()) {
        $productos[] = $row;
    }
} else {
    // Si no se ha realizado una búsqueda, muestra todos los productos
    $query = "SELECT * FROM producto";
    $resultado = $conexion->query($query);

    $productos = array();

    while ($row = $resultado->fetch_assoc()) {
        $productos[] = $row;
    }
}
?>