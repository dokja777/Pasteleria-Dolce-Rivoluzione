<?php

class BusquedaCategoria
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function obtenerCategorias()
    {
        try {
            $query = "SELECT ID_CATEGORIA, N_CATEGORIA FROM categoria_producto";
            $stmt = $this->conexion->prepare($query);

            if ($stmt->execute()) {
                $resultado = $stmt->get_result();
                $categorias = $resultado->fetch_all(MYSQLI_ASSOC);
                return $categorias;
            } else {
                throw new Exception("Error en la ejecución de la consulta: " . $stmt->error);
            }
        } catch (Exception $ex) {
            throw new Exception("Error al obtener categorías: " . $ex->getMessage());
        }
    }

    public function obtenerProductosPorCategoria($idCategoria = '')
    {
        try {
            if (!empty($idCategoria)) {
                $query = "SELECT ID_PRODUCTO, N_PRODUCTO, PRECIO 
                          FROM producto 
                          WHERE ID_CATEGORIA = ?";
                $stmt = $this->conexion->prepare($query);
                $stmt->bind_param("i", $idCategoria);
            } else {
                throw new Exception("El ID de categoría no puede estar vacío");
            }

            if ($stmt->execute()) {
                $resultado = $stmt->get_result();
                $productos = $resultado->fetch_all(MYSQLI_ASSOC);
                return $productos;
            } else {
                throw new Exception("Error en la ejecución de la consulta: " . $stmt->error);
            }
        } catch (Exception $ex) {
            throw new Exception("Error al obtener productos por categoría: " . $ex->getMessage());
        }
    }
}
?>
