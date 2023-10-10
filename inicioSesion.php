<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/sesion.css">
  <!-- Iconos en font awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Productos</title>
</head>

<body>
  <!-- Configuración del navbar -->
  <header>
    <div class="header-left">
      <div class="logo">
        <a href="indexCliente.php">
          <img src="img/logo.png" alt="" />
        </a>
      </div>
      <nav>
        <ul>
          <li>
            <a href="indexCliente.php">Inicio</a>
          </li>
          <li>
            <a href="productos.php" class="active">Productos</a>
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
          <a href="inicioSesion.php"><i class="fa-solid fa-right-to-bracket" style="color: #51361f;"></i> Inicia Sesión</a>
          <a href="perfil.php"><i class="fa-solid fa-user"></i></a>
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

  
<main class="cuerpo">
        <div class="header">
        
        
        <!--LOGIN---->
        
        <form action="funcionalidadLogin.php" method="POST">
            <h1>INICIA SESIÓN</h1>
            

            <?php 
                if(isset($_GET['error'])) {
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
            

        </form>

        <!--FIN LOGIN---->  
        </div>


    </main>

  

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
        <a href="horarioAtencion.html">Horario de Atención</a>
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
