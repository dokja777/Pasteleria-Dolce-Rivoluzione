<?php
include('../../../Config/conexion.php');

session_start();
if (!isset($_SESSION['Id'])){
    header("Location: indexCliente.php");
}

$iduser = $_SESSION['Id'];
$sql = "SELECT c.ID_CLIENTE, c.NOMBRE, c.APELLIDO, c.NUMERO_DOC, c.TELEFONO, c.CORREO, p.ID_PEDIDO, p.FECHA, p.METODO_PAGO,p.MONTO_FINAL,
d.ID_D_PEDIDO,d.CANTIDAD,d.PRECIO
FROM  detalle_pedido AS d  
JOIN  pedido AS p  ON d.ID_PEDIDO = p.ID_PEDIDO
JOIN cliente AS c ON p.ID_CLIENTE = c.ID_CLIENTE
WHERE p.ID_CLIENTE = '$iduser';
 ";

$resultado = $conexion->query($sql);
$row = $resultado->fetch_assoc();
?>

$sql