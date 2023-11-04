function buscar() {
  var valorCodigo = document.getElementById("codigo").value.toLowerCase();
  var valorNombre = document.getElementById("nombre").value.toLowerCase();
  var valorStock = document.getElementById("stock").value.toLowerCase();
  var filas = document.getElementsByTagName("tr");

  for (var i = 1; i < filas.length; i++) {
    var fila = filas[i];
    var codigo = fila.getElementsByTagName("th")[0].textContent.toLowerCase();
    var nombre = fila.getElementsByTagName("td")[1].textContent.toLowerCase();
    var stock = fila.getElementsByTagName("td")[6].textContent.toLowerCase();

    // Verificar si los campos no están vacíos y si coinciden con el valor de búsqueda
    var codigoValido = valorCodigo === "" || codigo.includes(valorCodigo);
    var nombreValido = valorNombre === "" || nombre.includes(valorNombre);
    var stockValido = valorStock === "" || stock.includes(valorStock);

    if (codigoValido && nombreValido && stockValido) {
      fila.style.display = "";
    } else {
      fila.style.display = "none";
    }
  }
}
