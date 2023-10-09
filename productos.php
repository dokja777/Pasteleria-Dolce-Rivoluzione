<!-------------------- consulta para mostrar la categorias ---------------------------------->
<?php
include('config/conexion.php');

// Consulta de categorías
$sql_categorias = $conexion->query("SELECT * FROM categoria_producto") or die($conexion->error);

?>
<!----------------------------------------------------------------------------->

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css" />

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
  <!-------------------- Iconos en font awesome ------------------->
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Productos</title>
</head>
<!-------------------------------------------------------------------------->
<body>
  <!---------------------------------- Configuración del navbar ----------------->
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
          <a href="agregar_al_carrito.php"><i class="fa-solid fa-cart-shopping"></i></a>
        </div>
      </nav>
    </div>
    <div class="header-right">
      <div class="perfil-carrito">
        <a href="perfil.html"><i class="fa-solid fa-user"></i></a>
        <a href="agregar_al_carrito.php"><i class="fa-solid fa-cart-shopping"></i></a>
      </div>
      <div class="hamburger">
        <div></div>
        <div></div>
        <div></div>
      </div>
    </div>
  </header>
  <!-------------------------------------------------------------------------------------->

  <!--------------------Scrip para la hambuerguesa/lista -------------------------------->
  <script>
    hamburger = document.querySelector(".hamburger");
    nav = document.querySelector("nav");
    hamburger.onclick = function () {
      nav.classList.toggle("active");
    };
  </script>
  <!------------------------------------------------------------------------------------------>

  <!------------------------Filtrado de busqueda html-------------------------------->
  <main class="cuerpo">
    <div class="header">
      <div class="header-home"><a href="index.html"><i class="fa-solid fa-house"></i></a></div>
      <form action="" method="get">
        <input type="text" name="busqueda" style="width: 500px" id="busqueda" placeholder="Buscar...">
        <input type="submit" name="enviar" class="busca_nom" value="Buscar">
      </form>

    </div>
    <hr>
    <h1 class="title" style="padding-bottom:1em; margin-top:1em;">Catálogo de Productos</h1>

  <!----------------filtrado de productos html incluye categoria y mayor y menor ----------------------------------->
    <div class="contenido">
      <div class="container">

<!--------------------------- Lista por categoria  sql --------------------------------------------------------->
        <aside class="aside">
              <div class="titulo">
                <p style="font-size:19px;">CATEGORÍAS</p>
              </div>
           <ul class="categoria-lista">
              <?php 
                while($row=$sql_categorias->fetch_array()){ 
                $id_categoria=$row[0]; // IDCategoria de la base de datos
                $categoria=$row[1];// nombre de la categoria base de datos 
              ?>
              
              <li ><a   href="productos.php?id_categoria=<?php echo $id_categoria;?>"><?php echo $categoria;?></a></li>

              <?php
            } //cierre del bucle while   ?>  
             <li><a href="productos.php">Todos los productos</a></li>

           </ul>
      </aside>
<!----------------------------------------- ---------------------------------->




<!-------------------- Filtro mayor  a menor  ---------------------------------->
      <aside class="aside_filtro">
          <div class="col-md-3">                                
              <div class="titulo_filtro">
                  <p>PRECIO</p>
                  <input type="hidden" id="hidden_minimum_price" value="0" />
                  <input type="hidden" id="hidden_maximum_price" value="65000" />
                  <p id="price_show"> 5 - 200</p>
                  <div id="price_range" style="width:150px; margin:auto"></div>
              </div>                
          </div>
          <div class="col-md-9">
              <br>
            <div class="row filter_data">
          </div>
        </div>
          
            <script>
            $(document).ready(function(){
                filter_data();
                function filter_data()
                {
                    $('.filter_data').html('<div id="loading" style="" ></div>');
                    var action = 'fetch_data';
                    var minimum_price = $('#hidden_minimum_price').val();
                    var maximum_price = $('#hidden_maximum_price').val();
                    $.ajax({
                        url:"fetch_data.php",
                        method:"POST",
                        data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price},
                        success:function(data){
                            $('.filter_data').html(data);
                        }
                    });
                }
                $('#price_range').slider({
                    range:true,
                    min:50,
                    max:500,
                    values:[50, 500],
                    step:50,
                    stop:function(event, ui)
                    {
                        $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
                        $('#hidden_minimum_price').val(ui.values[0]);
                        $('#hidden_maximum_price').val(ui.values[1]);
                        filter_data();
                    }
                });
            });
            </script>
        </aside>
      </div>
<!----------------------------------------------------------------------------->

<!--------------------------------- busqueda por productos  SQL--------------------------- -->
      <div class="container__productos">
        <?php
        include('config/conexion.php');
        $query = "SELECT * FROM producto";
        $resultado = $conexion->query($query);

        if (isset($_GET['enviar'])) {
          $busqueda = $_GET['busqueda'];

          $consulta = $conexion->query("SELECT * FROM producto WHERE N_PRODUCTO LIKE '%$busqueda%'");
          while ($row = $consulta->fetch_array()) {
            $idProducto = $row['ID_PRODUCTO'];
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
              <a href="DetalleProducto.php?id=<?php echo $idProducto; ?>">
                <button class="ver-detalle">Ver Detalle del Producto</button>
            </a>
            </div>
            <?php
          }
        }
        ?>
<!--------------------------------------------------------------------------------------->


 <!------------------------Filtro por categoria ----------------------------------------->

         <?php

    //  esto es para el filtro de categoria 
    include('config/conexion.php');

// Consulta de productos
if (isset($_GET['id_categoria'])) {
    $id_categoria = $_GET['id_categoria'];
    $sql_producto = $conexion->query("SELECT * FROM producto WHERE ID_CATEGORIA = $id_categoria") or die($conexion->error);
} else {
    $sql_producto = $conexion->query("SELECT * FROM producto") or die($conexion->error);
}

while ($fila = $sql_producto->fetch_assoc()) {
    $idProducto = $fila['ID_PRODUCTO'];
    $nombre = $fila['N_PRODUCTO'];
    $precio = $fila['PRECIO'];
    $img = base64_encode($fila['IMG']);
?>
    <div class="card"data-aos="zoom-in">
        <img src="data:image/jpg;base64, <?php echo $img; ?>">
        <h4><?php echo $nombre; ?></h4>
        <p><a>S/</a><?php echo $precio; ?></p>

        <a href="DetalleProducto.php?id=<?php echo $idProducto; ?>">
            <button class="ver-detalle">Ver Detalle del Producto</button>
        </a>
    </div>
<?php
}
?>
<!-------------------------------------------- ---------------------------------->
        
    </div>
  </main>



  <style>
    
/* ------------- Estilos del filtro de categoria -----------------------  */
ul.categoria-lista li {
    margin-bottom: 2px; 
    margin-left:2px;
    text-align:center;
}

ul.categoria-lista li a {
    text-decoration: none; 
    color: black; 
    font-style:italic;
    padding: 5px 10px; 
    border-radius: 5px; 
    display: inline-block;
    transition: background-color 0.3s, color 0.3s; 
}

ul.categoria-lista li a:hover {
    background-color: LightSalmon; 
    color: black; 
    font-weight:bold;
    letter-spacing:3px;
}
/* ---------------------------------------------------------------------- */

    .title {
      text-align: center;
      font-size: 40px;
      color: #783f04;
      margin-top: 30px;
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
<!-------------------------------------------------------------------->


  <!---------------------------- Footer------------------------------------->
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
  <!--------------------------------------------------------------------------->

  <!--------------------scrip de  estilos para la ismagees--------------------------------->
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
 <!------------------------------------------------------------------------------------->

</body>

</html>