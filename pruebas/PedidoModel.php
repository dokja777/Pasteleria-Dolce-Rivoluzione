<?php
// PedidoModel.php
include('../Config/conexion.php');

class PedidoModel {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerPedidos($valorCliente, $productosPorPagina, $pagina) {
        $limite = $productosPorPagina;
        $desplazamiento = ($pagina - 1) * $productosPorPagina;

        $sql = "SELECT pedido.ID_PEDIDO, cliente.NOMBRE AS CLIENTE_NOMBRE, empleado.N_EMPLEADO AS EMPLEADO_NOMBRE, pedido.FECHA, pedido.MONTO_FINAL, pedido.METODO_PAGO, pedido.ESTADO 
            FROM pedido
            INNER JOIN cliente ON pedido.ID_CLIENTE = cliente.ID_CLIENTE
            LEFT JOIN empleado ON pedido.ID_EMPLEADO = empleado.ID_EMPLEADO
            WHERE 1";

        if (!empty($valorCliente)) {
            $sql .= " AND cliente.NOMBRE LIKE '%$valorCliente%'";
        }

        $sql .= " ORDER BY pedido.ID_PEDIDO";
        $sql .= " LIMIT $limite OFFSET $desplazamiento";

        $query = $this->conexion->query($sql);

        $pedidos = [];
        while ($resultado = $query->fetch_assoc()) {
            $pedidos[] = $resultado;
        }

        return $pedidos;
    }

    public function obtenerTotalPedidos() {
        $sqlTotal = $this->conexion->query("SELECT COUNT(*) as total FROM pedido");
        return $sqlTotal->fetch_assoc()['total'];
    }
}
?>
