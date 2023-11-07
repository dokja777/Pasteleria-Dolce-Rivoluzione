<?php
include('../../../Servidor/PHP/Cliente/sessionAbiertaCliente.php');
require('../../../TCPDF-main/tcpdf.php');



// Inicializar TCPDF
$pdf = new TCPDF();
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 12);

// Crear el contenido del PDF
$html = '<div style=" padding: 40px; border: 1px solid #ccc; align-items: center; border-radius: 5px; box-shadow: 0 0 10px black; max-width: 500px; margin: 50px;" class="boleta">';
$html .= '<div style="display: flex; justify-content: space-between; align-items: center;" class="header">';
$html .= '<h1 style="font-size: 24px; margin-bottom: 10px; color: #783f04;"><strong>Pasteleria Dolce Rivoluzione</strong></h1>';
$html .= '</div>';


$html .= '<div class="factura">';

if (isset($_SESSION['carrito'])) {
    $arregloCarrito = $_SESSION['carrito'];
    $totalCompra = 0;

    foreach ($arregloCarrito as $producto) {
        $html .= '<div class="producto">';
        $html .= '<p><strong>Nombre:</strong> ' . $producto['Nombre'] . '</p>';
        $html .= '<p><strong>Precio unitario:</strong> S/ ' . $producto['Precio'] . '</p>';
        $html .= '<p><strong>Cantidad:</strong> ' . $producto['Cantidad'] . '</p>';

        $subtotal = $producto['Precio'] * $producto['Cantidad'];
        $html .= '<p><strong>Subtotal:</strong> S/ ' . $subtotal . '</p>';
        $totalCompra += $subtotal;

        // Línea de separación gris
        $html .= '<hr style="border: 3px solid #ddd; margin: 10px 0;">';
        $html .= '</div>';
    }

    // Información adicional
    $html .= '<div class="info-adicional">';
    
    $html .= '<p><strong>Fecha de compra:</strong> ' . date('Y-m-d') . '</p>';
    $html .= '<p><strong>Hora de compra:</strong> ' . date('H:i:s') . '</p>';
   
    $html .= '</div>';

    // Total de la compra
    $html .= '<p class="total" style="text-align: right;"><strong>Total de la compra:</strong> S/ ' . $totalCompra . '</p>';
}

$html .= '</div>';
$html .= '</div>';

// Establecer el contenido generado en el PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Finalizar y descargar el PDF
$pdf->Output('Pasteleria-Dolce-Rivoluzion_Factura_compra.pdf', 'D');
