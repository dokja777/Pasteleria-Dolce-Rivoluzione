<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   // Verificar si se han proporcionado los datos necesarios
   if (isset($_POST['id']) && isset($_POST['cantidad'])) {
      $idProducto = $_POST['id'];
      $nuevaCantidad = $_POST['cantidad'];

      // Obtener el carrito de la sesión
      $carritoEmpleado = isset($_SESSION['carritoEmpleado']) ? $_SESSION['carritoEmpleado'] : array();

      // Actualizar la cantidad del producto en el carrito
      foreach ($carritoEmpleado as &$producto) {
         if ($producto['Id'] == $idProducto) {
            $producto['cantidad'] = $nuevaCantidad;
            break; // Romper el bucle una vez que se actualiza la cantidad
         }
      }

      // Calcular el nuevo total después de actualizar el carrito
      $sumaTotal = 0;
      foreach ($carritoEmpleado as $producto) {
         $sumaTotal += $producto['Precio'] * $producto['cantidad'];
      }

      // Actualizar el carrito en la sesión
      $_SESSION['carritoEmpleado'] = $carritoEmpleado;
      echo $sumaTotal;
   } else {
      // Responder con un mensaje de error si no se proporcionan los datos necesarios
      echo 'Error: Datos incompletos.';
   }
} else {
   // Responder con un mensaje de error si la solicitud no es de tipo POST
   echo 'Error: Método no permitido.';
}
?>