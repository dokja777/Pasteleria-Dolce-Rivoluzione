<?php
// recibe la ID del producto para mostrarlo 
include('../../../Servidor/PHP/Cliente/RecibirIDProducto.php');
?>

<?php

include('../../../Config/conexion.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['Id'])) {
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
    <link rel="stylesheet" href="../../css/styleDetalleProducto.css" />
    <link rel="stylesheet" href="../../css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Detalle del Producto</title>
</head>

<body>
    <!-- Configuración del navbar -->
    <?php include 'headerCliente.php'; ?>

    <!-- Detalles del Producto -->
    <div class="container-detalle">
        <div class="container-imagen">
            <div class="img-detalle">
                <img src="data:image/jpg;base64, <?php echo base64_encode($imagen); ?>" alt="<?php echo $nombre; ?>" width="422.38" height="310.84" />
            </div>
        </div>

        <div class="container-info">
            <div class="info-inner">
                <div class="titulo-detalle">
                    <h1><?php echo $nombre; ?></h1>
                </div>

                <p class="descripcion"><?php echo $descripcion; ?></p>
                <p class="precio">Precio: S/<?php echo $precio; ?></p>
                <br>
                <br>
                <div class="d-grid gap-2 col-6 mx-auto">
                    <a class="btn" href="agregar_al_carrito.php?id=<?php echo $idProducto; ?>">Agrega al carrito</a>
                </div>
            </div>
        </div>
    </div>


    



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- Footer -->
    <iframe src="../../../Cliente/vistas/Cliente/footer.html" frameborder="0" scrolling="no" width="100%" height="320px"></iframe>
</body>

</html>