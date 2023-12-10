<?php
session_start(); 
include('../../../Config/conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idempleado = mysqli_real_escape_string($conexion, $_POST['empleado']);
    $idcliente = mysqli_real_escape_string($conexion, $_POST['cliente']);
    $montoFinal = mysqli_real_escape_string($conexion, $_POST['montoFinal']);
    $fecha = mysqli_real_escape_string($conexion, $_POST['fecha']);
    $fechaRecojo = mysqli_real_escape_string($conexion, $_POST['fechaRecojo']);
    $metodoPago = mysqli_real_escape_string($conexion, $_POST['metodoPago']);
    $estado = mysqli_real_escape_string($conexion, $_POST['estado']);

    $sql = "INSERT INTO pedido(ID_EMPLEADO,ID_CLIENTE,MONTO_FINAL,FECHA,METODO_PAGO,ESTADO) VALUES (?,?,?,?,?,?)";
    $stmt = mysqli_prepare($conexion, $sql);

    mysqli_stmt_bind_param($stmt, 'ssisss', $idempleado, $idcliente, $montoFinal, $fecha, $metodoPago, $estado);

    if (mysqli_stmt_execute($stmt)) {
        // Obtiene el ID del pedido recién insertado
        $idPedido = mysqli_insert_id($conexion);

        // Recorre el carritoEmpleado y agrega detalles del pedido
        foreach ($_SESSION['carritoEmpleado'] as $producto) {
            $idProducto = $producto['Id'];
            $cantidadProducto = $producto['cantidad'];
            $nombreProducto = $producto['Nombre'];
            $subtotal = $producto['Precio'] * $cantidadProducto;

            // Inserta en la tabla detalle_pedido
            $sqlInsertDetalle = "INSERT INTO detalle_pedido (DEDICATORIA, PRECIO, CANTIDAD, ID_PEDIDO, ID_PRODUCTO, FECHA_RECOJO)
                                VALUES ('', '$subtotal', '$cantidadProducto', '$idPedido', '$idProducto', '$fechaRecojo')";
            $resultInsertDetalle = $conexion->query($sqlInsertDetalle);

            // Actualiza el stock en la tabla producto
            $sqlUpdateStock = "UPDATE producto SET STOCK = STOCK - ? WHERE ID_PRODUCTO = ?";
            $stmtUpdateStock = mysqli_prepare($conexion, $sqlUpdateStock);
            mysqli_stmt_bind_param($stmtUpdateStock, 'ii', $cantidadProducto, $idProducto);
            mysqli_stmt_execute($stmtUpdateStock);
        }

        echo '<script>';
        echo 'alert("Pedido registrado correctamente.");';
        echo 'window.location.href = "../../../Cliente/vistas/Empleado/pedidos.php";';  // Reemplaza "ruta_a_tu_pagina_de_pedidos.php" con la URL correcta
        echo '</script>';
    } else {
        echo '<script>';
        echo 'alert("Pedido no se pudo eliminar correctamente.");';
        echo 'window.location.href = "../../../Cliente/vistas/Empleado/agregarPedido.php";';  // Reemplaza "ruta_a_tu_pagina_de_pedidos.php" con la URL correcta
        echo '</script>';
    }
}

?>

