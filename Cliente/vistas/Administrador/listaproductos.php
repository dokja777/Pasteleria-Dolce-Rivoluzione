<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--busqueda de productos-->
  <link rel="stylesheet" href="../../../Cliente/css/filtroProductoAdmin.css">
  <script defer src="../../../Cliente/js/buscar_productoAdmin.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

</head>
<title>Lista producto</title>
</head>

<body style="background-color:#EAE6CA; padding-bottom: 50px">

  <!-- Configuración del navbar user y lista -->
  <nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color:#f9cb9c;">
    <div class="container-fluid">
      <img src="img/logo.png" alt="" style="width:5em ;margin-botton:1em;">
      <a class="navbar-brand" href="../../../Cliente/vistas/Administrador/indexAdministrador.php"
        style="font-family:var;color:#783f04;margin-left:1em;font-weight:600;font-size:22px;">Pastelería Dolce
        Rivoluzione</a>

      <div class="collapse navbar-collapse" id="bar">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="btn btn-outline-light" href="../../../Cliente/vistas/Administrador/indexAdministrador.php"
              aria-current="page" style="color:#783f04;margin-left:3em;font-weight:600;">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-outline-light" href="../../../Cliente/vistas/Administrador/listaproductos.php"
              style="color:#783f04;margin-left:2em;font-weight:600;">Productos </a>
          </li>
          <li class="nav-item">
            <a class="btn btn-outline-light" href="../../../Cliente/vistas/Administrador/listarAdministrador.php"
              style="color:#783f04;margin-left:2em;font-weight:600;">Usuarios</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-outline-light" href="../../../Cliente/vistas/Administrador/listarEmpleados.php"
              style="color:#783f04;margin-left:2em;font-weight:600;">Empleados</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-outline-light" href="demanda.php"
              style="color:#783f04;margin-left:2em;font-weight:600;">Demandas</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-outline-light" href="ingreso.php"
              style="color:#783f04;margin-left:2em;font-weight:600;">Ingresos</a>
          </li>
        </ul>

      </div>
    </div>
  </nav>

  <style>
    #bar a {
      border-style: none;
      background-color: ;
      border-radius: 10px;
    }
  </style>


  <!-- Tabla de  lista de  producto  titulo -->
  <br>
  <div class="container">
    <h1 class="text-center"
      style=" background-color:black;color:white; height: 80px; font-family:var; padding-top: 12px;"> Lista de productos
    </h1>
  </div>



  <!-- Tabla de lista de productos  -->

  <div class="container">

    <?php
    //  conexion para mostrar los productos
    include('../../../Servidor/conexion.php');
    ?>

    <form id="formFiltros" style="border: 2px solid #783f04; padding-left: 20px;" method="GET">
      <label for="cantidad">Mostrar cantidad de productos:</label>
      <select name="cantidad" id="cantidad">
        <option value="10" <?= (isset($productosPorPagina) && $productosPorPagina == 10 ? 'selected' : '') ?>>10</option>
        <option value="20" <?= (isset($productosPorPagina) && $productosPorPagina == 20 ? 'selected' : '') ?>>20</option>
        <option value="30" <?= (isset($productosPorPagina) && $productosPorPagina == 30 ? 'selected' : '') ?>>30</option>
        <option value="40" <?= (isset($productosPorPagina) && $productosPorPagina == 40 ? 'selected' : '') ?>>40</option>
        <option value="50" <?= (isset($productosPorPagina) && $productosPorPagina == 50 ? 'selected' : '') ?>>50</option>
      </select>
      <br>
      <input type="hidden" name="pagina" value="1">
      <label for="codigo"> Código:</label>
      <input type="text" name="codigo" id="codigo" value="<?= isset($valorCodigo) ? $valorCodigo : '' ?>">
      <label for="nombre">Nombre:</label>
      <input type="text" name="nombre" id="nombre" value="<?= isset($valorNombre) ? $valorNombre : '' ?>">
      <label for="stock">Stock:</label>
      <input type="text" name="stock" id="stock" value="<?= isset($valorStock) ? $valorStock : '' ?>">
      <br>
      <label for="categoria">Categoría:</label>
      <select name="categoria" id="categoria">
        <option value="" <?= (isset($valorCategoria) && $valorCategoria == '' ? 'selected' : '') ?>>Todas las categorías
        </option>
        <?php
        // Consulta para obtener las categorías
        $queryCategorias = $conexion->query("SELECT * FROM CATEGORIA_PRODUCTO");
        while ($categoria = $queryCategorias->fetch_assoc()) {
          $idCategoria = $categoria['ID_CATEGORIA'];
          $nombreCategoria = $categoria['N_CATEGORIA'];
          echo "<option value='$idCategoria' " . (isset($valorCategoria) && $valorCategoria == $idCategoria ? 'selected' : '') . ">$nombreCategoria</option>";
        }
        ?>
      </select>
      <button type="submit" class="btn btn-success">Aplicar</button>
    </form>
    <div class="container ">
      <a href="../../../Cliente/vistas/Administrador/agregarProducto.php" class="btn btn-success">Agregar producto</a>
    </div>

    <table class="table  table-striped" style="background-color:#f9cb9c; font-family:var; text-align:justify;">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">ADMIN</th>
          <th scope="col">NOMBRE DEL PRODUCTO</th>
          <th scope="col">CATEGORIA</th>
          <th scope="col">IMAGEN</th>
          <th scope="col">DESCRIPCION</th>
          <th scope="col">PRECIO</th>
          <th scope="col">STOCK</th>
          <th scope="col">MEDIDA DEL PASTEL</th>
          <th scope="col">ACCIONES</th>

        </tr>
      </thead>
      <tbody>
        <?php


        include('../../../Servidor/PHP/Administrador/listaProductos.php');
        ?>

      </tbody>
    </table>

  </div>

  <style>
    .container {
      font-family: monospace;
      margin-top: 1em;
      margin-bottom: 1em;
      border-radius: 1em;
    }

    .container a {
      letter-spacing: 3px
    }
  </style>

  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>


  <script src="../../../Cliente/js/filtradoBusquedaProductos.js"></script>
  <!-- Incluir Bootstrap JS y jQuery (opcional) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>