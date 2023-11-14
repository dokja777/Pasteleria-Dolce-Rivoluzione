function ordenarProductos(orden) {
    var container = document.querySelector('.container__productos');
    var productos = Array.from(container.children);

    productos.sort(function(a, b) {
        var nombreA = a.querySelector('.NombreProducto').textContent.toUpperCase();
        var nombreB = b.querySelector('.NombreProducto').textContent.toUpperCase();

        if (orden === 'asc') {
            return nombreA.localeCompare(nombreB);
        } else {
            return nombreB.localeCompare(nombreA);
        }
    });
    container.innerHTML = '';
    productos.forEach(function(producto) {
        container.appendChild(producto);
    });
}