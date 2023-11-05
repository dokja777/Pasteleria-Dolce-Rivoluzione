<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../Cliente/css/style.css" />
    <link rel="stylesheet" href="../../../Cliente/css/resumencompra.css" />
    <!-- Iconos en font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Resumen de Compra</title>
</head>
<body>
    <!-- Configuración del navbar -->
    <?php include '../../../Cliente/vistas/Cliente/headerCliente.php';?>
    <!-- Resumen de compra -->
    <main class="cuerpo">
        <div class="header">
            <!-- ... Tu código para el header ... -->
        </div>

        <!-- Usamos CSS Grid para dividir la página en dos columnas -->
        <div class="grid-container">
            <!-- Columna 1: Sección de Identificación y Pago -->
            <div class="identificacion-pago">
                <section class="identificacion-section">
                    <h2>Identificación</h2>
                    <br>
                    <p>
                        <label for="email">Correo electrónico:</label>
                        <input type="email" id="email" value="<?php echo utf8_decode($row['Correo']); ?>">
                    </p>
                    <p>
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" value="<?php echo utf8_decode($row['NOMBRE']); ?>">
                    </p>
                    <p>
                        <label for="telefono">Teléfono:</label>
                        <input type="tel" id="telefono" value="<?php echo utf8_decode($row['Telefono']); ?>">
                    </p>
                    <p>
                        <label for="fecha_recojo">Fecha de recojo:</label>
                        <input type="date" id="fecha_recojo" name="fecha"  min="<?php echo date('Y-m-d', strtotime('+3 days')); ?>"/>
                    </p>
                </section>
                <br>
                <br>
                <section class="pago-section">
                    <h2>Pago</h2>
                    <br>
                    <p>
                        <input type="radio" name="tipo_pago" value="tarjeta_debito"> Tarjeta de débito
                        <input type="radio" name="tipo_pago" value="tarjeta_credito"> Tarjeta de crédito
                        <input type="radio" name="tipo_pago" value="yape"> Yape
                        <input type="radio" name="tipo_pago" value="paypal"> Paypal
                        <input type="radio" name="tipo_pago" value="efectivo"> Efectivo
                    </p>
                    <br>
                    <p>
                        <label for="numero">Número de tarjeta:</label>
                        <input type="text" id="numero">
                    </p>
                    <p>
                        <label for="nombre_apellido">Nombre y apellido como figura en la tarjeta:</label>
                        <input type="text" id="nombre_apellido">
                    </p>
                    <p>
                        <label for="fecha_vencimiento">Fecha de vencimiento:</label>
                        <input type="date" id="fecha_vencimiento">
                    </p>
                    <BR>
                    <p>
                        <input type="checkbox" id="terminos_condiciones"> Acepto los términos y condiciones
                    </p>
                    <br>
                    <button type="submit">COMPRAR</button>
                </section>
            </div>
            
            <!-- Columna 2: Sección de Carrito -->
            <div class="section-carrito">
                <div class="titulo-carrito" style="text-align:center; color:#783f04; padding-top:20px;">
                    <h3>Resumen de compra:</h3>
                </div>
                <div class="container-carrito">
                    <?php
                    include ('../../../Servidor/PHP/Cliente/resumenCompra.php');
                    ?>
                </div>
                <br>
            </div>
        </div>
    </main>

    <!-- ... Tu código para el footer ... -->
    <iframe src="../../../Cliente/vistas/Cliente/footer.html" frameborder="0" scrolling="no" width="100%" height="320px"></iframe>
</body>
</html>
