<?php

if (isset($_GET['id_categoria'])) {
    $id_categoria = $_GET['id_categoria'];
    $sqlConsulta = $conexion->query("SELECT * FROM  producto  where ID_CATEGORIA=$id_categoria") or ($conexion->error);
} else {
    $sqlConsulta = $conexion->query("SELECT *FROM producto") or ($conexion->error);
}

while ($Produ = $sqlConsulta->fetch_assoc()) {
    $idProducto = $Produ['ID_PRODUCTO'];
    $nombre = $Produ['N_PRODUCTO'];
    $precio = $Produ['PRECIO'];
    $img = base64_encode($Produ['IMG']);

?>
<div class="card" data-aos="zoom-in">
            <img src="data:image/jpg;base64, <?php echo $img; ?>">
            <h4><?php echo $nombre; ?></h4>
            <p><a>S/</a>
            <?php echo $precio; ?>
            </p>
            <a class="ver-detalle" href="../../../Cliente/vistas/Cliente/DetalleProducto.php?ID_PRODUCTO=<?php echo $producto['ID_PRODUCTO']; ?>">Ver Detalle del Producto</a>
        </div>
    

    <?php
}
    ?>
     