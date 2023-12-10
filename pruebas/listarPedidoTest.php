<?php

use PHPUnit\Framework\TestCase.

class listarPedidoTest extends TestCase {
    public function testGenerarTabla() {
        $miClase = new listarPedido();

        $datos = [
            ['id' => 1,'Cliente' => 'julis21' ,'empleado' => 'Juan', 'fecha' => '2023-01-01', 'monto_final' => 100.50, 'metodo_pago' => 'Tarjeta','estado' => 'entregado'],
            ['id' => 2,'Cliente' => 'martin' ,'empleado' => 'Ana', 'fecha' => '2023-01-02', 'monto_final' => 150.75, 'metodo_pago' => 'Efectivo','estado' => 'pendiente'],
        ];

        $tablaGenerada = $miClase->generarTabla($datos);

        // Muestra los datos en forma de arreglo
        echo "Datos:\n";
        print_r($datos);

        // Muestra la tabla generada en la salida estándar
        echo "Tabla Generada:\n";
        echo $tablaGenerada;

       
    }
}

?>
