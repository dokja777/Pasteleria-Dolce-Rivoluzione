$(document).ready(function () {
    $(".txtCantidad").keyup(function () {
      var cantidad = $(this).val();
      var precio = $(this).data('precio');
      var id = $(this).data('id');
      incrementar(cantidad, precio, id)
    });
    $(".btnIncrementar").click(function () {
      var cantidad = $(this).parent('div').parent('div').find('input').val();
      var precio = $(this).parent('div').parent('div').find('input').data('precio');
      var id = $(this).parent('div').parent('div').find('input').data('id');
      incrementar(cantidad, precio, id)
    });
    function incrementar(cantidad, precio, id) {
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
      });
    }
});