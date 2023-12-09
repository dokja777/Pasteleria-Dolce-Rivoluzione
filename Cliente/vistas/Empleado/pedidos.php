<!-- Esto hace que la session se siga manteniendo abierta -->
<?php
include('../../../Servidor/PHP/EmpleadoServidor/SessionAbierta.php');
?>
<!-- ----------------------------------------------------------- -->


<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tabla de pedidos </title>
  <link rel="stylesheet" href="../../../Cliente/css/graficoDemanda.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" />
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>


<body>
  <!-------- incluir el  navbar ----->
  <?php include '../../../Cliente/vistas/Empleado/headerSecundario.php'; ?>


  

  
  <form method="post" action="../../../Cliente/vistas/Empleado/filtradoPedidoEm.php">
        <p>Ingresa fecha de recojo</p>

        <br>
        <label for="fecha_inicio">Fecha inicial:</label>
        <input type="date" name="fecha_inicio" id="fecha_inicio" required>

        <label for="fecha_fin">Fecha final:</label>
        <input type="date" name="fecha_fin" id="fecha_fin" required>
        <br>
        <br>
        
        <input type="submit" value="Filtrar">
    </form>


  <form id="formFiltros"  method="GET">
    <div class="conte1">
      <br>
    <label  class="cant" for="cantidad">Mostrar cantidad de pedidos:</label>
    <select name="cantidad" id="cantidad">
      <option value="10" <?= (isset($productosPorPagina) && $productosPorPagina == 10 ? 'selected' : '') ?>>10</option>
      <option value="20" <?= (isset($productosPorPagina) && $productosPorPagina == 20 ? 'selected' : '') ?>>20</option>
      <option value="30" <?= (isset($productosPorPagina) && $productosPorPagina == 30 ? 'selected' : '') ?>>30</option>
      <option value="40" <?= (isset($productosPorPagina) && $productosPorPagina == 40 ? 'selected' : '') ?>>40</option>
      <option value="50" <?= (isset($productosPorPagina) && $productosPorPagina == 50 ? 'selected' : '') ?>>50</option>
    </select>
    <br>
    <input type="hidden" name="pagina" value="1">
    <label for="cliente" class="client"> Cliente:</label>
    <input type="text" name="cliente"  class="clienteinput" id="cliente" value="<?= isset($valorCliente) ? $valorCliente : '' ?>">
    <button  type="submit" class="btn btn-success">Aplicar</button>
    </div>
    <br>
    <div class="conte2">
    <label class="Emple"> Empleado :</label>
    <input list="opciones" class="buscador" id="buscador" name="buscador">
    <datalist id="opciones">
      <option value="julis21">
      <option value="martin">
      <option value="Eduardo">
      <option value="lucas">
      <option value="maximo">
      <option value="cristiano">
    </datalist>

    <label class="Emple"> Estado :</label>
    <input list="opcionesEstado" class="buscador" id="buscadorEstado" name="buscadorEstado">
    <datalist id="opcionesEstado">
      <option value="Entregado">
      <option value="Pendiente">
      <option value="Completado">
    </datalist>
    <br>
    <a href="../Empleado/agregarPedido.php" class="boton" style="margin-bottom:4px">Agregar nuevo pedido</a>
    
    </div>
  </form>

  <h1 class="text-center">Tabla Pedido</h1>

  <div class="container">
    <table class="table table-hover text-center">
      <thead>
        <tr>
          <th scope="col" style="background-color:#f9cb9c;">ID</th>
          <th scope="col" style="background-color:#f9cb9c;">Cliente</th>
          <th scope="col" style="background-color:#f9cb9c;">Empleado</th>
          <th scope="col" style="background-color:#f9cb9c;">Fecha</th>
          <th scope="col" style="background-color:#f9cb9c;">Monto final</th>
          <th scope="col" style="background-color:#f9cb9c;">Metodo de pago</th>
          <th scope="col" style="background-color:#f9cb9c;">Estado</th>
          <th scope="col" style="background-color:#f9cb9c;">Acciones</th>
          <th scope="col" style="background-color:#f9cb9c;">Detalle Pedido</th>
        </tr>
      </thead>

      <tbody>
        <?php include('../../../Servidor/PHP/EmpleadoServidor/listaPedido.php'); ?>
      </tbody>

    </table>

  </div>


  <style>
    body {
      margin: 0;
      font-family: "Lato", sans-serif;
      box-sizing: border-box;
    }


    #bar a {
      border-style: none;
      background-color: #f9cb9c;
      border-radius: 10px;
    }

    .container {
      margin-top: 1em;
      margin-bottom: 1em;
      border-radius: 1em;
    }

    .filtro {
      display: none;
    }

    form label {
      margin-left: 50px;
    }

   

   
    h1 {
      margin-top: 14px;
      font-weight: 700;
      letter-spacing: 2px;
    }

    form .conte1{
      display: flex;
      flex-direction: row;
      margin-top: 15px;
      align-items: center;
      margin-right: 47px;
     
     
    }
    .conte1 select{
      padding: 3px 25px;
      margin-right: 10px;
      text-align: center;
      border: 1px solid black;
      border-radius: 2px;
      box-shadow: 1px 2px 10px whitesmoke;
      box-sizing: border-box;
    }
   .conte1 .cant{
     padding-right: 20px;
    font-size: 16px;
    width: 200px;
   }
    .conte1 .client{
      font-size: 16px;
      letter-spacing: 1px;
      padding-right: 25px;
    }
    .conte1 .clienteinput{
      margin-right: 20px;
      border: 1px solid black;
      border-radius: 2px;
      box-shadow: 1px 2px 10px whitesmoke;
      padding: 3px 19px;
    }
    .conte1 button{
     margin-left: 39px;
      font-weight: 900;
      padding: 4px 30px;
      box-shadow: 1px 2px 10px black;
    }

    .conte2 {
      margin-bottom: 15px;
    }

    .conte2 .Emple{
     letter-spacing: 1px;

    }
    .conte2 .buscador{
      margin-left: 25px;
      border: 1px solid black;
      border-radius: 2px;
      box-shadow: 1px 2px 10px whitesmoke;
      padding: 3px 19px;
      
    }
    .conte2 a{
      margin-top: 20px;
      margin-left: 40px;
      margin-bottom: 20px;
      text-align: center;
      align-items: center;
      justify-content: center;
      text-decoration: none;
      color: white;
      font-weight: bold;
      border-radius: 5px;
      background-color: #198754;
      padding: 7px 10px;
      box-shadow: 1px 2px 10px black;
      width: 200px;
    }

    
  </style>

<script src="../../../Cliente/js/buscarEstadoPedido.js"> </script>

  <script src="../../../Cliente/js/buscadorEmpleado.js"> </script>
  <!-- script para confirmacion de eliminar un empleado -->

  <script src="../../../Cliente/js/confirma_elim_pedido.js"> </script>

  <!--script para filtrado de busqueda-->
  <script src="../../../Cliente/js/filtradoBusquedaPedidos.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>
