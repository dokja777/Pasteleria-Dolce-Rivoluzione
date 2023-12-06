<?php

class CatalogoProductos
{
  private $conexion;

  public function __construct($conexion)
  {
    $this->conexion = $conexion;
  }

  public function obtenerProductos($busqueda = '')
  {
    try {
      if (!empty($busqueda)) {
        $query = "SELECT ID_PRODUCTO,ID_CATEGORIA,N_PRODUCTO	,PRECIO	,STOCK	,MEDIDA	,DESCRIPCION	 FROM producto WHERE N_PRODUCTO LIKE CONCAT('%', ?, '%')";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("s", $busqueda);
      } else {
        $query = "SELECT * FROM producto";
        $stmt = $this->conexion->prepare($query);
      }

      if ($stmt->execute()) {
        $resultado = $stmt->get_result();
        $productos = $resultado->fetch_all(MYSQLI_ASSOC);
        // No cierres la declaración aquí, ya que get_result ya lo hace
        return $productos;
      } else {
        throw new Exception("Error en la ejecución de la consulta: " . $stmt->error);
      }
    } catch (Exception $ex) {
      // Puedes manejar la excepción según tus necesidades
      throw new Exception("Error al obtener productos: " . $ex->getMessage());
    }
  }
}


?>