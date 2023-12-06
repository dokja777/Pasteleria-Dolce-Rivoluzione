<?php

class InicioSesionCliente {
  private $conexion;

  public function __construct($conexion) {
    $this->conexion = $conexion;
  }

  public function obtenerDatosLogin($busqueda = '') {
    try {
      if (!empty($busqueda)) {
        $query = "SELECT ID_CLIENTE, NOMBRE, CORREO FROM cliente WHERE CORREO LIKE CONCAT('%', ?, '%')";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("s", $busqueda);
      } else {
        $query = "SELECT * FROM cliente";
        $stmt = $this->conexion->prepare($query);
      }

      if ($stmt->execute()) {
        $resultado = $stmt->get_result();
        $login = $resultado->fetch_all(MYSQLI_ASSOC);
        // No cierres la declaración aquí, ya que get_result ya lo hace
        return $login;
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