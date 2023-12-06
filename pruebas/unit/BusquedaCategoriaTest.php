<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../BusquedaCategoria.php';

class BusquedaCategoriaTest extends TestCase
{
    private $conexion;
    private $dbHost = "localhost";
    private $dbUser = "root";
    private $dbPassword = "";
    private $dbName = "bd_pastelera";

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
        // Implementa la lógica para restablecer la base de datos aquí
        // Por ejemplo, ejecutar un script SQL con las tablas y datos de prueba
        // o restaurar desde un respaldo
    }

    public function testObtenerCategorias()
    {
        $busquedaCategoria = new BusquedaCategoria($this->conexion);
        $categorias = $busquedaCategoria->obtenerCategorias();

        $this->assertIsArray($categorias);

        // Imprime el array de categorías obtenido
        var_dump($categorias);
    }

    public function testObtenerProductosPorCategoria()
{
    $busquedaCategoria = new BusquedaCategoria($this->conexion);
    $categorias = $busquedaCategoria->obtenerCategorias();

    // Muestra las categorías disponibles
    echo "Categorías disponibles:\n";
    foreach ($categorias as $categoria) {
        echo $categoria['ID_CATEGORIA'] . ": " . $categoria['N_CATEGORIA'] . "\n";
    }

    // Pregunta al usuario que ingrese el ID de la categoría
    $idCategoria = readline("Ingrese el ID de la categoría: ");

    // Obtiene y muestra los productos de la categoría seleccionada
    $productos = $busquedaCategoria->obtenerProductosPorCategoria($idCategoria);
    var_dump($productos);

    // Afirmación: Verifica que $productos es un array
    $this->assertIsArray($productos);
}

}
?>
