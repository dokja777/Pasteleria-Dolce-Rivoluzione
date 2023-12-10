<?php

use PHPUnit\Framework\TestCase;

class PedidoTest extends TestCase
{
    public function testProcesarPedido()
    {
        // Crear un mock para la conexión a la base de datos
        $conexionMock = $this->getMockBuilder(mysqli::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Configurar el mock para la consulta exitosa de inserción de pedido
        $conexionMock->expects($this->once())
            ->method('query')
            ->willReturn(true);

        // Configurar el carrito de prueba
        $carrito = [
            ['Nombre' => 'Producto1', 'Precio' => 10, 'Cantidad' => 2],
            ['Nombre' => 'Producto2', 'Precio' => 15, 'Cantidad' => 1],
        ];

        // Otros datos de prueba
        $idCliente = 1;
        $fechaRecojo = '2023-12-31';
        $metodoPago = 'Tarjeta';

        // Crear un mock para la sesión
        $sessionMock = $this->getMockBuilder(stdClass::class)
            ->setMethods(['__get'])
            ->getMock();

        // Configurar el mock para el método __get
        $sessionMock->expects($this->once())
            ->method('__get')
            ->with('carrito')
            ->willReturn($carrito);

        // Llamar a la función con los mocks y datos de prueba, proporcionando un valor simulado para el ID del pedido
        $resultado = procesarPedido($conexionMock, $sessionMock, $idCliente, $fechaRecojo, $metodoPago);

        // Verificar el resultado esperado
        $this->assertEquals(["mensaje" => "Pedido registrado con éxito. Total de la compra: 35. ID del pedido: 123"], $resultado);
    }
}
?>