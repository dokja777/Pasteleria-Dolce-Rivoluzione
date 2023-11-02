
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../Cliente/css/carrito.css" />
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
</head>
<body>

    <?php
        if (isset($_SESSION['carrito'])) {
            $arregloCarrito = $_SESSION['carrito'];
            for ($i = 0; $i < count($arregloCarrito); $i++) {
                $imagen = $arregloCarrito[$i]['Imagen'];
    ?>
        <tr>
        <td class="product-img">
        <img src="data:image/jpg;base64, <?php echo base64_encode($imagen); ?>" alt="" class="img-fluid" style="width:100px">
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
        <button class="btn btn-outline-primary js-btn-minus btnIncrementar" type="button">&minus;</button>
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
</body>
</html>