<?php
include('../../../Servidor/PHP/Cliente/sessionAbiertaCliente.php');

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../../css/style.css" />
  <link rel="stylesheet" href="../../css/styleProductos.css" />
  <title>Catálogo de Productos</title>
</head>

<body>
  <!-- Configuración del navbar -->
  <?php include('../../../Cliente/vistas/Cliente/headerCliente.php'); ?>

  <!-- Buscar productos -->
  <main class="cuerpo">
    <div class="header">
      <div class="header-home"><a href="index.html"><i class="fa-solid fa-house"></i></a></div>
      <form action="" method="get">
        <input type="text" name="busqueda" style="width: 500px" id="busqueda" placeholder="Buscar...">
        <input type="submit" name="enviar" class="busca_nom" value="Buscar">
      </form>

    </div>
    <hr>

    <!-- Catálogo de Productos -->
   
    <h1 class="title">Catálogo de Productos</h1>
    <div class="container__productos__general">

      <!-- Combobox para ordenar los productos -->
      <form method="GET">
        <label for="ordenar">Ordenar por:</label>
        <select name="ordenar" id="ordenar">
          <option value="mayor_precio">Mayor a Menor Precio</option>
          <option value="menor_precio">Menor a Mayor Precio</option>
        </select>
        <button type="submit" name="ordenar_btn">Ordenar</button>
      </form>
		// Muestra los productos del catálogo
		include('../../../Servidor/PHP/Cliente/CatalogoProductos.php');
		// Realiza la búsqueda en la base de datos luego de aplicar filtros
		include('../../../Servidor/PHP/Cliente/filtradoProductos.php');
    if (isset($_GET['ordenar_btn'])) {
        // Incluye la lógica de ordenamiento
        include('../../../Servidor/PHP/Cliente/ordenarProductos.php');
      }
		// para ver los productos 
		$filtro=$productos;
		// para ver filtrado productos no encontrados $filtro="";
		$productos = buscarProductosEnBaseDeDatos($filtro);

		if (empty($productos)) { ?>
			<div class="producto-no-encontrado">
            <img src="..\..\recursos\img\notFound.png" alt="Imagen de producto no encontrado" >
      </div>
			<?php
			} else { ?>
				<div class="container__productos">
			<?php foreach ($productos as $producto) {
				?>
				<div class="card">
					<img src="data:image/jpg;base64, <?php echo base64_encode($producto['IMG']); ?>">
					<h4>
						<?php echo $producto['N_PRODUCTO']; ?>
					</h4>
					<p><a>S/</a>
						<?php echo $producto['PRECIO']; ?>
					</p>
					<a  class="ver-detalle"  href="../../../Cliente/vistas/Cliente/DetalleProducto.php?ID_PRODUCTO=<?php echo $producto['ID_PRODUCTO']; ?>">Ver Detalle del Producto</a>
					
				</div>
				<?php
			} ?>
			</div> <?php
		}
		?>
	</div>



      <?php

      // Muestra los productos del catálogo
      include('../../../Servidor/PHP/Cliente/CatalogoProductos.php');
      // Realiza la búsqueda en la base de datos luego de aplicar filtros
      include('../../../Servidor/PHP/Cliente/filtradoProductos.php');

      if (isset($_GET['ordenar_btn'])) {
        // Incluye la lógica de ordenamiento
        include('../../../Servidor/PHP/Cliente/ordenarProductos.php');
      }
      // para ver los productos 
      $filtro = $productos;
      // para ver filtrado productos no encontrados $filtro="";
      $productos = buscarProductosEnBaseDeDatos($filtro);

      if (empty($productos)) { ?>
        <div class="producto-no-encontrado">
          <img src="..\..\recursos\img\notFound.png" alt="Imagen de producto no encontrado">
        </div>
        <?php
      } else { ?>
        <div class="container__productos">
          <?php foreach ($productos as $producto) {
            ?>
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
            <?php
          } ?>
        </div>
        <?php
      }
      ?>
    </div>


    <!-- Footer -->
    <iframe src="../../../Cliente/vistas/Cliente/footer.html" frameborder="0" scrolling="no" width="100%"
      height="320px"></iframe>
</body>

</html>