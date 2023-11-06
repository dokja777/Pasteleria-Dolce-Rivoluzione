<?php
include('../../../Servidor/conexion.php');
include('../../../Servidor/PHP/Cliente/carrito.php');


?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="../../../Cliente/css/carrito.css" />
  <!-- Iconos en font awesome -->
  <link rel="stylesheet" href="../../../Cliente/css/style.css" />
  <script src="../../../js/jquery-3.7.1.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="../../../Cliente/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <title>Carrito de Compra</title>


</head>

<body>

  <!-- Configuración del navbar -->

  <?php include('../../../Cliente/vistas/Cliente/headerCliente.php'); ?>

  <!--Carrito de compras-->

  <div class="titulo-carrito" style="text-align:center; color:#783f04; padding-top:20px;">
    <h3>Carrito de compras:</h3>
  </div>
  <div class="section-carrito">
    <div class="container-carrito">
      <div class="row mb-5">
        <form class="col-md-12" method="post">
          <div class="site-blocks-table">
            <table class="table " style="border: 2px solid #783f04; width: 1000px; margin-left:50px; margin-top:50px;">
              <thead>
                <tr>
                  <th class="product-imagen">Imagen</th>
                  <th class="product-nombre">Producto</th>
                  <th class="product-precio">Precio</th>
                  <th class="product-cantidad">Cantidad</th>
                  <th class="product-total">Total</th>
                  <th class="product-quitar">Quitar</th>
                </tr>
              </thead>
              <tbody>
                <?php include('../../../Servidor/PHP/Cliente/funcionalidadCarrito.php'); ?>
              </tbody>
            </table>
            <div class=" col-6 " style="margin-left: 800px; border: 2px ;">
              <a class="btn-compra" href="resumenCompra.php">Realizar Compra</a>
            </div>
            <!--<form action="" class="resumen">
            <h4>Resumen de compra: </h4>
          </form>-->
        </form>

      </div>

      <!-- Footer -->
      <iframe src="../../../Cliente/vistas/Cliente/footer.html" frameborder="0" scrolling="no" width="100%"
        height="320px"></iframe>

</body>

</html>