<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/style.css" />
  <script defer src="js/inicio.js"></script>
  <!-- Iconos en font awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Libreria splide -->
  <link rel="stylesheet" href="splide-4.1.3/splide-4.1.3/dist/css/splide.min.css">
  <script src="splide-4.1.3/splide-4.1.3/dist/js/splide.min.js"></script>


  <title>Inicio</title>
</head>

<body>
  <!-- Configuración del navbar -->
  <header>
    <div class="header-left">
      <div class="logo">
        <a href="indexCliente.html">
          <img src="img/logo.png" alt="" />
        </a>
      </div>
      <nav>
        <ul>
          <li>
            <a href="indexCliente.html" class="active">Inicio</a>
          </li>
          <li>
            <a href="productos.html">Productos</a>
          </li>
          <li>
            <a href="nosotros.html">Nosotros</a>
          </li>
        </ul>
        <div class="perfil-carrito">
          <a href="perfil.html"><i class="fa-solid fa-user"></i></a>
          <a href="carrito.html"><i class="fa-solid fa-cart-shopping"></i></a>
        </div>
      </nav>
    </div>
    <div class="header-right">
      <div class="perfil-carrito">
        <a href="perfil.html"><i class="fa-solid fa-user"></i></a>
        <a href="carrito.html"><i class="fa-solid fa-cart-shopping"></i></a>
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
    hamburger.onclick = function () {
      nav.classList.toggle("active");
    };
  </script>
  <!-- Sliders -->

  <section class="banner">
    <div class="splide">
      <div class="splide__track">
        <ul class="splide__list">
          <li class="splide__slide"><img src="img/newbanner_1.jpg" alt=""></li>
          <li class="splide__slide"><img src="img/newbanner_2.jpg" alt=""></li>
          <li class="splide__slide"><img src="img/newbanner_3.jpg" alt=""></li>
        </ul>
      </div>
    </div>
  </section>

  <!-- Productos más vendidos -->

  <h1 class="title">Productos Más Vendidos</h1>
  <div class="container__masVendidos">
    <?php
      include ('config/conexion.php');
      $query = "SELECT * FROM producto";
      $resultado = $conexion->query($query);
      while ($row = $resultado->fetch_assoc()) {
        ?>
    <div class="card">
      <img src="data:image/jpg;base64, <?php echo base64_encode($row['IMG']); ?>">
      <h4>
        <?php echo $row['N_PRODUCTO']; ?>
      </h4>
      <p>
        <?php echo $row['PRECIO']; ?>
      </p>
      <a href="#">comprar</a>
    </div>
    <?php
      }
    ?>

  </div>
  <style>
    .title {
      text-align: center;
      font-size: 40px;
      color: #783f04;
      margin-top: 100px;

    }

    .container__masVendidos {
      width: auto;
      max-width: auto;
      height: auto;
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      overflow: hidden;
    }

    .container__masVendidos .card {
      width: 400px;
      height: 400px;
      border-radius: 8px;
      box-shadow: 0 2px 2px rgba(0, 0, 0, 0.2);
      overflow: hidden;
      margin: 20px;
      text-align: center;
      transition: all 0.25s;
      float: left;
    }
    .container__masVendidos .card:hover {
      transform: translate(-15px);
      box-shadow: 0 12px 16px rgba(0, 0, 0, 0.2);
    }
    .container__masVendidos .card img{
      width: 370px;
      height: 370px;
    }
    .container__masVendidos.card h4{
      font-weight: 600;
    }
    .container__masVendidos.card p{
      padding: 0 2rem;
      font-weight: 400;
      font-size: 14px;
    }
    .container__masVendidos.card a{
      font-weight: 500;
      text-decoration: none;
      color:#783f04;
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
        <a href="#">Política de privacidad</a>
        <a href="#">Política de cookies</a>
        <a href="#">Libro de reclamaciones</a>
      </div>

      <div class="box__footer">
        <h2>Contáctanos</h2>
        <a href="#"><i class="fa-brands fa-whatsapp"></i> Whatsapp</a>
        <a href="#"><i class="fa-regular fa-envelope"></i> Correo</a>
        <a href="#"><i class="fa-solid fa-phone"></i> Teléfono</a>
        <a href="#"><i class="fa-solid fa-location-dot"></i> Av San Juan N° 1061, SJM 15801</a>
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