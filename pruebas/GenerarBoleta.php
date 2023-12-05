<?php
require_once __DIR__ . '/../TCPDF-main/tcpdf.php';

class GenerarBoleta
{
  private $conexion; // Agrega una propiedad para la conexión a la base de datos

  public function __construct($conexion)
  {
    $this->conexion = $conexion;
  }



  // Método para obtener datos del usuario desde la base de datos
  private function obtenerDatosUsuario($idUsuario)
  {
    $query = "SELECT ID_CLIENTE, NOMBRE, APELLIDO, NUMERO_DOC, TELEFONO, CORREO FROM cliente WHERE ID_CLIENTE = ?";
    $stmt = $this->conexion->prepare($query);
    $stmt->bind_param("i", $idUsuario);

    if ($stmt->execute()) {
      $resultado = $stmt->get_result();
      return $resultado->fetch_assoc();
    } else {
      die("Error en la ejecución de la consulta: " . $stmt->error);
    }
  }

  public function getDescargasPath()
  {
    $descargasPath = '';

    // Verificar el sistema operativo
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
      // Si es Windows
      $descargasPath = getenv('USERPROFILE') . '\\Downloads';
    } else {
      // Si es otro sistema operativo (Linux, macOS)
      $descargasPath = getenv('HOME') . '/Downloads';
    }

    return $descargasPath;
  }

  public function generarBoletaPDF($arregloCarrito, $idUsuario)
  {
    // Inicializar TCPDF
    $pdf = new TCPDF();
    $pdf->AddPage();
    $pdf->SetFont('courier', '', 11);

    // Crear el contenido del PDF
    $html = '<div style="background-color: #f8f8f8; padding: 20px; border: 1px solid #ccc; border-radius: 5px; box-shadow: 0 0 10px black; max-width: 400px; margin: 0 auto; text-align: center;" class="boleta">';
    $html .= '<div style="background-color: #f9cb9c;display: flex; justify-content: space-between; align-items: center;" class="header">';
    $html .= '<h1 style="font-size: 24px; margin-bottom: 10px; color: #783f04;"><strong>Patelera Dolce Rivoluzione</strong></h1>';
    $html .= '<h2 style="margin-bottom: 10px; color: #783f04;"><strong>Boleta de Compra</strong></h2>';
    $html .= '</div>';

    // Obtener datos del usuario desde la base de datos
    $datosUsuario = $this->obtenerDatosUsuario($idUsuario);

    // Agregar datos del usuario al HTML
    $html .= '<div class="usuario-info" style=" background-color: #f9cb9c;">';
    $html .= '<p><strong>ID Usuario:</strong> ' . $datosUsuario['ID_CLIENTE'] . '</p>';
    $html .= '<p><strong>Nombre:</strong> ' . $datosUsuario['NOMBRE'] . '</p>';
    $html .= '<p><strong>Apellido:</strong> ' . $datosUsuario['APELLIDO'] . '</p>';
    $html .= '<p><strong>Número de Documento:</strong> ' . $datosUsuario['NUMERO_DOC'] . '</p>';
    $html .= '<p><strong>Teléfono:</strong> ' . $datosUsuario['TELEFONO'] . '</p>';
    $html .= '<p><strong>Correo:</strong> ' . $datosUsuario['CORREO'] . '</p>';
    $html .= '</div>';

    // Consultar correspondiente para el carrito
    if (!empty($arregloCarrito)) {
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
      $html .= '<div class="info-adicional" style=" background-color: #f9cb9c;">';
      $html .= '<p padding-top: 10px;><strong>Número de pedido:</strong> ' . uniqid() . '</p>';
      $html .= '<p><strong>Fecha de compra:</strong> ' . date('Y-m-d H:i:s') . '</p>';
      $html .= '<p class="total" style="font-size:15px ;color: #783f04;"><strong>Total de la compra:</strong> S/ ' . $totalCompra . '</p>';
      $html .= '</div>';
    }

    $html .= '</div>';


    // Establecer el contenido generado en el PDF
    $pdf->writeHTML($html, true, false, true, false, '');

    // Generar un nombre de archivo único con la marca de tiempo
    $nombreBase = 'GraciasPorLaCompra(3)';
    $nombreArchivo = $nombreBase;
    $contador = 1;

    // Verificar si el archivo ya existe
    while (file_exists($this->getDescargasPath() . '/' . $nombreArchivo . '.pdf')) {
      // Si existe, ajustar el nombre agregando un número incremental
      $nombreArchivo = $nombreBase . '(' . $contador . ')';
      $contador++;
    }

    // Finalizar y descargar el PDF con el nombre adecuado
    $outputPath = $this->getDescargasPath() . '/' . $nombreArchivo . '.pdf';
    $pdf->Output($outputPath, 'F');

    // Verificar si el archivo se guardó correctamente
    if (file_exists($outputPath)) {
      echo 'El archivo se generó correctamente en: ' . $outputPath;
      // Proporcionar un enlace para la descarga
      echo '<br><a href="' . $outputPath . '" download>Descargar archivo</a>';
    } else {
      echo 'Error al generar el archivo PDF.';
    }
  }

}

?>