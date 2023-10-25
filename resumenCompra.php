<?php

include('config/conexion.php');

session_start();
if (!isset($_SESSION['Id'])){
    header("Location: indexCliente.php");

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/resumenPedido.css" />
    <!-- Iconos en font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Estilo para el grid container que divide la página en dos columnas */
        .grid-container {
            display: grid;
            grid-template-columns: 1fr 1fr; /* Divide en dos columnas */
            gap: 20px; /* Espacio entre columnas */
            padding: 20px;
            margin: 40px;
        }

        /* Estilo para la columna 1 que contiene la Identificación y el Pago */
        .identificacion-pago {
            display: flex;
            flex-direction: column;
            width: 620px;
        }

        /* Estilo para la columna de Identificación y Pago */
        .identificacion-section, .pago-section {
            background-color: #f2f2f2; /* Cambia el color de fondo según tu preferencia */
            padding: 20px;
            border-radius: 10px;
            width: 100%;
            margin: 0;
        }

        /* Estilo para la columna de Carrito */
        .section-carrito {
            background-color: #f2f2f2; /* Cambia el color de fondo según tu preferencia */
            padding: 20px;
            border-radius: 10px;
            width: 1100px;
            margin: 0;
        }

        /* Resto de tus estilos para Identificación y Pago */
        .identificacion-section h2 {
            font-size: 24px;
            color: #783f04;
        }

        .identificacion-section label {
            font-weight: bold;
        }

        .identificacion-section input {
            width: 100%;
            padding: 5px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .pago-section h2 {
            font-size: 24px;
            color: #783f04;
        }

        .pago-section input[type="radio"] {
            margin-right: 10px;
        }

        .pago-section input[type="text"],
        .pago-section input[type="date"] {
            width: 100%;
            padding: 5px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .pago-section input[type="checkbox"] {
            margin: 5px 0;
        }

        .pago-section button[type="submit"] {
            background-color: #783f04;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .pago-section button[type="submit"]:hover {
            background-color: #5b2e03;
        }

        /* Estilo para la sección de Resumen de Compra */
        .container-carrito {
            display: flex;
            flex-wrap: wrap;
        }

        .producto {
            background-color: #fff;
            color: #000;
            padding: 10px;
            border-radius: 5px;
            margin: 10px;
            width: calc(33.33% - 20px);
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
        }

        .producto p {
            margin: 5px 0;
        }

        /* Estilo para el botón de compra */
        .btn-compra {
            background-color: #783f04;
            color: #fff;
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            text-align: center;
            width: fit-content;
            margin-top: 20px;
        }

        .btn-compra:hover {
          background-color: #000000;
        }

    </style>
    <title>Resumen de Compra</title>
</head>
<body>
    <!-- Configuración del navbar -->
    <?php include 'headerCliente.php';?>
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
                </section>
                <br>
                <br>
                <section class="pago-section">
                    <h2>Pago</h2>
                    <br>
                    <p>
                        <input type="radio" name="tipo_pago" value="tarjeta_debito"> Tarjeta de débito
                        <input type="radio" name="tipo_pago" value="tarjeta_credito"> Tarjeta de crédito
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
                    if(isset($_SESSION['carrito'])){
                        $arregloCarrito = $_SESSION['carrito'];
                        $totalCompra = 0; 
                      
                        foreach($arregloCarrito as $producto){
                            echo '<div class="producto">';
                            echo '<p>Nombre: ' . $producto['Nombre'] . '</p>';
                            echo '<p>Precio: S/ ' . $producto['Precio'] . '</p>';
                            echo '<p>Cantidad: ' . $producto['Cantidad'] . '</p>';
                           
                            $subtotal = $producto['Precio'] * $producto['Cantidad']; // Calcula el subtotal
                            echo '<p>Subtotal: S/ ' . $subtotal . '</p>';
                            
                            $totalCompra += $subtotal; // Agrega el subtotal al total 
                            echo '</div>';
                            echo '<hr>';
                        }
                        
                        // Total de la compra 
                        echo '<p>Total de la compra: S/ ' . $totalCompra . '</p>';
                    }
                    ?>
                </div>
                <br>
            </div>
        </div>
    </main>

    <!-- ... Tu código para el footer ... -->
</body>
</html>
