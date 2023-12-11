<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../../css/style.css" />
	<link rel="stylesheet" href="../../css/styleIndexCliente.css" />
	<script defer src="../../js/banner.js"></script>
	<!-- Libreria splide -->
	<link rel="stylesheet" href="../../recursos/libs/splide-4.1.3/splide-4.1.3/dist/css/splide.min.css" />
	<script src="../../recursos/libs/splide-4.1.3/splide-4.1.3/dist/js/splide.min.js"></script>
	<title>Inicio</title>
</head>


<body>
	<!-- Configuración del navbar -->
	<?php include '../../../Cliente/vistas/Cliente/headerCliente.php'; ?>
	<!-- Sliders -->

	<section class="banner">
		<div class="splide">
			<div class="splide__track">
				<ul class="splide__list">
					<li class="splide__slide">
						<img src="../../recursos/img/bannerPasteles.jpg" alt="" />
					</li>
					<li class="splide__slide">
						<img src="../../recursos/img/bannerHalloween.jpg" alt="" />
					</li>
					<li class="splide__slide">
						<img src="../../recursos/img/bannerPersonalizados.jpg" alt="" />
					</li>
				</ul>
			</div>
		</div>
	</section>

	<!-- Productos más vendidos -->

	<h1 class="title">Productos Más Vendidos</h1>
	<div class="container__masVendidos">
		<?php include('../../../Servidor/PHP/Cliente/ProductosMasVendidos.php'); ?>
		<?php foreach ($products as $product) { ?>
			<div class="card">
				<img src="data:image/jpg;base64, <?php echo base64_encode($product['IMG']); ?>" />
				<h4>
					<?php echo $product['N_PRODUCTO']; ?>
				</h4>
				<p><a>Stock : </a>
					<?php echo $product['STOCK']; ?>
				</p>
				<p><a>S/</a>
					<?php echo $product['PRECIO']; ?>
				</p>
				<a  class="ver-detalle"  href="../../../Cliente/vistas/Cliente/DetalleProducto.php?ID_PRODUCTO=<?php echo $product['ID_PRODUCTO']; ?>">Ver Detalle del Producto</a>
			</div>
		<?php } ?>
	</div>



	<!-- Footer -->
	<?php
	include('../../../Cliente/vistas/Cliente/footer.php');
	?>

</body>

</html>