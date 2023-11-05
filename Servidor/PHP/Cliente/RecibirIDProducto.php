<?php
include('../../../Servidor/conexion.php');

// verificamos si existe el parametro id
if (isset($_GET['ID_PRODUCTO'])) {
    // si lo encuentra el parametro ID se guarda en el idproducto
    $idProducto = $_GET['ID_PRODUCTO'];
   // hacemos la consulta sql con el query
    $query = "SELECT * FROM producto WHERE ID_PRODUCTO = ?";
    // con esto se evita los ataques de inyeccion sql  , es por tema de seguridad
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "i", $idProducto);
    // se ejecuta la consulta
    mysqli_stmt_execute($stmt);
    // se recibe el resultado o consulta obtenida y se guarda en la variable resultado 
    $resultado = mysqli_stmt_get_result($stmt);
    // aqui verificamos si encontro si encontro una fila  en el resultado de la consulta
    if ($row = mysqli_fetch_assoc($resultado)) {
        // los datos que llegan proveniente de los atributos de la base de datos se guardan en las varibles 
        // correspondientes
        $nombre = $row['N_PRODUCTO'];
        $descripcion = $row['DESCRIPCION'];
        $precio = $row['PRECIO'];
        $imagen = $row['IMG'];
    } else {
        echo "Producto no encontrado.";
    }
    //se cierra la declaración SQL preparada para liberar recursos.
    mysqli_stmt_close($stmt);
} else {
    echo "ID de producto no especificado.";
}

?>