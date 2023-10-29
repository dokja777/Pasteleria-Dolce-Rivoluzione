<?php
session_start();
include('../../../Config/conexion.php');

// Inicializamos la variable $row como un arreglo vacío
$row = array();

if (isset($_GET['id'])) {
  $id_producto = $_GET['id'];
  $query = "SELECT N_PRODUCTO, PRECIO, IMG FROM producto WHERE ID_PRODUCTO = $id_producto";
  $result = $conexion->query($query);

  if ($result) {
    $row = $result->fetch_assoc();
  }
}

if (isset($_SESSION['carrito'])) {
  // Si existe, buscamos si el producto ya está agregado
  if (isset($_GET['id'])) {
    $arreglo = $_SESSION['carrito'];
    $encontro = false;
    $numero = 0;

    for ($i = 0; $i < count($arreglo); $i++) {
      if ($arreglo[$i]['Id'] == $_GET['id']) {
        $encontro = true;
        $numero = $i;
      }
    }

    if ($encontro == true) {
      $arreglo[$numero]['Cantidad'] = $arreglo[$numero]['Cantidad'] + 1;
      $_SESSION['carrito'] = $arreglo;
    } else {
      // No estaba el registro
      $nombre = $row['N_PRODUCTO'];
      $precio = $row['PRECIO'];
      $imagen = $row['IMG'];

      $arregloNuevo = array(
        'Id' => $_GET['id'],
        'Nombre' => $nombre,
        'Precio' => $precio,
        'Imagen' => $imagen,
        'Cantidad' => 1,
      );

      array_push($arreglo, $arregloNuevo);
      $_SESSION['carrito'] = $arreglo;
    }
  }
} else {
  // Creamos la variable de sesión si no existe
  if (isset($_GET['id'])) {
    $nombre = $row['N_PRODUCTO'];
    $precio = $row['PRECIO'];
    $imagen = $row['IMG'];

    $arreglo[] = array(
      'Id' => $_GET['id'],
      'Nombre' => $nombre,
      'Precio' => $precio,
      'Imagen' => $imagen,
      'Cantidad' => 1,
    );

    $_SESSION['carrito'] = $arreglo;
  }
}
?>