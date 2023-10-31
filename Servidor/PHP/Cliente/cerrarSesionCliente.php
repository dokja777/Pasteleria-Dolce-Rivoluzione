<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  session_destroy();
  header("Location: ../../../Cliente/vistas/Cliente/inicioSesion.php");
} else {
  // No se confirmó el cierre de sesión, puedes redirigir al usuario nuevamente a la página anterior o realizar alguna otra acción.
  header("Location: pagina_anterior.php");
}
?>