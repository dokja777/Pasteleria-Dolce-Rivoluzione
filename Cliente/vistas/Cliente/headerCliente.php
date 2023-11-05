<?php
include('../../../Servidor/PHP/Cliente/sessionAbiertaCliente.php');

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../../css/style.css" />
  <title> </title>
</head>
<body>
<header>
  <div class="header-left">
    <div class="logo">
      <a href="../../../Cliente/vistas/Cliente/index.php">
        <img class="imglogo" src="../../../Cliente/recursos/img/logo.png" alt="" />
      </a>
    </div>
    <nav>
      <ul>
        <li>
          <a href="../../../Cliente/vistas/Cliente/index.php" class="active">Inicio</a>
        </li>
        <li>
          <a href="../../../Cliente/vistas/Cliente/productos.php">Productos</a>
        </li>
        <li>
          <a href="../../../Cliente/vistas/Cliente/nosotros.php">Nosotros</a>
        </li>
      </ul>
      <div class="perfil-carrito">
        <a href="perfil.html"><i class="fa-solid fa-user"></i></a>
        <a href="../../../Cliente/vistas/Cliente/agregar_al_carrito.php"><i class="fa-solid fa-cart-shopping"></i></a>
      </div>
    </nav>
  </div>
  <div class="header-right">
    <div class="perfil-carrito">
      <a href="../../../Cliente/vistas/Cliente/inicioSesion.php"><i class="fa-solid fa-right-to-bracket" style="color: #51361f;"></i> Inicia Sesión</a>
      <a href="../../../Cliente/vistas/Cliente/perfil.php"><i class="fa-solid fa-user"></i> Bienvenido(a), <?php echo utf8_decode($row['NOMBRE']); ?></a>
      <a href="../../../Cliente/vistas/Cliente/agregar_al_carrito.php"><i class="fa-solid fa-cart-shopping"></i></a>
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
</body>
</html>


