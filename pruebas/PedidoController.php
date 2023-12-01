<?php
// PedidoController.php
include('PedidoModel.php');

class PedidoController {
    private $modelo;

    public function __construct($conexion) {
        $this->modelo = new PedidoModel($conexion);
    }

    public function obtenerPedidosPaginados($valorCliente, $productosPorPagina, $pagina) {
        $pedidos = $this->modelo->obtenerPedidos($valorCliente, $productosPorPagina, $pagina);

        // Aquí puedes realizar cualquier procesamiento adicional necesario

        return $pedidos;
    }

    public function obtenerTotalPaginas($productosPorPagina) {
        $totalProductos = $this->modelo->obtenerTotalPedidos();
        $totalPaginas = ceil($totalProductos / $productosPorPagina);
        return $totalPaginas;
    }
}
?>
