<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="../../../Cliente/js/ordenarAz.js"></script>
    <!-- Incluye Popper.js antes que Bootstrap -->


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.0.8/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


  <link rel="stylesheet" href="../../css/style.css" />
  <link rel="stylesheet" href="../../css/styleProductos.css" />
  <title>Catálogo de Productos</title>
</head>

<body>
  <!-- Configuración del navbar -->
  <?php include('../../../Cliente/vistas/Cliente/headerCliente.php'); ?>

  <!-- Buscar productos -->
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
        <?php     //Filtro por categoria
    include('../../../Servidor/PHP/Cliente/filtrarCategoria.php'); ?>

<!--------------------------- Lista por categoria  sql --------------------------------------------------------->
<aside class="aside" style="width:210px">
    <div class="titulo">
        <p style="font-size:19px;">CATEGORÍAS</p>
    </div>
    <ul class="categoria-lista">
        <?php
        // Verificar si $categorias está definida y no es nula
        if (!empty($categorias)) {
            foreach ($categorias as $categoria) {
                echo '<li><a href="productos.php?id_categoria=' . $categoria['ID_CATEGORIA'] . '">' . $categoria['N_CATEGORIA'] . '</a></li>';
            }
        } else {
            echo '<li>No hay categorías disponibles</li>';
        }
        ?>
        <li><a href="productos.php">Todos los productos</a></li>
    </ul>
</aside>
<!----------------------------------------- ---------------------------------->




<!-------------------- Filtro mayor  a menor  ---------------------------------->
      <aside class="aside_filtro">
          <div class="col-md-3">                                
              <div class="titulo_filtro">
                  <form method="GET" class="ordenar">
                  <label for="ordenar"><p style="font-size:19px;">Ordenar por:</p></label>
                  <select name="ordenar" id="ordenar" style="margin-bottom: 15px;">
                    <option value="mayor_precio">Mayor a Menor Precio</option>
                    <option value="menor_precio">Menor a Mayor Precio</option>
                    <option value="popularidad">Productos más populares</option>
                  </select>
                  
                  <button type="submit" name="ordenar_btn" class="orden">Ordena</button>
                </form>
                <br>
              <div class="botones">
            <button  class="a" onclick="ordenarProductos('asc')">Ordenar A - Z</button>
            <button  class="z" onclick="ordenarProductos('desc')">Ordenar Z - A</button>
            </div>
              </div>                
          </div>
          
 
        </aside>
      </div>
      



<!----------------------------------------------------------------------------->

<!--------------------------------- busqueda por productos  SQL--------------------------- -->
      <div class="container__productos">
	 <?php
    // Muestra los productos del catálogo
		include('../../../Servidor/PHP/Cliente/CatalogoProductos.php');
		// Realiza la búsqueda en la base de datos luego de aplicar filtros
		include('../../../Servidor/PHP/Cliente/filtradoProductos.php');
    if (isset($_GET['ordenar_btn'])) {
        // Incluye la lógica de ordenamiento
        include('../../../Servidor/PHP/Cliente/ordenarProductos.php');
      }
		// para ver los productos 
		$filtro=$productos;
		// para ver filtrado productos no encontrados $filtro="";
		$productos = buscarProductosEnBaseDeDatos($filtro);

		if (empty($productos)) { ?>
			<div class="producto-no-encontrado">
            <img src="..\..\recursos\img\notFound.png" alt="Imagen de producto no encontrado" >
      </div>
			<?php
			} else { ?>
			<div class="container__productos">
    <?php foreach ($productos as $producto) { ?>
        <?php if ($producto['STOCK'] > 0) { ?>
            <div class="card">
                <img src="data:image/jpg;base64, <?php echo base64_encode($producto['IMG']); ?>">
                <h4 class="NombreProducto">
                    <?php echo $producto['N_PRODUCTO']; ?>
                </h4>
                <p><a>Stock : </a>
                    <?php 
                    if ($producto['STOCK'] > 0) {
                        echo $producto['STOCK'];
                    } else {
                        echo 'AGOTADO';
                    }
                    ?>
                </p>
                <p><a>S/</a>
                    <?php echo $producto['PRECIO']; ?>
                </p>
                <?php if ($producto['STOCK'] > 0) { ?>
                    <a class="ver-detalle" href="../../../Cliente/vistas/Cliente/DetalleProducto.php?ID_PRODUCTO=<?php echo $producto['ID_PRODUCTO']; ?>">Ver Detalle del Producto</a>
                <?php } ?>
            </div>
        <?php } else { ?>
            <div class="card">
                <img src="data:image/jpg;base64, <?php echo base64_encode($producto['IMG']); ?>">
                <h4 class="NombreProducto">
                    <?php echo $producto['N_PRODUCTO']; ?>
                </h4>
                <p><a>Stock : </a>
                    <?php 
                    if ($producto['STOCK'] > 0) {
                        echo $producto['STOCK'];
                    } else {
                        echo 'AGOTADO';
                    }
                    ?>
                </p>
                <p><a>S/</a>
                    <?php echo $producto['PRECIO']; ?>
                </p>
            </div>
        <?php } ?>
    <?php } ?>
    <?php } ?>

</div>

    <!-- Footer -->
    <?php
	include('../../../Cliente/vistas/Cliente/footer.php');
	?>

<!-------------------------------------------- ---------------------------------->
    </div>   
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

    .botones .a{
   font-weight: 800;
   border: 1px solid black;
   cursor: pointer;
   padding: 2px 7px;
   background-color: white;
   border-radius: 3px;
   justify-content: center;
   display: flex;
  }
  
 .aside_filtro .botones{
    display: flex;
    align-items: center;
    margin: 10px 10px;
    margin-top: 0px;
 }
 .orden{
  margin-top: 9px;
    font-weight: 800;
   border: 1px solid black;
   cursor: pointer;
   padding: 2px 7px;
   border-radius: 3px;
   justify-content: center;
   display: flex;
   margin: 0 auto;
 }

 .ordenar {
  margin-left: 9px;
   font-weight: 900;
   cursor: pointer;
   padding: 2px 10px;
   border-radius: 4px;
 }
  
  .botones .z{
    margin-left: 9px;
    font-weight: 800;
   border: 1px solid black;
   cursor: pointer;
   padding: 2px 7px;
   background-color: white;
   border-radius: 3px;
   justify-content: center;
   display: flex;
  }
  .botones :hover{
   background-color: wheat;
  }
  </style>


</body>

</html>