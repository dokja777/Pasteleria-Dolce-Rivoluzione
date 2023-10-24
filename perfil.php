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
  
    <link rel="stylesheet" href="css/perfil.css" />
    <!-- Iconos en font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Productos</title>
</head>

<body>
    <!-- Configuración del navbar -->

    <?php include 'headerCliente.php';?>

    <!--Pefil Cliente-->

   

        <body class="PerfilCliente">

            <section class="grid-container">
                <div class="icono">
                   
                    <i class="fa-solid fa-circle-user"></i>
                </div>
                <div class="nombre">
                    <h1>Hola, <?php echo utf8_decode($row['NOMBRE']); ?></h1>
                </div>
            </section>
        
            <!--<nav>
                <a href="#">Mi perfil</a>
                <a href="#">Mis pedidos</a>
            </nav> -->
        
            <main class="grid-container">
                <section class="perfil">
                    <h2>Mi Perfil</h2>
                    <ul>
                        <li><i class="fa-solid fa-user"></i> Nombre: <?php echo utf8_decode($row['NOMBRE']); ?></li>
                        <li><i class="fa-regular fa-user"></i> Apellido: <?php echo utf8_decode($row['Apellido']); ?></li>
                        <li><i class="fa-solid fa-address-card"></i> Número de documento: <?php echo utf8_decode($row['NUMERO_DOC']); ?></li>
                        <li><i class="fa-solid fa-phone"></i> Número de teléfono: <?php echo utf8_decode($row['Telefono']); ?></li>
                        <li><i class="fa-solid fa-envelope"></i> Correo electrónico: <?php echo utf8_decode($row['Correo']); ?></li>
                        
                    </ul>
                    
                    <button>Editar</button>
                </section>
            </main>

            <form action="cerrarSesionCliente.php" method="post">
                <button type="submit" class="cerrar-sesion-button">Cerrar Sesión</button>
            </form>

        
        </body>

       



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
            <a href="politicas_privacidad">Política de privacidad</a>
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