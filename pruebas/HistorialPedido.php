<?php

class HistorialPedido
{
    private $conexion;

    public function __construct($servername, $username, $password, $database)
    {
        // Crear conexión
        $this->conexion = new mysqli($servername, $username, $password, $database);

        // Verificar conexión
        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }
    }

    public function obtenerHistorialPedidosCliente($id_cliente)
    {
        $sql = "SELECT dp.*, prod.N_PRODUCTO as NOMBRE_PRODUCTO
        FROM detalle_pedido dp
        INNER JOIN producto prod ON dp.ID_PRODUCTO = prod.ID_PRODUCTO
        WHERE dp.ID_PEDIDO IN (SELECT ID_PEDIDO FROM pedido WHERE ID_CLIENTE = $id_cliente)
        ORDER BY dp.FECHA_RECOJO DESC";

        $resultado = $this->conexion->query($sql);

        $historialPedidos = [];

        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $historialPedidos[] = $fila;
            }
        }

        return $historialPedidos;
    }

    public function cerrarConexion()
    {
        $this->conexion->close();
    }
}
?>
