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
  <link rel="stylesheet" href="splide-4.1.3/splide-4.1.3/dist/css/splide.min.css" />
  <script src="splide-4.1.3/splide-4.1.3/dist/js/splide.min.js"></script>

  <title>Inicio</title>

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

    .container__masVendidos .card:hover {
      transform: translate(-15px);
      box-shadow: 0 12px 16px rgba(0, 0, 0, 0.2);
    }

    .container__masVendidos .card::before {
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

    .container__masVendidos .card:hover::before {
      opacity: 1;
    }

    .container__masVendidos .card img {
      width: 270px;
      height: 260px;
      object-fit: cover;
      padding: 10px;
      transition: filter 0.3s;
    }

    .container__masVendidos .card h4 {
      font-weight: 600;
      filter: brightness(70%);
    }

    .container__masVendidos .card p {
      padding: 0 2rem;
      font-weight: 400;
      font-size: 14px;
    }

    .container__masVendidos .card a {
      font-weight: 500;
      text-decoration: none;
      color: #783f04;
    }

    .container__masVendidos .card .ver-detalle {
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

    .container__masVendidos .card:hover .ver-detalle {
      opacity: 1;
    }
  </style>
</head>

  
<?php
include('Config/conexion.php');

session_start();
if (!isset($_SESSION['Id'])){
    header("Location: indexCliente.php");
}

$iduser = $_SESSION['Id'];
$sql = "SELECT ID_CLIENTE, NOMBRE, APELLIDO, NUMERO_DOC, TELEFONO, CORREO FROM cliente WHERE ID_CLIENTE = '$iduser' ";

$resultado = $conexion->query($sql);
$row = $resultado->fetch_assoc();
?>


<body>
  <!-- Configuración del navbar -->
  <?php include 'headerCliente.php';?>
  <!-- Sliders -->

  <section class="banner">
    <div class="splide">
      <div class="splide__track">
        <ul class="splide__list">
          <li class="splide__slide">
            <img src="img/bannerPasteles.jpg" alt="" />
          </li>
          <li class="splide__slide">
            <img src="img/bannerHalloween.jpg" alt="" />
          </li>
          <li class="splide__slide">
            <img src="img/bannerPersonalizados.jpg" alt="" />
          </li>
        </ul>
      </div>
    </div>
  </section>

  <!-- Productos más vendidos -->

  <h1 class="title">Productos Más Vendidos</h1>
  <div class="container__masVendidos">
    <?php
    include('config/conexion.php');
    $query = "SELECT
                    p.N_PRODUCTO,
                    p.IMG,
                    p.PRECIO
                FROM
                    producto p
                JOIN (
                    SELECT
                        dp.ID_PRODUCTO,
                        SUM(dp.CANTIDAD) AS VENTAS
                    FROM
                        detalle_pedido dp
                    JOIN
                        pedido pe ON dp.ID_PEDIDO = pe.ID_PEDIDO
                    WHERE
                        pe.ESTADO = 'Entregado'
                        AND pe.FECHA <= DATE_SUB(NOW(), INTERVAL 30 DAY)
                    GROUP BY
                        dp.ID_PRODUCTO
                    ORDER BY
                        VENTAS DESC
                    LIMIT 50
                ) top_products ON p.ID_PRODUCTO = top_products.ID_PRODUCTO";
    $resultado = $conexion->query($query);
    while (
      $row =
      $resultado->fetch_assoc()
    ) { ?>
      <div class="card">
        <img src="data:image/jpg;base64, <?php echo base64_encode($row['IMG']); ?>" />
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
    ?>
  </div>

  <!-- Footer -->
  <iframe src="footer/footer.html" frameborder="0" scrolling="no" width="100%" height="320px"></iframe>
  
</body>

</html>
