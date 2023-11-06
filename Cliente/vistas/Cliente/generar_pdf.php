<?php
include('../../../Servidor/PHP/Cliente/sessionAbiertaCliente.php');
require('../../../TCPDF-main/tcpdf.php');

// Inicializar TCPDF
$pdf = new TCPDF();
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 12);

// Crear el contenido del PDF
$html = '<div style="background-color: #f8f8f8; padding: 20px; border: 1px solid #ccc; border-radius: 5px;box-shadow: 0 0 10px black; max-width: 400px; margin: 0 auto;" class="boleta">';
$html .= '<div style=" display: flex; justify-content: space-between;  align-items: center;" class="header">';
$html .= '<h1 style=" font-size: 24px;  margin-bottom: 10px;color: #783f04;"><strong>Boleta de Compra</strong></h1>';
$html .= '<img class="imglogo" width="40px" src="../../../Cliente/recursos/img/logo.png" alt="" />';
$html .= '</div>';

if(isset($_SESSION['carrito'])){
    $arregloCarrito = $_SESSION['carrito'];
    $totalCompra = 0;

    foreach($arregloCarrito as $producto){
        $html .= '<div class="producto">';
        $html .= '<p><strong>Nombre:</strong> ' . $producto['Nombre'] . '</p>';
        $html .= '<p><strong>Precio unitario:</strong> S/ ' . $producto['Precio'] . '</p>';
        $html .= '<p><strong>Cantidad:</strong> ' . $producto['Cantidad'] . '</p>';

        $subtotal = $producto['Precio'] * $producto['Cantidad']; // Calcula el subtotal
        $html .= '<p><strong>Subtotal:</strong> S/ ' . $subtotal . '</p>';
        $totalCompra += $subtotal; // Agrega el subtotal al total
        $html .= '</div>';
    }

    // Información adicional
    $html .= '<div class="info-adicional">';
    $html .= '<p><strong>Número de pedido:</strong> ' . uniqid() . '</p>';
    $html .= '<p><strong>Fecha de compra:</strong> ' . date('Y-m-d H:i:s') . '</p>';
    $html .= '</div>';

    // Total de la compra
    $html .= '<p class="total"><strong>Total de la compra:</strong> S/ ' . $totalCompra . '</p>';
}

$html .= '</div>';

// Establecer el contenido generado en el PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Finalizar y descargar el PDF
$pdf->Output('boleta_compra.pdf', 'D');
