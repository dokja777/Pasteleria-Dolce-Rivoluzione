<?php
if (isset($_SESSION['carrito'])) {
  $arregloCarrito = $_SESSION['carrito'];
  for ($i = 0; $i < count($arregloCarrito); $i++) {
    $imagen = $arregloCarrito[$i]['Imagen'];
    echo '<tr>';
    echo '<td class="product-img">';
    echo '<img src="data:image/jpg;base64,' . base64_encode($imagen) . '" alt="" class="img-fluid" style="width:100px">';
    echo '</td>';
    echo '<td class="product-name">';
    echo '<h2 class="h5 text-black">' . $arregloCarrito[$i]['Nombre'] . '</h2>';
    echo '</td>';
    echo '<td>S/ ' . $arregloCarrito[$i]['Precio'] . '</td>';
    echo '<td>';
    echo '<div class="input-group mb-3" style="max-width: 120px;">';
    echo '<div class="input-group-prepend">';
    echo '<button class="btn btn-outline-primary js-btn-minus btnIncrementar" type="button">&minus;</button>';
    echo '</div>';
    echo '<input type="text" class="form-control text-center txtCantidad" data-precio="' . $arregloCarrito[$i]['Precio'] . '" data-id="' . $arregloCarrito[$i]['Id'] . '" value="' . $arregloCarrito[$i]['Cantidad'] . '" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">';
    echo '<div class="input-group-append">';
    echo '<button class="btn btn-outline-primary js-btn-plus btnIncrementar" type="button">&plus;</button>';
    echo '</div>';
    echo '</div>';
    echo '</td>';
    echo '<td class="cant' . $arregloCarrito[$i]['Id'] . '">';
    echo 'S/ ' . $arregloCarrito[$i]['Precio'] * $arregloCarrito[$i]['Cantidad'];
    echo '</td>';
    echo '<td><a href="eliminar_producto.php?id=' . $arregloCarrito[$i]['Id'] . '" class="btn btn-primary btn-sm">X</a></td>';
    echo '</tr>';
  }
}
?>
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
      url: '../../../Servidor/PHP/Cliente/actualizarCarrito.php',
      data: {
        id: id,
        cantidad: cantidad,
      }
    }).done(function (respuesta) {
      // Puedes realizar acciones adicionales después de la actualización aquí
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