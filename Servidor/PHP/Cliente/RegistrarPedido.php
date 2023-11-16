<?php

include('../../../Servidor/conexion.php');

date_default_timezone_set('America/Lima');

// Comprueba si la sesión no está activa antes de iniciarla
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

// Verifica si las variables de sesión existen
if (isset($_SESSION['carrito'])) {
	$arregloCarrito = $_SESSION['carrito'];
	$totalCompra = 0;
	$idPedido = 1; // Esto es redundante, ya que se sobrescribe más adelante
	$iduser = 2;
	$iduser = $_SESSION['Id'];

	foreach ($arregloCarrito as $producto) {
		$subtotal = $producto['Precio'] * $producto['Cantidad'];
		$totalCompra += $subtotal;
	}

	// Inserta la información en la tabla pedido
	$fechaActual = date("Y-m-d H:i:s");
	$estado = "Pendiente";

	// Obtiene la fecha de recojo del formulario
	$fechaRecojo = isset($_POST['fecha_recojo']) ? $_POST['fecha_recojo'] : 'date("Y-m-d H:i:s")';

	// Obtiene el método de pago del formulario
	$metodoPago = isset($_POST['metodo_pago']) ? $_POST['metodo_pago'] : 'Efectivo';

	// Inserta la información en la tabla pedido
	$sqlInsertPedido = "INSERT INTO pedido (MONTO_FINAL, FECHA, ESTADO, METODO_PAGO, ID_CLIENTE)
                        VALUES ('$totalCompra', '$fechaActual', '$estado', '$metodoPago', '$iduser')";

	if ($conexion->query($sqlInsertPedido) === TRUE) {
		// Obtén el ID del pedido recién insertado
		$idPedido = $conexion->insert_id;

		foreach ($arregloCarrito as $producto) {
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


		// Ahora puedes utilizar $idPedido en tu lógica si es necesario
		echo "Pedido registrado con éxito. Total de la compra: " . $totalCompra . ". ID del pedido: " . $idPedido;

		// Limpia las variables de sesión después de usarlas
		// unset($_SESSION['carrito']);
	} else {
		$error = "Error al registrar el pedido: " . $conexion->error;
		error_log($error);
		echo $error;
	}

	// Cierra la conexión a la base de datos
	//$conexion->close();
	// Limpia las variables de sesión después de usarlas
	// unset($_SESSION['carrito']);
} else {
	// Manejar el caso en el que las variables de sesión no están definidas
	echo "Error: No se encontró información del carrito.";
}
?>