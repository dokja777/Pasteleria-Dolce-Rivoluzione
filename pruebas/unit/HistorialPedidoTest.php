<?php

require_once __DIR__ . '/../HistorialPedido.php';

class HistorialPedidoTest extends PHPUnit\Framework\TestCase
{
    private $historialPedido;

    public function setUp(): void
    {
        $this->historialPedido = new HistorialPedido("localhost", "root", "", "bd_pastelera");
    }

    public function tearDown(): void
    {
        $this->historialPedido->cerrarConexion();
    }

    public function testObtenerHistorialPedidosCliente()
{
    // Supongamos que el ID del cliente es 1 para la prueba
    $id_cliente = 1;

    $historialPedidos = $this->historialPedido->obtenerHistorialPedidosCliente($id_cliente);

    $this->assertIsArray($historialPedidos);
    $this->assertGreaterThanOrEqual(3, count($historialPedidos), 'Se encontraron al menos 3 historias de usuarios para el cliente con ID ' . $id_cliente);

    // Obtener los últimos 3 pedidos si la prueba tiene éxito
    if (!empty($historialPedidos)) {
        $ultimosTresPedidos = array_slice($historialPedidos, 0, 3);

        // Imprimir los detalles de los últimos 3 pedidos
        echo "Detalles de los últimos 3 pedidos:\n";
        foreach ($ultimosTresPedidos as $pedido) {
            echo "ID Pedido: {$pedido['ID_PEDIDO']}, Fecha Recojo: {$pedido['FECHA_RECOJO']}, Producto: {$pedido['NOMBRE_PRODUCTO']}\n";
        }
    }
}

}
?>
