<?php
include('../../../Servidor/PHP/Cliente/sessionAbiertaCliente.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../../../Cliente/css/historialPedido.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Pedidos</title>
</head>

<body>
    <!-- NAVBAR -->
    <?php
     include('../../../Cliente/vistas/Cliente/headerCliente.php');
    
    ?>
    <!--  -->

    <section>
        <div class="containerPrincipal">
        <div class="izquierda">
            <i class="fa-solid fa-circle-user" id="logo"></i>
            <h1><strong>Hola , Usuario</strong> </h1>
            <ul>
                <li><a href="#">Mi Perfil</a></li>
                <li><a href="#">Mis pedidos</a></li>
                </li>
            </ul>
        </div>

        <div class="derecha">
            <div class="grid">
                <h2> <strong>Mis Pedidos</strong> </h2>
                <form action="../../../Cliente/vistas/Cliente/perfil.php">
                    <button> <i class=" fas fa-arrow-left"></i>Pefil </button>
                </form>
            </div>
            

            <div class="container1">
                <div class="top">
                    <p><strong>Fecha de Compra :</strong>  
                    <?php echo ($row['FECHA']); ?>
                    <p><strong>Metodo Pago : </strong>
                    <?php echo ($row['METODO_PAGO']); ?>
                    </p>
                    <p class="total"><strong>Total de compra : </strong> $00.00</p>
                </div>
                <div class="lefMid">
                    <h3><strong>Productos</strong></h3>
                    <div class="table-responsive">
                        <table class="table  table-borderless table-hover">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Nombre del Producto</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">1</td>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                    <td>S/ 15</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

</body>

</html>