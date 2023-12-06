<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../ReporteVentas.php';

class ReporteVentasTest extends TestCase
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

  public function testGenerarReporteVentas()
  {
    // Configurar una conexión a la base de datos válida (reemplaza con tus detalles de conexión)
    $conexion = new mysqli($this->dbHost, $this->dbUser, $this->dbPassword, $this->dbName);

    // Verificar la conexión
    if ($conexion->connect_error) {
      die("Error de conexión: " . $conexion->connect_error);
    }

    // Crear una instancia de ReporteVentas
    $reporteVentas = new ReporteVentas($conexion);

    // Ejecutar la prueba
    $fechaInicio = "2023-12-01"; // Reemplaza con la fecha de inicio deseada
    $fechaFin = "2023-12-31"; // Reemplaza con la fecha de fin deseada
    $cantidadProductos = 10; // Reemplaza con la cantidad de productos deseada

    $datosReporte = $reporteVentas->generarReporteVentas($fechaInicio, $fechaFin, $cantidadProductos);

    // Puedes agregar aserciones para verificar que los datos del reporte sean correctos
    $this->assertIsArray($datosReporte);
    $this->assertNotEmpty($datosReporte);

    // Imprimir el resultado en formato JSON para visualizar en el cmd
    var_dump($datosReporte);

    // Puedes realizar más verificaciones según tus necesidades
  }

  // Agrega más pruebas según sea necesario
}
?>