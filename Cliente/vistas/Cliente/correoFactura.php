<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../../PHPMailer-master/src/Exception.php';
require '../../../PHPMailer-master/src/PHPMailer.php';
require '../../../PHPMailer-master/src/SMTP.php';

include('../../../Servidor/PHP/Cliente/sessionAbiertaCliente.php');

// Inicializar la variable de correo del cliente
$correoCliente = '';

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['correoCliente'])) {
    // Validar y obtener la dirección de correo electrónico del cliente
    $correoCliente = filter_input(INPUT_POST, 'correoCliente', FILTER_VALIDATE_EMAIL);

    // Verificar si la dirección de correo electrónico es válida
    if ($correoCliente) {
        // Consulta para la boleta
        if (isset($_SESSION['carrito'])) {
            $arregloCarrito = $_SESSION['carrito'];
            $totalCompra = 0;

            // Contenido de la boleta
            ob_start();
            echo '<div class="boleta">';
            echo '<div class="header">';
            echo '<h1><strong>Factura de Compras</strong> </h1>';
            echo '<img class="imglogo" src="../../../Cliente/recursos/img/logo.png" alt="" />';
            echo '</div>';

            foreach ($arregloCarrito as $producto) {
                echo '<div class="producto">';
                echo '<p><strong>Nombre del Pastel:</strong> ' . $producto['Nombre'] . '</p>';
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
            echo '</div>';

            $contenidoBoleta = ob_get_clean();

            // Configuración de PHPMailer
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = 0; // 0 for no debug output, 2 for debug output
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // Configura el servidor SMTP
                $mail->SMTPAuth = true;
                $mail->Username = 'pasteleria.dolce.rivoluzione@gmail.com'; // Tu dirección de correo electrónico
                $mail->Password = 'zmgr yjzv mofy hzra'; // Tu contraseña de correo electrónico
                $mail->SMTPSecure = 'tls'; // O 'ssl' si estás utilizando SSL
                $mail->Port = 587; // Puerto del servidor SMTP

                //Recipients
                $mail->setFrom('pasteleria.dolce.rivoluzione@gmail.com', 'Pastelería Dolce Rivoluzione'); // Tu dirección de correo electrónico y nombre
                $mail->addAddress($correoCliente); // Correo del cliente

                //Content
                $mail->isHTML(true); // Configura el correo para usar HTML
                $mail->Subject = 'Factura de Compra';
                $mail->Body = $contenidoBoleta;

                // Envía el correo
                $mail->send();

                // Establece la variable de sesión para mostrar el mensaje de éxito
                $_SESSION['correo_enviado'] = true;
            } catch (Exception $e) {
                echo "Error al enviar el correo: {$mail->ErrorInfo}";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <title>Factura de Compra</title>

    <!-- Estilos de la boleta -->
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
      
    </style>
</head>
<body>
<h2><i  style="color: red;" class="fas fa-info-circle"></i> Esperar al mensaje de confirmacion Porfavor </h2>
    <!-- Mensaje de éxito -->
    <?php
    if ($_SESSION['correo_enviado']) {
        echo '<div  data-aos="fade-down-left"   class="mensaje-exito"> <i style="color:green";   class="fas fa-check"></i>  La Factura de su compra ha sido enviada satisfactoriamente.</div>';
        // Restablece la variable de sesión para futuros envíos
        $_SESSION['correo_enviado'] = false;
    }
    ?>
      
    <div   data-aos="zoom-in"  class="formularioCorreo">
        <h1>Correo electronico </h1>
        <hr style="border:1px solid gray">
    <form method="post" action="">
        <label for="correoCliente">Ingrese su correo electrónico:</label>
        <input type="email" id="correoCliente" name="correoCliente" placeholder="tucorreo@gmail.com" required>
        <button type="submit">Enviar Factura </button>
        <a href="productos.php">Regrese a la pagina principal</a>
    </form>
   </div>


    <style>
        body{
            margin: 0;
            box-sizing: border-box;
            background-color: wheat;
        } 
        .formularioCorreo{
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            border: 0.5px solid black;
            width: 35%;
            height: 300px;
           margin: 100px 480px;
           box-shadow: 1px 2px 25px black;
           padding-bottom: 50px;
           background-color: white;
          
           
        }
        .formularioCorreo h1{
            font-weight: 900;
            font-size: 29px;
            letter-spacing: 1px;
            padding: 12px 10px;
            
        }
        .formularioCorreo form{
            display: grid ;
            gap: 19px;
           justify-content: center;
           color: black;
           font-size: 19px;
           
           
        }
        form input{
            padding: 9px 10px;
            
            border: 1px solid black;
            
        }
        form button{
            background-color: #1aa34a;
            border: none;
            color:white;
            padding: 5px 10px;
            font-weight: 900;
            cursor: pointer;
            box-shadow: 1px 2px 10px black;
            border-radius: 4px;
        }
        form button:hover{
          background-color: green;
          box-shadow: 1px 2px 10px wheat;
         letter-spacing: 1px;
        }
        form a{
           background-color: #8B0000;
           color: whitesmoke;
           text-decoration: none;
           font-weight: 900;
           padding: 5px 10px;
           font-size: 15px;
           border-radius: 4px;
           box-shadow: 1px 2px 10px black;
          
        }
        form  a:hover{
         background-color: red;
          box-shadow: 1px 2px 10px wheat;
         letter-spacing: 1px;
        }
        h2{
            text-align: center;
            padding-top: 10px;
        }

        .mensaje-exito{
            text-align: center;
            color: black;
            font-weight: 900;

        }



    </style>

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>
</html>
