function confirmacion(e) {
    if (confirm("¿Estas seguro que desea eliminar este pedido?")) {
        return true;
        
    } else{
        e.preventDefault();
    }
}

let linkDelete = document.querySelectorAll(".eliminar_pedido");

for (var i = 0; i < linkDelete.length; i++) {
    linkDelete[i].addEventListener('click', confirmacion);
}