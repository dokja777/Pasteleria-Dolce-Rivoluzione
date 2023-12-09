<?php
include('Config/conexion.php');

function procesarPedido($conexion, $carrito, $idCliente, $fechaRecojo, $metodoPago)
{
    // Verifica si el carrito no está vacío
    if (!empty($carrito)) {
        $totalCompra = 0;

        foreach ($carrito as $producto) {
            $subtotal = $producto['Precio'] * $producto['Cantidad'];
            $totalCompra += $subtotal;
        }

        // Inserta la información en la tabla pedido
        $fechaActual = date("Y-m-d H:i:s");
        $estado = "Pendiente";

        // Inserta la información en la tabla pedido
        $sqlInsertPedido = "INSERT INTO pedido (MONTO_FINAL, FECHA, ESTADO, METODO_PAGO, ID_CLIENTE)
                            VALUES ('$totalCompra', '$fechaActual', '$estado', '$metodoPago', '$idCliente')";

        if ($conexion->query($sqlInsertPedido) === TRUE) {
            // Obtén el ID del pedido recién insertado
            $idPedido = $conexion->insert_id;

            foreach ($carrito as $producto) {
                // Obtiene el nombre del producto y la cantidad
                $nombreProducto = isset($producto['Nombre']) ? $producto['Nombre'] : '';
                $cantidadProducto = isset($producto['Cantidad']) ? $producto['Cantidad'] : 0;
                $subtotal = $producto['Precio'] * $producto['Cantidad'];

                // Busca el ID del producto por su nombre
                $sqlIdProducto = "SELECT ID_PRODUCTO, PRECIO FROM producto WHERE N_PRODUCTO LIKE '%$nombreProducto%'";
                $resultIdProducto = $conexion->query($sqlIdProducto);

                if ($resultIdProducto === false) {
                    // Maneja el error al ejecutar la consulta SQL
                    $error = "Error al ejecutar la consulta SQL: " . mysqli_error($conexion);
                    error_log($error);
                    echo $error;
                } elseif ($resultIdProducto->num_rows > 0) {
                    $idProducto = $resultIdProducto->fetch_assoc()['ID_PRODUCTO'];

                    // Inserta en la tabla detalle_pedido
                    $sqlInsertDetalle = "INSERT INTO detalle_pedido (DEDICATORIA, PRECIO, CANTIDAD, ID_PEDIDO, ID_PRODUCTO, FECHA_RECOJO)
                                        VALUES ('', '$subtotal', '$cantidadProducto', '$idPedido', '$idProducto', '$fechaRecojo')";
                    $resultInsertDetalle = $conexion->query($sqlInsertDetalle);

                    if ($resultInsertDetalle === false) {
                        // Maneja el error al ejecutar la consulta SQL de inserción
                        $error = "Error al ejecutar la consulta SQL de inserción: " . mysqli_error($conexion);
                        error_log($error);
                        echo $error;
                    }
                } else {
                    // Maneja el caso en que no se encontró el producto
                    $error = "No se encontró el producto en la base de datos: $nombreProducto";
                    error_log($error);
                    echo $error;
                }
            }

            $result = [];
            if (!empty($idPedido)) {
                // Ahora puedes utilizar $idPedido en tu lógica si es necesario
                $result['mensaje'] = "Pedido registrado con éxito. Total de la compra: " . $totalCompra . ". ID del pedido: " . $idPedido;
            } else {
                $result['mensaje'] = "Error al registrar el pedido.";
            }

            return $result;
        } else {
            $error = "Error al registrar el pedido: " . $conexion->error;
            error_log($error);
            echo $error;
        }
    } else {
        // Manejar el caso en que el carrito está vacío
        echo "Error: El carrito está vacío.";
    }

    return [];
}

// Llamada a la función (debes proporcionar los valores adecuados)
$resultado = procesarPedido($conexion, $_SESSION['carrito'], $idCliente, $_POST['fecha_recojo'], $_POST['metodo_pago']);

// Salida del resultado (puedes ajustar según tus necesidades)
echo json_encode($resultado);
?>
