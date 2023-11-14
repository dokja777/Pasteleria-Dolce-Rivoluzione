<?php
date_default_timezone_set('America/Lima'); // Establece la zona horaria a Lima (o la que corresponda)

include('../../../Servidor/PHP/Cliente/sessionAbiertaCliente.php');

// Comprueba si el formulario se ha enviado (solo para verificar)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario de facturación
    $ruc = $_POST["ruc"];
    $nombre = $_POST["nombre"];
    $direccion = $_POST["direccion"];
    $departamento = $_POST["departamento"];
    $provincia = $_POST["provincia"];
    $distrito = $_POST["distrito"];
    $codigo_postal = $_POST["codigo_postal"];
    $telefono = $_POST["telefono"];
    $email = $_POST["email"];
 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Factura</title>
</head>
<body>
    <div class="factura">
        <div class="header">
            <h1><strong>Factura de Compra</strong></h1>
            <img class="imglogo" src="../../../Cliente/recursos/img/logo.png" alt="" />
        </div>

        <?php
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
        }

        // Información adicional
        echo '<div class="info-adicional">';
        echo '<p><strong>Fecha de compra:</strong> ' . date('Y-m-d') . '</p>';
        echo '<p><strong>Hora de compra:</strong> ' . date('H:i:s') . '</p>';
        echo '</div>';
        

        // Información de Facturación
        echo '<div class="facturacion-info">';
        echo '<h2>Información de Facturación:</h2>';
        echo '<p><strong>RUC:</strong> ' . $ruc . '</p>';
        echo '<p><strong>Razón Social (Nombre):</strong> ' . $nombre . '</p>';
        echo '<p><strong>Dirección:</strong> ' . $direccion . '</p>';
        echo '<p><strong>Departamento:</strong> ' . $departamento . '</p>';
        echo '<p><strong>Provincia:</strong> ' . $provincia . '</p>';
        echo '<p><strong>Distrito:</strong> ' . $distrito . '</p>';
        echo '<p><strong>Código Postal:</strong> ' . $codigo_postal . '</p>';
        echo '<p><strong>Teléfono de contacto:</strong> ' . $telefono . '</p>';
        echo '<p><strong>Correo Electrónico:</strong> ' . $email . '</p>';
        echo '</div>';

        // Total de la compra
        echo '<p class="total"><strong>Total de la compra:</strong> S/ ' . $totalCompra . '</p>';

      
        echo '<a href="facturaPDF.php" class="btn-generar-pdf">Generar PDF</a>';
        
    ?>
    </div>

    <style>
        body{
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }

        .factura {
            background-color: #f8f8f8;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px black;
            max-width: 500px;
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
            
            border-bottom: 3px solid #ddd;

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
    </style>
</body>
</html>
