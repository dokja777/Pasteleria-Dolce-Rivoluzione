<?php
session_start();

if (isset($_POST['idProducto'])) {
    $idProducto = $_POST['idProducto'];

    // Obtener el carrito de la sesión
    $carritoEmpleado = isset($_SESSION['carritoEmpleado']) ? $_SESSION['carritoEmpleado'] : array();

    // Filtrar el carrito para mantener solo los productos que no tienen el ID del producto a eliminar
    $carritoEmpleado = array_filter($carritoEmpleado, function ($item) use ($idProducto) {
        return $item['Id'] != $idProducto;
    });

    // Actualizar el carrito en la sesión
    $_SESSION['carritoEmpleado'] = $carritoEmpleado;

    // Responder con un mensaje de éxito (puedes personalizarlo según tus necesidades)
    echo 'Producto eliminado del carrito.';
} else {
    // Responder con un mensaje de error si no se proporciona el ID del producto
    echo 'ID de producto no proporcionado.';
}
?>
