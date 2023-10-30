<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../../css/style.css" />
	<link rel="stylesheet" href="../../css/styleProductos.css" />
	<title>Catálogo de Productos</title>
</head>

<body>
	 <!-- Configuración del navbar -->
	 <?php include('../../../Cliente/vistas/Cliente/headerCliente.php');?>

	<!-- Catálogo de Productos -->
	<h1 class="title">Catálogo de Productos</h1>
	<div class="container__productos">
		<?php include('../../../Servidor/PHP/Cliente/CatalogoProductos.php'); ?>
		<?php foreach ($productos as $producto) { ?>
			<div class="card">
				<img src="data:image/jpg;base64, <?php echo base64_encode($producto['IMG']); ?>">
				<h4>
					<?php echo $producto['N_PRODUCTO']; ?>
				</h4>
				<p><a>S/</a>
					<?php echo $producto['PRECIO']; ?>
				</p>
				<button class="ver-detalle">Ver Detalle del Producto</button>
			</div>
		<?php } ?>
	</div>

	<!-- Footer -->
	<iframe src="../../../Cliente/vistas/Cliente/footer.html" frameborder="0" scrolling="no" width="100%" height="320px"></iframe>
</body>

</html>