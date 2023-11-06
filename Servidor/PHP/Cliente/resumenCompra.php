<?php
    if(isset($_SESSION['carrito'])){
        $arregloCarrito = $_SESSION['carrito'];
        $totalCompra = 0; 
                      
        foreach($arregloCarrito as $producto){
            echo '<div class="producto">';
            echo '<p>Nombre: ' . $producto['Nombre'] . '</p>';
            echo '<p>Precio: S/ ' . $producto['Precio'] . '</p>';
            echo '<p>Cantidad: ' . $producto['Cantidad'] . '</p>';
                           
            $subtotal = $producto['Precio'] * $producto['Cantidad']; // Calcula el subtotal
            echo '<p>Subtotal: S/ ' . $subtotal . '</p>';
                            
            $totalCompra += $subtotal; // Agrega el subtotal al total 
            echo '</div>';
            echo '<hr>';
        }
                        
        // Total de la compra 
        echo '<p>Total de la compra: S/ ' . $totalCompra . '</p>';
    }
?>

