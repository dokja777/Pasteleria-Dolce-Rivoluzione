<?php
session_start();

if (isset($_GET['id'])) {
    $id_producto = $_GET['id'];
    
    if (isset($_SESSION['carrito'])) {
        $carrito = $_SESSION['carrito'];
        foreach ($carrito as $key => $producto) {
            if ($producto['Id'] == $id_producto) {
                
                $carrito[$key]['Cantidad'] = max(0, $carrito[$key]['Cantidad'] - 1);

                
                if ($carrito[$key]['Cantidad'] === 0) {
                    unset($carrito[$key]);
                }

                
                $_SESSION['carrito'] = array_values($carrito);
                break;
            }
        }
    }
}

header("Location: agregar_al_carrito.php"); 
?>
