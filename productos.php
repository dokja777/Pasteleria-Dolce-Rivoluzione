<?php
include('config/conexion.php');

if (isset($_GET['categoria'])) {
    $categoria = $_GET['categoria'];
    $query = "SELECT * FROM producto WHERE CATEGORIA = '$categoria'";
} else {
    $query = "SELECT * FROM producto";
}

$resultado = $conexion->query($query);
?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css" />
  <!-- Iconos en font awesome -->
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
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

  <!--Filtrado-->
  <main class="cuerpo">
    <div class="header">
      <div class="header-home"><a href="index.html"><i class="fa-solid fa-house"></i></a></div>
      <form action="" method="get">
        <input type="text" name="busqueda" style="width: 500px" id="busqueda" placeholder="Buscar...">
        <input type="submit" name="enviar" class="busca_nom" value="Buscar">
      </form>

    </div>
    <hr>
    <h1 class="title">Catálogo de Productos</h1>

    
    <div class="contenido">
      <div class="container">
        <!--filtrado de productos-->
        <aside class="aside">
          <div class="titulo">
            <p>CATEGORÍAS</p>
          </div>
          <!-- Agrega enlaces para seleccionar la categoría -->
<a href="productos.php?categoria=Tortas">Tortas</a>
<a href="productos.php?categoria=Personalizado">Personalizado</a>
<a href="productos.php?categoria=Galletas">Galletas</a>
<a href="productos.php?categoria=Cupcakes">Cupcakes</a>
<a href="productos.php?categoria=Postres">Postres</a>

        </aside>

        <aside class="aside_filtro">
          <div class="titulo_filtro">
            <p>FILTRO</p>
          </div>
          <p>Ordenar por:</p>
          <select class="PRECIO" name="PRECIO" id="PRECIO">
            <option value="Todos">Todos</option>
            <option value="DESC">De mayor a menor</option>
            <option value="ASC">De menor a mayor</option>
          </select>
          <br>
          <button class="btn-buscar" type="submit" onclick="buscar_precio($('#PRECIO'.val()));">Buscar</button>
        </aside>
      </div>
      <!--Productos-->
      <!-- Catálogo de Productos -->
      <div class="container__productos">
        <?php
        include('config/conexion.php');
        $query = "SELECT * FROM producto";
        $resultado = $conexion->query($query);

        if (isset($_GET['enviar'])) {
          $busqueda = $_GET['busqueda'];

          $consulta = $conexion->query("SELECT * FROM producto WHERE N_PRODUCTO LIKE '%$busqueda%'");
          while ($row = $consulta->fetch_array()) {
            //echo $row['N_PRODUCTO'].'<br>';
            ?>

            
            <div class="card">

            <img src="data:image/jpg;base64, <?php echo base64_encode($row['IMG']); ?>">
              <h4>
                <?php echo $row['N_PRODUCTO']; ?>
              </h4>
              <p>
                <a>S/</a>
                <?php echo $row['PRECIO']; ?>
              </p>
              <button class="ver-detalle">Ver Detalle del Producto</button>
            </div>
            <?php
          }
        }

        
        while ($row = $resultado->fetch_assoc()) {
            $idProducto = $row['ID_PRODUCTO'];
        ?>
            <div class="card" data-aos="zoom-in">
                
                    <img src="data:image/jpg;base64, <?php echo base64_encode($row['IMG']); ?>">
               
                <h4><?php echo $row['N_PRODUCTO']; ?></h4>
                <p><a>S/</a><?php echo $row['PRECIO']; ?></p>

                <a href="DetalleProducto.php?id=<?php echo $idProducto; ?>">
                <button class="ver-detalle">Ver Detalle del Producto</button>
                </a>
            </div>
        <?php
        }
        ?>
        
      </div>
    </div>
  </main>






  <style>
    .title {
      text-align: center;
      font-size: 40px;
      color: #783f04;
      margin-top: 100px;
    }

    .container__productos {
      width: auto;
      column-count: 4;
      max-width: auto;
      height: auto;
      justify-content: center;
      overflow: hidden;
      flex-basis: 0;
      flex-grow: 999;
      min-width: 60%;
      margin-bottom: 30px;
      display: wrap;
    }

    .container__productos .card {
      width: 280px;
      height: 320px;
      border-radius: 8px;
      box-shadow: 0 2px 2px rgba(0, 0, 0, 0.2);
      overflow: hidden;
      margin: 20px;
      text-align: center;
      transition: all 0.25s;
      float: left;
      position: relative;
      overflow: hidden;
    }

    .container__productos .card:hover {
      transform: translate(-15px);
      box-shadow: 0 12px 16px rgba(0, 0, 0, 0.2);
    }

    .container__productos .card::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.7);
      opacity: 0;
      transition: opacity 0.3s;
      pointer-events: none;
    }

    .container__productos .card:hover::before {
      opacity: 1;
    }

    .container__productos .card img {
      width: 270px;
      height: 260px;
      object-fit: cover;
      padding: 10px;
      transition: filter 0.3s;
    }

    .container__productos .card h4 {
      font-weight: 600;
      filter: brightness(70%);
    }

    .container__productos .card p {
      padding: 0 2rem;
      font-weight: 400;
      font-size: 14px;
    }

    .container__productos .card a {
      font-weight: 500;
      text-decoration: none;
      color: #783f04;
    }

    .container__productos .card .ver-detalle {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: white;
      color: #783f04;
      border: none;
      padding: 10px 20px;
      cursor: pointer;
      border-radius: 8px;
      opacity: 0;
      transition: opacity 0.3s;
      width: auto;
    }

    .container__productos .card:hover .ver-detalle {
      opacity: 1;
    }

    /*filtro*/
    .header form {
      display: flex;
      padding: 2px 50px;
    }

    .cuerpo {
      background: #f4f1f1;
    }

    .header {
      display: flex;
      padding-top: 10px;
    }

    .header .header-home {
      padding: 10px 20px;
    }

    .header .header-home a {
      color: #783f04;
    }

    p {
      padding: 10px;
    }

    .header .header-txt {
      padding: 10px 20px;
      color: #783f04;
    }

    .container {
      margin-top: 7px;
      margin-left: 10px;
    }

    .contenedor-items {
      margin: 20px 15px;
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      grid-gap: 30px;
    }

    .aside {
      margin-top: 35px;
      margin-left: 2%;
      flex-basis: 17%;
      background: #f9cb9c;
      border-radius: 5px;
      border: 1.5px solid #783f04;
    }

    .aside_filtro {
      margin-top: 35px;
      margin-left: 2%;
      flex-basis: 17%;
      background: #f9cb9c;
      border-radius: 5px;
      border: 1.5px solid #783f04;
    }

    .titulo p {
      font-weight: bold;
      text-align: center
    }

    .titulo_filtro p {
      font-weight: bold;
      text-align: center;
    }

    .aside_filtro p {
      text-align: center;
    }

    .aside a {
      color: #000;
      text-align: center;
    }

    .container {
      flex-basis: 13rem;
      flex-grow: 1;
      height: 200px;

    }

    .PRECIO {
      position: center;
      margin-top: 5px;
      margin-bottom: 10px;
      margin-left: 30px;
    }

    .contenido {
      display: flex;
      flex-wrap: wrap;
      gap: 1rem;
    }

    .btn-buscar {
      margin-top: 5px;
      margin-bottom: 10px;
      margin-left: 70px;
    }

    .busca_nom {
      padding: 10px;
      padding-left: 20px;
      margin-left: 20px;
      text-align: center;
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

  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>


</body>

</html>