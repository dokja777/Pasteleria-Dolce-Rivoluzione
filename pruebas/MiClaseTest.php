<?php

use PHPUnit\Framework\TestCase;

class MiClaseTest extends TestCase {
    public function testGenerarTabla() {
        $miClase = new MiClase();

        $datos = [
            ['id_cliente' => 1, 'empleado' => 'Juan', 'fecha' => '2023-01-01', 'monto_final' => 100.50, 'metodo_pago' => 'Tarjeta'],
            ['id_cliente' => 2, 'empleado' => 'Ana', 'fecha' => '2023-01-02', 'monto_final' => 150.75, 'metodo_pago' => 'Efectivo'],
        ];

        $tablaGenerada = $miClase->generarTabla($datos);

        $this->assertStringContainsString('<table>', $tablaGenerada);
        $this->assertStringContainsString('<th>ID Cliente</th>', $tablaGenerada);
        $this->assertStringContainsString('<td>1</td>', $tablaGenerada);
        $this->assertStringContainsString('<td>Juan</td>', $tablaGenerada);
        $this->assertStringContainsString('<td>2023-01-01</td>', $tablaGenerada);
        $this->assertStringContainsString('<td>100.50</td>', $tablaGenerada);
        $this->assertStringContainsString('<td>Tarjeta</td>', $tablaGenerada);
    }
}
?>
