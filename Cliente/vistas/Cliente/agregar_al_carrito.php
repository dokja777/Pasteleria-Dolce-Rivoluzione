<?php

include('../../../Servidor/PHP/conexion.php');
include('../../../Servidor/PHP/Cliente/carrito.php');


if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_SESSION['Id'])){
    header("Location: ../../../Cliente/vistas/Cliente/index.php");

}

$iduser = $_SESSION['Id'];

$sql = "SELECT ID_CLIENTE, NOMBRE, Apellido, NUMERO_DOC, Telefono, Correo FROM cliente WHERE ID_CLIENTE = '$iduser' ";

$resultado = $conexion->query($sql);
$row = $resultado->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


  <!-- Iconos en font awesome -->
  <link rel="stylesheet" href="../../../Cliente/css/style.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="js/jquery-3.7.1.min.js"></script>
  <link rel="stylesheet" href="../../../Cliente/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <title>Carrito de Compra</title>

  <style>
          .btn-compra {
            letter-spacing: 2px;
            font-family: monospace;
            display: inline-block;
            padding: 10px 20px;
            background-color: coral;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
            position: relative;
            overflow: hidden;
          }

          .btn-compra:hover {
            background-color: LightSalmon;
          }


          .btn-compra::before,
          .btn-compra::after {
            content: "";
            position: absolute;
            width: 100%;
            height: 2px;
            background-color: coral;
            transition: transform 0.3s ease;
          }


          .btn-compra::before {
            top: 0;
            left: 0;
            transform: scaleX(0);
            transform-origin: left;
          }


          .btn-compra::after {
            bottom: 0;
            right: 0;
            transform: scaleX(0);
            transform-origin: right;
          }


          .btn-compra:hover::before {
            transform: scaleX(1);
          }


          .btn-compra:hover::after {
            transform: scaleX(1);
          }
  </style>
</head>

<body>

  <!-- Configuración del navbar -->

  <?php include('../../../Cliente/vistas/Cliente/headerCliente.php');?>

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
                <?php
                if (isset($_SESSION['carrito'])) {
                  $arregloCarrito = $_SESSION['carrito'];
                  for ($i = 0; $i < count($arregloCarrito); $i++) {
                    $imagen = $arregloCarrito[$i]['Imagen'];
                    ?>
                    <tr>
                      <td class="product-img">
                        <img src="data:image/jpg;base64, <?php echo base64_encode($imagen); ?>" alt="" class="img-fluid"
                          style="width:100px">
                      </td>
                      <td class="product-name">
                        <h2 class="h5 text-black">
                          <?php echo $arregloCarrito[$i]['Nombre']; ?>
                        </h2>
                      </td>
                      <td>S/
                        <?php echo $arregloCarrito[$i]['Precio']; ?>
                      </td>
                      <td>
                        <div class="input-group mb-3" style="max-width: 120px;">
                          <div class="input-group-prepend">
                            <button class="btn btn-outline-primary js-btn-minus btnIncrementar"
                              type="button">&minus;</button>
                          </div>
                          <input type="text" class="form-control text-center txtCantidad"
                            data-precio="<?php echo $arregloCarrito[$i]['Precio']; ?>"
                            data-id="<?php echo $arregloCarrito[$i]['Id']; ?>"
                            value="<?php echo $arregloCarrito[$i]['Cantidad']; ?>" placeholder=""
                            aria-label="Example text with button addon" aria-describedby="button-addon1">
                          <div class="input-group-append">
                            <button class="btn btn-outline-primary js-btn-plus btnIncrementar" type="button">&plus;</button>
                          </div>
                        </div>
                      </td>
                      <td class="cant<?php echo $arregloCarrito[$i]['Id']; ?>">
                        S/
                        <?php echo $arregloCarrito[$i]['Precio'] * $arregloCarrito[$i]['Cantidad']; ?>
                      </td>
                      <td><a href="eliminar_producto.php?id=<?php echo $arregloCarrito[$i]['Id']; ?>" class="btn btn-primary btn-sm">X</a></td>

                    </tr>
                  <?php }
                } ?>
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
      <iframe src="../../../Cliente/vistas/Cliente/footer.html" frameborder="0" scrolling="no" width="100%" height="320px"></iframe>

      <script>
        $(document).ready(function () {
          $(".txtCantidad").keyup(function () {
            var cantidad = $(this).val();
            var precio = $(this).data('precio');
            var id = $(this).data('id');
            incrementar(cantidad, precio, id)
          });
          $(".btnIncrementar").click(function () {
            var cantidad = $(this).parent('div').parent('div').find('input').val();
            var precio = $(this).parent('div').parent('div').find('input').data('precio');
            var id = $(this).parent('div').parent('div').find('input').data('id');
            incrementar(cantidad, precio, id)
          });
          function incrementar(cantidad, precio, id) {
            var mult = parseFloat(cantidad) * parseFloat(precio);
            $(".cant" + id).text("S/ " + mult);
            $.ajax({
              method: 'POST',
              url: '../../../Servidor/PHP/Cliente/actualizarCarrito.php',
              data: {
                id: id,
                cantidad: cantidad,
              }
            }).done(function (respuesta) {
            });
          }
        });
      </script>

      
</body>
</html>
