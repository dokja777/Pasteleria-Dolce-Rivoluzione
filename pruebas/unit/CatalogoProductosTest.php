<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../CatalogoProductos.php';

class CatalogoProductosTest extends TestCase
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

    public function testObtenerProductosSinBusqueda()
    {
        $catalogoProductos = new CatalogoProductos($this->conexion);
        $productos = $catalogoProductos->obtenerProductos('gato');

        $this->assertIsArray($productos);

        // Imprime el array de datos obtenidos
        var_dump($productos);
    }

    public function testObtenerProductosConBusqueda()
    {
        $catalogoProductos = new CatalogoProductos($this->conexion);
        $productos = $catalogoProductos->obtenerProductos('Chocolate');

        $this->assertIsArray($productos);

        // Imprime el array de datos obtenidos
        var_dump($productos);
    }

    // Agrega más pruebas según sea necesario
}
