<?php
session_start();
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
    <title>Resumen de Compra</title>
</head>
<body>

  <!-- Configuración del navbar -->

  <?php include 'headerCliente.php';?>

  <!--Resumen de compra-->

  <main class="cuerpo">
    <div class="header">
    <div class="titulo-carrito" style="text-align:center; color:#783f04; padding-top:20px;">
        <h3>Resumen de compra:</h3>
    </div>

    <div class="section-carrito">
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
    </div>
    <a class="btn-compra" href="seleccionar_pago.php">Seleccionar Método de Pago</a>
    </div>  
</main>

    <style>
      .main {
        width: 100%;
        height: auto;
        display: grid;
        place-items: center;
        background-color: rgb(255, 255, 255);
        padding: 50px 0;
      }

      /* Estilo para cada contenedor de producto */
      .producto {
          background-color: #000;
          color: #fff;
          padding: 10px;
          border-radius: 5px;
          margin: 10px auto; 
          width: 250px; 
          height: 150px; 
          display: flex;
          flex-direction: column;
          align-items: center;
          box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2); 
      }

          /* Estilo para el nombre del producto */
          .producto p:nth-child(2) {
              font-weight: bold;
              margin-top: 5px;
          }

          /* Estilo para el subtotal */
          .producto p:last-child {
              font-weight: bold;
              margin-top: 5px;
          }

          /* Estilo para el total de la compra */
          p.total-compra {
              text-align: center;
              font-size: 18px;
              font-weight: bold;
              margin-top: 20px;
          }

          /* Estilo para el botón de compra */
          .btn-compra {
              background-color: #000;
              color: #fff;
              font-size: 16px;
              padding: 10px 20px;
              border-radius: 5px;
              cursor: pointer;
              margin: 10px auto; 
              display: block; 
              text-align: center;
              width: fit-content;
          }
    </style>

    <!-- Footer -->
  <footer>
    <div class="container__footer">
      <div class="box__footer">
        <div class="logo">
          <img src="img/logo.png" alt="" />
        </div>
      </div>
      <div class="box__footer">
        <h2>Nosotros</h2>
        <a href="nosotros.html">¿Quiénes somos?</a>
        <a href="horarioAtencion.html">Horarios de Atención</a>
        <a href="#">Política de privacidad</a>
        <a href="#">Política de cookies</a>
        <a href="#">Libro de reclamaciones</a>
      </div>

      <div class="box__footer">
        <h2>Contáctanos</h2>
        <a href="#"><i class="fa-brands fa-whatsapp"></i> Whatsapp</a>
        <a href="mailto:dolcerivoluzionepasteleria@gmail.com"><i class="fa-regular fa-envelope"></i> Correo</a>
        <a href="#"><i class="fa-solid fa-phone"></i> Teléfono</a>
        <a href="https://www.google.com/maps?q=Av+San+Juan+N%C2%B0+1061,+SJM+15801" target="_blank">
          <i class="fa-solid fa-location-dot"></i> Av San Juan N° 1061, SJM 15801
        </a>
      </div>

      <div class="box__footer">
        <h2>Síguenos</h2>
        <a href="#"><i class="fab fa-facebook-square"></i> Facebook</a>
        <a href="#"><i class="fab fa-twitter-square"></i> Twitter</a>
        <a href="#"><i class="fab fa-instagram-square"></i> Instagram</a>
      </div>
    </div>

    <div class="box__copyright">
      <hr />
      <p>Todos los derechos reservados © 2023 <b>Pastelería Dolce Rivoluzione</b></p>
    </div>
  </footer>
    
</body>
</html>