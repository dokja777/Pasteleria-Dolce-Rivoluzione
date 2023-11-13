<?php

include('../../../Servidor/conexion.php');

// Comprueba si la sesión no está activa antes de iniciarla
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

// Verifica si las variables de sesión existen
if (isset($_SESSION['carrito'])) {
	$arregloCarrito = $_SESSION['carrito'];
	$totalCompra = 0;

	$iduser=2;
	$iduser = $_SESSION['Id'];

	foreach ($arregloCarrito as $producto) {
		$producto['Nombre'];
		$producto['Precio'];
		$producto['Cantidad'];
		$subtotal = $producto['Precio'] * $producto['Cantidad'];
		$totalCompra += $subtotal;
	}

	// Obtiene la fecha de recojo del formulario
	//$fechaRecojo = date("Y-m-d");

	// Inserta la información en la tabla pedido
	$fechaActual = date("Y-m-d H:i:s");
	$estado = "Pendiente";
	$metodoPago = "Efectivo";
	// Obtiene la fecha de recojo del formulario
	$fechaRecojo = isset($_POST['fecha_recojo']) ? $_POST['fecha_recojo'] : '';

	// Obtiene el método de pago del formulario
	$metodoPago = isset($_POST['metodo_pago']) ? $_POST['metodo_pago'] : '';


	$sqlInsertPedido = "INSERT INTO pedido (MONTO_FINAL, FECHA, ESTADO, METODO_PAGO, ID_CLIENTE)
                        VALUES ('$totalCompra', '$fechaActual', '$estado', '$metodoPago', '$iduser')";

	if ($conexion->query($sqlInsertPedido) === TRUE) {
		// Obtén el ID del pedido recién insertado
		$idPedido = $conexion->insert_id;

		// Ahora puedes utilizar $idPedido en tu lógica si es necesario
		echo "Pedido registrado con éxito. Total de la compra: " . $totalCompra . ". ID del pedido: " . $idPedido;

		// Limpia las variables de sesión después de usarlas
		// unset($_SESSION['carrito']);
	} else {
		echo "Error al registrar el pedido: " . $conexion->error;
	}

	// Cierra la conexión a la base de datos
	//$conexion->close();
	// Limpia las variables de sesión después de usarlas
	//unset($_SESSION['carrito']);
} else {
	// Manejar el caso en el que las variables de sesión no están definidas
	echo "Error: No se encontró información del carrito.";
}
?>