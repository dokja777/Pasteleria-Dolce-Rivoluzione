function mostrarConfirmacion(){
    var resultado = confirm("¿Estás seguro de que quieres continuar?");
    
    if (resultado) {
        alert("¡Okey Administrador Actualizado!");
        document.forms["formularioEditar"].submit();
       
    } else {
        window.location.href = "../../../Cliente/vistas/Administrador/editarUsuario.php"; 
    }
}