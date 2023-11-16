<?php
include('../../../Config/conexion.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../../Cliente/css/style.css" />
  <link rel="stylesheet" href="../../../Cliente/css/sesion.css">
  <!-- Iconos en font awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Productos</title>
</head>

<body>
  <!-- Configuración del navbar -->

  <header>
    <div class="header-left">
      <div class="logo">
        <a href="indexCliente.php">
          <img src="../../../Cliente/recursos/img/logo.png" alt="" />
        </a>
      </div>
      <nav>
        <ul>
          <li>
            <a href="indexCliente.php" class="active">Inicio</a>
          </li>
          <li>
            <a href="productos.php">Productos</a>
          </li>
          <li>
            <a href="nosotros.php">Nosotros</a>
          </li>
        </ul>
        <div class="perfil-carrito">
          <a href="perfil.html"><i class="fa-solid fa-user"></i></a>
          <a href="agregar_al_carrito.php"><i class="fa-solid fa-cart-shopping"></i></a>
        </div>
      </nav>
    </div>
    <div class="header-right">
      <div class="perfil-carrito">
        <a href="inicioSesion.php"><i class="fa-solid fa-right-to-bracket" style="color: #51361f;"></i> Inicia Sesión</a>

        <a href="agregar_al_carrito.php"><i class="fa-solid fa-cart-shopping"></i></a>
      </div>
      <div class="hamburger">
        <div></div>
        <div></div>
        <div></div>
      </div>
    </div>
  </header>
  <script>
    hamburger = document.querySelector(".hamburger");
    nav = document.querySelector("nav");
    hamburger.onclick = function() {
      nav.classList.toggle("active");
    };
  </script>


  <!--LOGIN-->


  <main class="cuerpo">
    <div class="header">


      <!--LOGIN---->

      <form action="../../../Servidor/PHP/Cliente/funcionalidadLogin.php" method="POST">
        <h1>INICIA SESIÓN</h1>


        <?php
        if (isset($_GET['error'])) {
        ?>
          <p class="error">
            <?php
            echo $_GET['error']
            ?>
          </p>
        <?php
        }
        ?>

        <hr>
        <br>
        <i class="fa-solid fa-at"></i>
        <label>Correo</label>
        <input name="Correo" type="email" placeholder="Ingresa tu correo electronico">
        <br>
        <i class="fa-solid fa-unlock"></i>
        <label>Contraseña</label>
        <input name="Contraseña" type="password" placeholder="Ingresa tu contraseña">
        <br>
        <hr>
        <br>
        <button type="submit">Iniciar Sesión</button>

        <a href="registro.php">Crear Cuenta</a>
        <br>
        <div class="text-center">
          <br>
          <br>
          <a href="recuperarContrasena.php">¿Olvidaste tu contraseña?</a>
        </div>

      </form>

      <!--FIN LOGIN---->
    </div>


  </main>



  <!-- Footer -->
  <?php
	include('../../../Cliente/vistas/Cliente/footer.php');
	?>

</body>

</html>