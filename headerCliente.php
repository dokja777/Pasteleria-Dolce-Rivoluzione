

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
            <a href="indexCliente.php" class="active">Inicio</a>
          </li>
          <li>
            <a href="productos.php">Productos</a>
          </li>
          <li>
            <a href="nosotros.html">Nosotros</a>
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
        <a href="perfil.php"><i class="fa-solid fa-user"></i> Bienvenido(a), <?php echo utf8_decode($row['NOMBRE']); ?></a>
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
    hamburger.onclick = function () {
      nav.classList.toggle("active");
    };
  </script>
