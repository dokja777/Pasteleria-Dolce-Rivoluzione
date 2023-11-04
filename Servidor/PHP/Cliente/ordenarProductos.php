<?php

if (isset($_GET['ordenar'])) {
  $orden = $_GET['ordenar'];
  if ($orden === 'mayor_precio') {
    // Ordenar los productos de mayor a menor precio
    usort($productos, function ($a, $b) {
      return $b['PRECIO'] - $a['PRECIO'];
    });
  } elseif ($orden === 'menor_precio') {
    // Ordenar los productos de menor a mayor precio
    usort($productos, function ($a, $b) {
      return $a['PRECIO'] - $b['PRECIO'];

    });
  }
}
?>