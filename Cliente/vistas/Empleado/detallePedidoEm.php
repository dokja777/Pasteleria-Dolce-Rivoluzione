<!-- Esto hace que la session se siga manteniendo abierta -->
<?php
include('../../../Servidor/PHP/EmpleadoServidor/SessionAbierta.php');
?>
<!-- ----------------------------------------------------------- -->

<!doctype html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Tabla de pedidos </title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<link rel="stylesheet" href="../../../Cliente/css/styleEmpleado.css">
	
	<link rel="stylesheet" href="../../../Cliente/css/styleDetallePedido.css">
	<script src="../../../Cliente/js/inicioEmpleado.js"></script>
</head>

<body>
	<!-------- incluir el  navbar ----->
	<?php include '../../../Cliente/vistas/Empleado/headerEmpleado.php'; ?>

	<div class="table-container">
		<table class="table table-striped" style="background-color:#f9cb9c; font-family:var;">
			<thead>
				<tr>
					<th scope="col" style="background-color:#f9cb9c;">ID Detalle Pedido</th>
					<th scope="col" style="background-color:#f9cb9c;">Dedicatoria</th>
					<th scope="col" style="background-color:#f9cb9c;">Precio</th>
					<th scope="col" style="background-color:#f9cb9c;">Cantidad</th>
					<th scope="col" style="background-color:#f9cb9c;">Nombre del Producto</th>
					<th scope="col" style="background-color:#f9cb9c;">Imagen del Producto</th>
					<th scope="col" style="background-color:#f9cb9c;">Fecha de Recolección</th>
				</tr>
			</thead>
			<tbody>
				<?php
				// Verificar si se proporcionó un ID de pedido válido en la URL
				if (isset($_GET['id'])) {
					// Incluir el archivo PHP que maneja la lógica para mostrar los detalles del pedido
					include('../../../Servidor/PHP/EmpleadoServidor/detallePedido.php');
				} else {
					echo "ID de pedido no especificado.";
				}
				?>
			</tbody>
		</table>
		<div class="container">
			<a href="agregarDetallePedido.php" class="btn btn-success">Agregar Detalle Pedido</a>
		</div>
	</div>
	
</body>

</html>