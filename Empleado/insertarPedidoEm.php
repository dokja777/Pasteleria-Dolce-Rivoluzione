<?php
include('../Config/conexion.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idempleado = mysqli_real_escape_string($conexion, $_POST['empleado']);
    $idcliente =mysqli_real_escape_string($conexion,$_POST['cliente']);
    $montoFinal=mysqli_real_escape_string($conexion,$_POST['montoFinal']);
    $fecha=mysqli_real_escape_string($conexion,$_POST['fecha']);
    $metodoPago=mysqli_real_escape_string($conexion,$_POST['metodoPago']);
    $estado=mysqli_real_escape_string($conexion,$_POST['estado']);

    $sql="INSERT INTO pedido(ID_EMPLEADO,ID_CLIENTE,MONTO_FINAL,FECHA,METODO_PAGO,ESTADO) VALUES (?,?,?,?,?,?)";
    $stmt= mysqli_prepare($conexion,$sql);

    mysqli_stmt_bind_param($stmt, 'ssisss', $idempleado, $idcliente, $montoFinal, $fecha,$metodoPago,$estado);

    if (mysqli_stmt_execute($stmt)) {
        echo '<script>';
        echo 'alert("Pedido registrado correctamente.");';
        echo 'window.location.href = "../Empleado/pedidos.php";';  // Reemplaza "ruta_a_tu_pagina_de_pedidos.php" con la URL correcta
        echo '</script>';
        
    } else {
        echo '<script>';
        echo 'alert("Pedido no se pudo eliminar correctamente.");';
        echo 'window.location.href = "../Empleado/agregarPedido.php";';  // Reemplaza "ruta_a_tu_pagina_de_pedidos.php" con la URL correcta
        echo '</script>';
    }

}





?>