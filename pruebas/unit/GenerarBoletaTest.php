<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../GenerarBoleta.php';

class GenerarBoletaTest extends TestCase
{
  private $conexion;
  private $dbHost = "localhost";
  private $dbUser = "root";
  private $dbPassword = "";
  private $dbName = "bd_pastelera"; // Nombre de la base de datos de prueba

  public function setUp(): void
  {
    // Configura la conexión a la base de datos de prueba
    $this->conexion = new mysqli($this->dbHost, $this->dbUser, $this->dbPassword, $this->dbName);

    if ($this->conexion->connect_error) {
      die("Error de conexión: " . $this->conexion->connect_error);
    }
    // Crea la base de datos de prueba o restáurala desde un respaldo
    // Asegúrate de tener permisos para crear bases de datos y tablas
    $this->resetDatabase();
  }

  public function tearDown(): void
  {
    // Cierra la conexión a la base de datos
    $this->conexion->close();
  }

  private function resetDatabase()
  {
    // Puedes implementar la lógica para restablecer la base de datos aquí
    // Por ejemplo, ejecutar un script SQL con las tablas y datos de prueba
    // o restaurar desde un respaldo
  }

  public function testGenerarBoletaPDF()
  {
    // Configurar una conexión a la base de datos válida (reemplaza con tus detalles de conexión)
    $conexion = new mysqli($this->dbHost, $this->dbUser, $this->dbPassword, $this->dbName);

    // Verificar la conexión
    if ($conexion->connect_error) {
      die("Error de conexión: " . $conexion->connect_error);
    }

    // Crear una instancia de GenerarBoleta
    $generarBoleta = new GenerarBoleta($conexion);

    // Crear un arreglo de carrito de prueba
    $arregloCarrito = [
      ['Nombre' => 'Torta de Fresa', 'Precio' => 75, 'Cantidad' => 2],
      ['Nombre' => 'Selva Negra', 'Precio' => 85, 'Cantidad' => 1],
    ];

    // Obtener la ruta del directorio de descargas desde GenerarBoleta
    $descargasPath = $generarBoleta->getDescargasPath();
    // Generar un nombre de archivo único con la marca de tiempo
    //$nombreArchivo = 'Boleta_' . date('YmdHis') . '.pdf';
    $nombreArchivo = 'GraciasPorLaCompra.pdf';
    $outputPath = $descargasPath . '/' . $nombreArchivo;

    // Ejecutar la prueba
    $generarBoleta->generarBoletaPDF($arregloCarrito, 2); // 1 es un ejemplo de ID de usuario

    // Comprobar si el archivo se ha generado correctamente
    $this->assertFileExists($outputPath);
    //$this->assertFileExists('GraciasPorLaCompra.pdf', 'El archivo GraciasPorLaCompra.pdf no existe en la ruta:.'.$descargasPath);
  }

  // Agrega más pruebas según sea necesario
}



?>