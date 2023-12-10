<?php
if (isset($_SESSION['carritoEmpleado'])) {
  $arregloCarrito = $_SESSION['carritoEmpleado'];
  // Variable para almacenar la suma total
  $sumaTotal = 0;
  
  foreach ($arregloCarrito as $producto) {
    $imagen = $producto['Imagen'];
    echo '<tr>';
    echo '<td class="product-img">';
    echo '<img src="data:image/jpg;base64,' . base64_encode($imagen) . '" alt="" class="img-fluid" style="width:100px">';
    echo '</td>';
    echo '<td class="product-name">';
    echo '<h2 class="h5 text-black">' . $producto['Nombre'] . '</h2>';
    echo '</td>';
    echo '<td>S/ ' . $producto['Precio'] . '</td>';
    echo '<td>';
    echo '<div class="input-group mb-3" style="max-width: 120px;">';
    echo '<div class="input-group-prepend">';
    echo '<button class="btn btn-outline-primary js-btn-minus btnIncrementar" type="button">&minus;</button>';
    echo '</div>';
    echo '<input type="text" class="form-control text-center txtCantidad" data-precio="' . $producto['Precio'] . '" data-id="' . $producto['Id'] . '" value="' . $producto['cantidad'] . '" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">';
    echo '<div class="input-group-append">';
    echo '<button class="btn btn-outline-primary js-btn-plus btnIncrementar" type="button">&plus;</button>';
    echo '</div>';
    echo '</div>';
    echo '</td>';
    echo '<td class="cant' . $producto['Id'] . '">';
    echo 'S/ ' . $producto['Precio'] * $producto['cantidad'];
    // Actualizar la suma total
    $sumaTotal += $producto['Precio'] * $producto['cantidad'];
    echo '</td>';
    echo '<td><button class="btn btn-primary btn-sm btnEliminarProducto" data-id="' . $producto['Id'] . '">X</button></td>';
    echo '</tr>';
  }

  // Mostrar la suma total
  echo '<tr>';
  echo '<td colspan="4"></td>';
  echo '<td>Total:</td>';
  echo '<td id="totalCarrito">S/ ' . $sumaTotal . '</td>';
  echo '<td></td>';
  echo '</tr>';
}
?>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script >
  document.addEventListener('DOMContentLoaded', function () {
  // Este código se ejecutará cuando el DOM esté listo

  // Función para actualizar el precio
  function actualizarPrecio(input) {
    var cantidad = $(input).val();
    var precio = $(input).data('precio');
    var id = $(input).data('id');
    var mult = parseFloat(cantidad) * parseFloat(precio);
    $(".cant" + id).text("S/ " + mult);
    
    $.ajax({
      method: 'POST',
      url: '../../../Servidor/PHP/EmpleadoServidor/actualizarCarrito.php',
      data: {
        id: id,
        cantidad: cantidad,
      }
    }).done(function (respuesta) {
      // Puedes realizar acciones adicionales después de la actualización aquí
      $('#totalCarrito').html('S/ '+respuesta);
    });
  }

  // Manejo de eventos
  $(".txtCantidad").on('input', function () {
    actualizarPrecio(this);
  });

  $(".btnIncrementar").click(function () {
    var cantidadInput = $(this).closest('tr').find('.txtCantidad');
    var nuevaCantidad = parseInt(cantidadInput.val(), 10) + ($(this).hasClass('js-btn-plus') ? 1 : -1);
    if (nuevaCantidad >= 1) {
      cantidadInput.val(nuevaCantidad);
      actualizarPrecio(cantidadInput);
    }
  });
});

</script>
<script>
  $(document).ready(function () {
    // Manejar el clic en el botón "X" (Eliminar producto)
    $('.btnEliminarProducto').on('click', function () {
      var idProducto = $(this).data('id');

      // Realizar una solicitud AJAX para eliminar el producto del carrito
      $.ajax({
        type: 'POST',
        url: '../../../Servidor/PHP/EmpleadoServidor/eliminarProductoCarrito.php',
        data: { idProducto: idProducto },
        success: function (response) {
          // Manejar la respuesta si es necesario
          console.log('Producto eliminado del carrito:', response);
          var currentUrl = window.location.href;
                window.location.href = currentUrl;
          // Recargar la página para reflejar los cambios
          location.reload();
        },
        error: function (error) {
          console.error('Error al eliminar el producto del carrito:', error);
        }
      });
    });
  });
</script>

<?php

// ... (tu código existente)

// Función para obtener la cantidad total de productos en el carrito
function obtenerCantidadTotalEnCarrito() {
  if (isset($_SESSION['carritoEmpleado'])) {
    $arregloCarrito = $_SESSION['carritoEmpleado'];
    $totalCantidad = 0;

    foreach ($arregloCarrito as $producto) {
      $totalCantidad += $producto['cantidad'];
    }

    return $totalCantidad;
  } else {
    return 0; // Si no hay carrito, la cantidad total es cero
  }
}
?>

