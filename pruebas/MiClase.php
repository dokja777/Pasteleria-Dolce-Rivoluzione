<?php
class MiClase {
    public function generarTabla($datos) {
        $tabla = "<table>";
        $tabla .= "<tr><th>ID Cliente</th><th>Empleado</th><th>Fecha</th><th>Monto Final</th><th>Método de Pago</th></tr>";

        foreach ($datos as $dato) {
            $tabla .= "<tr>";
            $tabla .= "<td>{$dato['id_cliente']}</td>";
            $tabla .= "<td>{$dato['empleado']}</td>";
            $tabla .= "<td>{$dato['fecha']}</td>";
            $tabla .= "<td>{$dato['monto_final']}</td>";
            $tabla .= "<td>{$dato['metodo_pago']}</td>";
            $tabla .= "</tr>";
        }

        $tabla .= "</table>";

        return $tabla;
    }
}
?>
