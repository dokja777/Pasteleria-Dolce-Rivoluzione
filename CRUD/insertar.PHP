<?php
include("../config/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $administrador = mysqli_real_escape_string($conexion, $_POST['Administrador']);
    $categoria = mysqli_real_escape_string($conexion, $_POST['CategoriaP']);
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombreP']);
    $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcionP']);
    $precio = mysqli_real_escape_string($conexion, $_POST['precioP']);
    $stock = mysqli_real_escape_string($conexion, $_POST['stockP']);
    
    if (isset($_FILES['imagenP']) && $_FILES['imagenP']['error'] === UPLOAD_ERR_OK) {
        $imagen = file_get_contents($_FILES['imagenP']['tmp_name']);
        
        $sql = "INSERT INTO producto (ID_CATEGORIA, N_PRODUCTO, PRECIO, STOCK, IMG, DESCRIPCION, ID_ADMIN) VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conexion, $sql);
        mysqli_stmt_bind_param($stmt, "isddssi", $categoria, $nombre, $precio, $stock, $imagen, $descripcion, $administrador);

        
        if (mysqli_stmt_execute($stmt)) {
            header("location:../listaproductos.php");
        } else {
            echo "Error al insertar datos: " . mysqli_error($conexion);
        }
        
        mysqli_stmt_close($stmt);
    } else {
        echo "Error al cargar la imagen.";
    }
} else {
    echo "Acceso no válido.";
}
?>
