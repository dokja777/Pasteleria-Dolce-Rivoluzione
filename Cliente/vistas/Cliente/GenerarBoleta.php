<?php  include('../../../Servidor/PHP/Cliente/sessionAbiertaCliente.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- Estructura de la boleta -->
<div class="boleta">
    <div class="header">
        <h1><strong>Boleta de Compra</strong> </h1>
        <img class="imglogo" src="../../../Cliente/recursos/img/logo.png" alt="" />
    </div>
    <?php
    // consulta para la boleta 
    if(isset($_SESSION['carrito'])){
        $arregloCarrito = $_SESSION['carrito'];
        $totalCompra = 0;

        foreach($arregloCarrito as $producto){
            echo '<div class="producto">';
            echo '<p><strong>Nombre:</strong> ' . $producto['Nombre'] . '</p>';
            echo '<p><strong>Precio unitario:</strong> S/ ' . $producto['Precio'] . '</p>';
            echo '<p><strong>Cantidad:</strong> ' . $producto['Cantidad'] . '</p>';

            $subtotal = $producto['Precio'] * $producto['Cantidad']; // Calcula el subtotal
            echo '<p><strong>Subtotal:</strong> S/ ' . $subtotal . '</p>';
            $totalCompra += $subtotal; // Agrega el subtotal al total
            echo '</div>';
        }

        // Información adicional
        echo '<div class="info-adicional">';
        echo '<p><strong>Número de pedido:</strong> ' . uniqid() . '</p>';
        echo '<p><strong>Fecha de compra:</strong> ' . date('Y-m-d H:i:s') . '</p>';
        echo '</div>';

        // Total de la compra
        echo '<p class="total"><strong>Total de la compra:</strong> S/ ' . $totalCompra . '</p>';

        echo '<a href="../../../Cliente/vistas/Cliente/generar_pdf.php" class="btn-generar-pdf">Generar PDF</a>';
        echo '<a href="enviar_whatsapp.php" class="btn-enviar-whatsapp">Enviar por WhatsApp</a>';
    }
    ?>
</div>
<!-- ballot styles -->
<style>
    body{
     font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    
    }

    .boleta {
        background-color: #f8f8f8;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 0 10px black;
        max-width: 400px;
        margin: 0 auto;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .imglogo {
        max-width: 100px;
        margin-right: 20px;
        border-radius: 100px;
        box-shadow: 1px 2px 20px #f9cb9c;
    }

    .producto {
        margin: 10px 0;
        border-bottom: 3px solid #ddd;
        padding-bottom: 10px;
      
    }

    .info-adicional {
        margin-top: 20px;
    }

    .info-adicional p {
        margin: 10px 0;
    }

    h1 {
        font-size: 24px;
        margin-bottom: 10px;
        color: #783f04;
        font-weight: 900;
    }

    .total {
        font-size: 20px;
        text-align: right;
        margin-top: 20px;
        color: #783f04;
    }
    .btn-generar-pdf {
    display: inline-block;
    padding: 10px 20px;
    background-color: #3498db;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    margin-right: 10px;
    transition: background-color 0.3s;
    
}

.btn-generar-pdf:hover {
    background-color: #297fb8;
}

.btn-enviar-whatsapp {
    display: inline-block;
    padding: 10px 20px;
    background-color: #25d366;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.btn-enviar-whatsapp:hover {
    background-color: #1aa34a;
}

</style>
</body>
</html>




