<?php

include('../../../Servidor/PHP/Cliente/sessionAbiertaCliente.php');

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <link rel="stylesheet" href="../../../Cliente/css/perfil.css" />
    <!-- Iconos en font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Productos</title>
</head>

<body>
    <!-- Configuración del navbar -->

    
    <?php include '../../../Cliente/vistas/Cliente/headerCliente.php'; ?>

    <!--Pefil Cliente-->

   

        <body class="PerfilCliente">

            <section class="grid-container">
                <div class="icono">
                    <i class="fa-solid fa-circle-user"></i>
                </div>
                <div class="nombre">
                    <h1>Hola, <?php echo ($row['NOMBRE']); ?></h1>
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
                        <li><i class="fa-solid fa-user"></i> Nombre: <?php echo ($row['NOMBRE']); ?></li>
                        <li><i class="fa-regular fa-user"></i> Apellido: <?php echo ($row['APELLIDO']); ?></li>
                        <li><i class="fa-solid fa-address-card"></i> Número de documento: <?php echo ($row['NUMERO_DOC']); ?></li>
                        <li><i class="fa-solid fa-phone"></i> Número de teléfono: <?php echo ($row['TELEFONO']); ?></li>
                        <li><i class="fa-solid fa-envelope"></i> Correo electrónico: <?php echo ($row['CORREO']); ?></li>
                        
                    </ul>
                    <form action="">
                    <button>Editar</button> 
                    </form>
                    <form action="../../../Cliente/vistas/Cliente/historialPedido.php">
                        <button>Pedidos</button>
                    </form>
                </section>
            </main>

            <form id="cerrarSesionForm" action="../../../Servidor/PHP/Cliente/cerrarSesionCliente.php" method="post">
                <button type="button" class="cerrar-sesion-button" onclick="confirmarCerrarSesion()">Cerrar Sesión</button>
            </form>

            <script>
            function confirmarCerrarSesion() {
                if (confirm("¿Estás seguro de que deseas cerrar la sesión?")) {
                    document.getElementById("cerrarSesionForm").submit();
                }
            }
            </script>
        
        </body>

       



    <!-- Footer -->
    <iframe src="../../../Cliente/vistas/Cliente/footer.html" frameborder="0" scrolling="no" width="100%" height="320px"></iframe>

</body>

</html>