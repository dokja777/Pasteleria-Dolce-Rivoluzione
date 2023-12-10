<?php
session_start();

if (isset($_POST['idProducto'])) {
    $idProducto = $_POST['idProducto'];

    // Realiza la consulta para obtener la información del producto
    include('../../../Servidor/conexion.php');
    $query = $conexion->query("SELECT * FROM PRODUCTO WHERE ID_PRODUCTO = '$idProducto'");

    if ($query) {
        $producto = $query->fetch_assoc();

        // Añade el producto al carrito de la sesión
        $carritoEmpleado = isset($_SESSION['carritoEmpleado']) ? $_SESSION['carritoEmpleado'] : array();

        // Verifica si el producto ya está en el carrito
        $productoEnCarrito = array_filter($carritoEmpleado, function ($item) use ($idProducto) {
            return $item['Id'] == $idProducto;
        });

        if (empty($productoEnCarrito)) {
            // Agrega el producto al carrito con una cantidad inicial de 1
            $nuevoProducto = array(
                'Id' => $producto['ID_PRODUCTO'],
                'Nombre' => $producto['N_PRODUCTO'],
                'Precio' => $producto['PRECIO'],
                'Imagen' => $producto['IMG'], // Asumiendo que almacenaste la imagen en base64
                'cantidad' => 1,
            );

            // Agrega el nuevo producto al carrito
            array_push($carritoEmpleado, $nuevoProducto);
            $_SESSION['carritoEmpleado'] = $carritoEmpleado;

            echo 'Producto agregado al carrito.';
            
        } else {
            echo 'El producto ya está en el carrito.';
        }
    } else {
        echo 'Error al obtener información del producto.';
    }
} else {
    echo 'ID de producto no proporcionado.';
}
?>
