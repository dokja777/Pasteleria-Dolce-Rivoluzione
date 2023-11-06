<?php
include('../../../Servidor/PHP/Cliente/sessionAbiertaCliente.php');
require('../../../TCPDF-main/tcpdf.php');

// Inicializar TCPDF= es para el pdf ,esta descargado 
$pdf = new TCPDF();
$pdf->AddPage();
$pdf->SetFont('courier', '', 11);

// Crear el contenido del PDF igual como esta en la archivo GenerarBoleta.php 
$html = '<div style="background-color: #f8f8f8; padding: 20px; border: 1px solid #ccc; border-radius: 5px; box-shadow: 0 0 10px black; max-width: 400px; margin: 0 auto; text-align: center; " class="boleta">';
$html .= '<div style="background-color: #f9cb9c;display: flex; justify-content: space-between; align-items: center;" class="header">';
$html .= '<h1 style="font-size: 24px; margin-bottom: 10px; color: #783f04;"><strong>Patelera Dolce Rivoluzione</strong></h1>';
$html .= '<h2 style="margin-bottom: 10px; color: #783f04;"><strong>Boleta de Compra</strong></h2>';
$html .= '</div>';

//consular correspondiente para el carrito 
if (isset($_SESSION['carrito'])) {
    $arregloCarrito = $_SESSION['carrito'];
    $totalCompra = 0;

    foreach ($arregloCarrito as $producto) {
        $html .= '<div style="margin: 10px 0; padding-bottom: 10px; text-align: center;" class="producto">';
        $html .= '<p><strong>Nombre:</strong> ' . $producto['Nombre'] . '</p>';
        $html .= '<p><strong>Precio unitario:</strong> S/ ' . $producto['Precio'] . '</p>';
        $html .= '<p><strong>Cantidad:</strong> ' . $producto['Cantidad'] . '</p>';

        $subtotal = $producto['Precio'] * $producto['Cantidad']; // Calcula el subtotal
        $html .= '<p><strong>Subtotal:</strong> S/ ' . $subtotal . '</p>';
        $totalCompra += $subtotal; // Agrega el subtotal al total
        $html .= '</div>';
    }

    // Información adicional
    $html .= '<div class="info-adicional" style=" background-color: #f9cb9c;" >';
    $html .= '<p padding-top: 10px; ><strong>Número de pedido:</strong> ' . uniqid() . '</p>';
    $html .= '<p><strong>Fecha de compra:</strong> ' . date('Y-m-d H:i:s') . '</p>';
    $html .= '<p class="total" style="font-size:15px ;color: #783f04;"><strong>Total de la compra:</strong> S/ ' . $totalCompra . '</p>';
    $html .= '</div>';

   
   
}

$html .= '</div>';

// Establecer el contenido generado en el PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Finalizar y descargar el PDF
$pdf->Output('GraciasPorLaCompra.pdf', 'D');
