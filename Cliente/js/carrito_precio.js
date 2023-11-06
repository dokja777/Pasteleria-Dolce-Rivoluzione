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
