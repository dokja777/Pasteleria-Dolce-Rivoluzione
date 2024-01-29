<?php
include('../../../Servidor/PHP/EmpleadoServidor/SessionAbierta.php');

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

$carrito_mio = isset($_SESSION['carritoEmpleado']) ? $_SESSION['carritoEmpleado'] : array();
$_SESSION['carritoEmpleado'] = $carrito_mio;

// Inicializa $totalcantidad
$totalcantidad = 0;

// Cuenta los elementos en el carrito
if (isset($_SESSION['carritoEmpleado'])) {
  foreach ($carrito_mio as $item) {
    if ($item != NULL) {
      // Asumiendo que el elemento del carrito tiene una clave "cantidad"
      $total_cantidad = $item['cantidad'];
      $totalcantidad += $total_cantidad;
    }
  }
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Agregar Productos</title>
  <link rel="stylesheet" href="StyleLista.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../Cliente/css/StyleLista.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body style="background-color:#EAE6CA;">

  <!-- Formulario de agregar Productos -->
  <br>
  <div class="container">
    <h1 class="text-center" style=" background-color:black;color:white; font-family:var;">Agregar Pedidos</h1>
    <form style="font-family:var;" action="../../../Servidor/PHP/EmpleadoServidor/insertarPedidoEm.php" method="POST"
      enctype="multipart/form-data">

      <div class="mb-3">
        <label class="form-label" style="margin-left:1em;font-style:italic;font-size:20px;">Empleado : </label>
        <input type="text" class="form-control" style="background-color:#EAE6CA; border-color:black;" name="empleado"
          value="<?php echo $_SESSION['ID_EMPLEADO']; ?>" readonly>


      </div>

      <div class="mb-3">
        <label class="form-label" style="margin-left:1em;font-style:italic;font-size:20px;">Cliente : </label>
        <select class="form-select mb-3 " style="background-color:#EAE6CA;border-color:black;" name="cliente" required>
          <option selected disabled>-- Seleccionar cliente --</option >
          <?php
          include("../../../config/conexion.php");
          $sql = $conexion->query("SELECT*fROM cliente");
          while ($resultado = $sql->fetch_assoc()) {
            echo "<option value='" . $resultado['ID_CLIENTE'] . "'>" . $resultado['NOMBRE'] . "</option> ";
          }
          ?>
        </select>
      </div>




      <?php
if (isset($_SESSION['carritoEmpleado'])) {
  $arregloCarrito = $_SESSION['carritoEmpleado'];
  // Variable para almacenar la suma total
  $sumaTotal = 0;

  foreach ($arregloCarrito as $producto) {
    // ... (tu código existente)

    // Actualizar la suma total
    $sumaTotal += $producto['Precio'] * $producto['cantidad'];
  }

  
}
?>


<div class="mb-3">
  <label class="form-label" style="margin-left:1em;font-style:italic;font-size:20px;">Monto Final S/ :</label>
  <input type="number" class="form-control" style="background-color:#EAE6CA;border-color:black;" name="montoFinal" value="<?php echo isset($sumaTotal) ? $sumaTotal : ''; ?>" readonly>
</div>

      <div class="mb-3">
        <label class="form-label" style="margin-left:1em;font-style:italic;font-size:20px;">Fecha de Venta: </label>
        <input type="date" class="form-control" style="background-color:#EAE6CA;border-color:black;" name="fecha"
          required>

      </div>
      <div class="mb-3">
        <label class="form-label" style="margin-left:1em;font-style:italic;font-size:20px;">Fecha de recojo: </label>
        <input type="date" class="form-control" style="background-color:#EAE6CA;border-color:black;" name="fechaRecojo" min="<?php echo date('Y-m-d', strtotime('+3 days')); ?>"
          required>

      </div>
      <div class="mb-3">
        <label for="Metodo pago" style="margin-left:1em;font-style:italic;font-size:20px;">Metodo de pago
          :</label>
        <select class="form-select" style="background-color:#EAE6CA;border-color:black;"
          aria-label="Default select example" name="metodoPago" required>
          <option value="Credito">Credito</option>
          <option value="Yape">Yape</option>
          <option value="Yape">Efectivo</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="estado" style="margin-left:1em;font-style:italic;font-size:20px;">Estado</label>
        <select class="form-select" style="background-color:#EAE6CA;border-color:black;"
          aria-label="Default select example" name="estado" required>
          <option value="Pendiente">Pendiente</option>
          <option value="Completado">Completado</option>
          <option value="Entregado">Entregado</option>
        </select>
      </div>

      <!-- este boton agregar sirve para agregar productos    -->
      <!-- Botón con icono y modal -->
      <button type="button" id="btnVerProductos" class="btn btn-info mx-auto d-block" data-bs-toggle="modal"
        data-bs-target="#modalAgregarProductos">
        <i class="fa-solid fa-cart-plus"></i> Ver Productos Agregados (
        <?php echo $totalcantidad; ?> )
      </button>

      <!-- Modal -->
      <div class="modal fade" id="modalAgregarProductos" tabindex="-1" role="dialog"
        aria-labelledby="modalAgregarProductosLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <!-- Puedes personalizar el contenido del modal según tus necesidades -->
            <div class="modal-header">
              <h5 class="modal-title" id="modalAgregarProductosLabel">Listado de Productos</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="table-responsive">
                <table class="table table-bordered"
                  style="border: 2px solid #783f04; width: 1000px; margin-left:50px; margin-top:50px;">
                  <thead>
                    <tr>
                      <th class="product-imagen">Imagen</th>
                      <th class="product-nombre">Producto</th>
                      <th class="product-precio">Precio</th>
                      <th class="product-cantidad">Cantidad</th>
                      <th class="product-total">Total</th>
                      <th class="product-quitar">Quitar</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php include('../../../Servidor/PHP/EmpleadoServidor/funcionalidadCarritoEmpleado.php'); ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              <!-- Puedes agregar más botones u opciones según tus necesidades -->
            </div>
          </div>
        </div>
      </div>

      <!-- este boton agregar sirve apra agregar  a la base de datos   -->

      <div class="text-center" style="margin-bottom:1em;">
        <br>
        <button type="submit" class="btn btn-danger">Agregar</button>

        <!-- este boton volver te redirecciona a la lista de productos , por ello dice
         listarEmpleado.php  -->
        <a href="../Empleado/pedidos.php" class="btn btn-dark">Volver</a>
      </div>

    </form>

    <!-- Tabla de lista de productos  -->

    <br>
    <div class="container">
      <h1 class="text-center"
        style=" background-color:black;color:white; height: 80px; font-family:var; padding-top: 12px;"> Lista de
        productos
      </h1>
    </div>

    <div class="container">

      <?php
      //  conexion para mostrar los productos
      include('../../../Servidor/conexion.php');
      ?>

      <form id="formFiltros" style="border: 2px solid #783f04; padding-left: 20px;" method="GET">
        <label for="cantidad">Mostrar cantidad de productos:</label>
        <select name="cantidad" id="cantidad">
          <option value="10" <?= (isset($productosPorPagina) && $productosPorPagina == 10 ? 'selected' : '') ?>>10
          </option>
          <option value="20" <?= (isset($productosPorPagina) && $productosPorPagina == 20 ? 'selected' : '') ?>>20
          </option>
          <option value="30" <?= (isset($productosPorPagina) && $productosPorPagina == 30 ? 'selected' : '') ?>>30
          </option>
          <option value="40" <?= (isset($productosPorPagina) && $productosPorPagina == 40 ? 'selected' : '') ?>>40
          </option>
          <option value="50" <?= (isset($productosPorPagina) && $productosPorPagina == 50 ? 'selected' : '') ?>>50
          </option>
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
          <option value="" <?= (isset($valorCategoria) && $valorCategoria == '' ? 'selected' : '') ?>>Todas las
            categorías
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
        <button type="submit" class="btn btn-success" id="btnAplicarFiltros">Aplicar</button>
      </form>

      <div class="table-responsive">
      <table class="table  table-striped" style="background-color:#f9cb9c; font-family:var; text-align:justify;">
        <thead>
          <tr>
            <th scope="col">ID</th>
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
          include('../../../Servidor/PHP/EmpleadoServidor/buscarProductoCarritoEmpleado.php');
          ?>

        </tbody>
      </table>
      <div class="table-responsive">

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



  </div>
  <!-- esto son script de boostrap  -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>

  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>


  <script src="../../../Cliente/js/filtradoBuscarCarritoEmpleado.js"></script>
  <!-- Incluir Bootstrap JS y jQuery (opcional) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!--
  
  <script>
  // Función para actualizar la cantidad en el botón
  function actualizarCantidadEnBoton(cantidad) {
    // Selecciona el botón por su id
    var boton = document.getElementById('btnVerProductos');

    // Actualiza el contenido del botón con la nueva cantidad
    boton.innerHTML = '<i class="fa-solid fa-cart-plus"></i> Ver Productos Agregados (' + cantidad + ' )';
  }

  // Llama a esta función después de realizar acciones en el carrito que cambien la cantidad
  function actualizarBotonCarrito() {
    // Realiza una solicitud AJAX para obtener la nueva cantidad
    $.ajax({
      method: 'GET',
      url: '../../../Servidor/PHP/EmpleadoServidor/total.php', // Reemplaza con la ruta correcta
    }).done(function (nuevaCantidad) {
      // Llama a la función para actualizar la cantidad en el botón
      actualizarCantidadEnBoton(nuevaCantidad);
    });
  }

  // Ejemplo de cómo llamar a esta función después de agregar, eliminar o cambiar la cantidad de productos
  // Puedes llamar a esta función en el lugar donde actualmente recargas la página o realizas acciones en el carrito
  actualizarBotonCarrito();
</script>

-->
</body>

</html>
