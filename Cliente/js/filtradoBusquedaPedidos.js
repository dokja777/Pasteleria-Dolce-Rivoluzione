function buscar() {
    var valorCliente = document.getElementById("cliente").value.toLowerCase();
    var filas = document.getElementsByTagName("tr");
  
    for (var i = 1; i < filas.length; i++) {
      var fila = filas[i];
      var cliente = fila.getElementsByTagName("td")[2].textContent.toLowerCase();
  
      // Verificar si los campos no están vacíos y si coinciden con el valor de búsqueda
      var clienteValido = valorCliente === "" || stock.includes(valorCliente);
  
      if (clienteValido) {
        fila.style.display = "";
      } else {
        fila.style.display = "none";
      }
    }
  }
  
      // Obtener los valores de los campos del filtro de la URL y establecerlos en los elementos de la página
      const urlParams = new URLSearchParams(window.location.search);
      const cantidad = urlParams.get("cantidad");
      const cliente = urlParams.get("cliente");
  
      document.getElementById("cantidad").value = cantidad;
      document.getElementById("cliente").value = cliente;
  