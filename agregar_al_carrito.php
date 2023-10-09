<?php

    session_start();
    include('config/conexion.php');
    if(isset($_SESSION['carrito'])){
        //si existe buscamos ya esta agregado
        if(isset($_GET['id'])){
            $arreglo = $_SESSION['carrito'];
            $encontro=false;
            $numero = 0;
            for($i=0;$i<count($arreglo);$i++){
                if($arreglo[$i]['id'] == $_GET['Id']){
                    $encontro=true;
                    $numero=$i;
                }
            }
            if($encontro == true){
                $arreglo[$numero]['Cantidad']=$arreglo[$numero]['Cantidad']+1;
                $_SESSION['carrito']=$arreglo;
            }else{
                //no estaba el registro
                $nombre = $row['N_PRODUCTO'];
                $precio = $row['PRECIO'];
                $imagen = $row['IMG'];
                $res = $conexion->query('select * from producto where ID_PRODUCTO='.$_GET['id']) or die("Error en la consulta: " .$conexion->error);
                $fila = mysqli_fetch_row($res);

                var_dump($fila); 

                $nombre=$fila[2];
                $precio = $fila[3];
                $imagen = $fila[5];
                $arregloNuevo= array(
                    'Id'=> $_GET['id'],
                    'Nombre'=> $nombre,
                    'Precio'=> $precio,
                    'Imagen'=> $imagen,
                    'Cantidad'=> 1,
                );
                array_push($arreglo,$arregloNuevo);
                $_SESSION['carrito']=$arreglo;
            }
        }
    }else{
        //creamos la variable de sesion
        if(isset($_GET['id'])){
            $nombre = $row['N_PRODUCTO'];
            $precio = $row['PRECIO'];
            $imagen = $row['IMG'];
            $res = $conexion->query('select * from producto where ID_PRODUCTO='.$_GET['id']) or die("Error en la consulta: " .$conexion->error);
            $fila = mysqli_fetch_row($res);

            var_dump($fila); 

            $nombre=$fila[2];
            $precio = $fila[3];
            $imagen = $fila[5];
            $arreglo[] = array(
                'Id'=> $_GET['id'],
                'Nombre'=> $nombre,
                'Precio'=> $precio,
                'Imagen'=> $imagen,
                'Cantidad'=> 1,
            );
            $_SESSION['carrito']=$arreglo;
        }
    
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
   
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Iconos en font awesome -->
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Carrito de Compra</title>
</head>
<body>

    <!-- Configuración del navbar -->
    <header>
        <div class="header-left">
            <div class="logo">
                <a href="indexCliente.php">
                    <img src="img/logo.png" alt="" />
                </a>
            </div>
            <nav>
                <ul>
                    <li>
                        <a href="indexCliente.php">Inicio</a>
                    </li>
                    <li>
                        <a href="productos.php">Productos</a>
                    </li>
                    <li>
                        <a href="nosotros.html">Nosotros</a>
                    </li>
                </ul>
                <div class="perfil-carrito">
                    <a href="perfil.html"><i class="fa-solid fa-user"></i></a>
                    <a href="agregar_al_carrito.php"><i class="fa-solid fa-cart-shopping"></i></a>
                </div>
            </nav>
        </div>
        <div class="header-right">
            <div class="perfil-carrito">
                <a href="perfil.html"><i class="fa-solid fa-user"></i></a>
                <a href="agregar_al_carrito.php"><i class="fa-solid fa-cart-shopping"></i></a>
            </div>
            <div class="hamburger">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </header>
    <script>
        hamburger = document.querySelector(".hamburger");
        nav = document.querySelector("nav");
        hamburger.onclick = function () {
            nav.classList.toggle("active");
        };
    </script>
    <div class="titulo-carrito" style="text-align:center; color:#783f04; padding-top:20px;">
        <h3>Carrito de compras:</h3>
    </div>

    <div class="section-carrito">
      <div class="container-carrito">
        <div class="row mb-5">
          <form class="col-md-12" method="post">
            <div class="site-blocks-table">
              <table class="table " style="border: 2px solid #783f04; width: 1000px; margin-left:50px; margin-top:50px;">
                <thead>
                  <tr>
                    <th class="product-imagen">Imagen</th>
                    <th class="product-nombre">Producto</th>
                    <th class="product-precio">Precio</th>
                    <th class="product-cantidad">Cantidad</th>
                    <th class="product-total">Total</th>
                    <th class="product-quitar">Quitar</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                    if(isset($_SESSION['carrito'])){
                        $arregloCarrito =$_SESSION['carrito'];
                        for($i=0;$i<count($arregloCarrito);$i++){

                    ?>
                  <tr>
                    <td class="product-img">
                      <img src="data:image/jpg;base64, <?php echo base64_encode($imagen);?>" alt="Image" class="img-fluid">
                    </td>
                    <td class="product-name">
                        <h2 class="h5 text-black"><?php echo $arregloCarrito[$i]['Nombre'];?></h2> 
                    </td>
                    <td>S/ <?php echo $arregloCarrito[$i]['Precio'];?></td>
                    <td>
                      <div class="input-group mb-3" style="max-width: 120px;">
                        <div class="input-group-prepend">
                          <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                        </div>
                        <input type="text" class="form-control text-center" value="<?php echo $arregloCarrito[$i]['Cantidad'];?>" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                        <div class="input-group-append">
                          <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                        </div>
                      </div>

                    </td>
                    <td>S/<?php echo $arregloCarrito[$i]['Precio'] * $arregloCarrito[$i]['Cantidad'];?></td>
                    <td><a href="#" class="btn btn-primary btn-sm btnEliminar" data-id="<?php echo $arregloCarrito[$i]['Id'];?>">X</a></td>
                  </tr>
                  <?php }  } ?>
                  
                </tbody>
                
               
              </table>
              <div class=" col-6 " style="margin-left: 800px; border: 2px ;">
                <a class="btn-compra" href="">Realizar Compra</a>
            </div>
            <!--<form action="" class="resumen">
            <h4>Resumen de compra: </h4>
          </form>-->
          </form>
          
        </div>

        <style>
   
.btn-compra {
    letter-spacing: 2px;
    font-family: monospace;
    display: inline-block;
    padding: 10px 20px;
    background-color: coral;
    color: #fff;
    text-decoration: none;
    border: none;
    border-radius: 5px;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s;
    position: relative;
    overflow: hidden; 
}

.btn-compra:hover {
    background-color: LightSalmon;
}


.btn-compra::before,
.btn-compra::after {
    content: "";
    position: absolute;
    width: 100%;
    height: 2px;
    background-color: coral;
    transition: transform 0.3s ease;
}


.btn-compra::before {
    top: 0;
    left: 0;
    transform: scaleX(0);
    transform-origin: left;
}


.btn-compra::after {
    bottom: 0;
    right: 0;
    transform: scaleX(0); 
    transform-origin: right;
}


.btn-compra:hover::before {
    transform: scaleX(1); 
}


.btn-compra:hover::after {
    transform: scaleX(1); 
}
        </style>
        




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- Footer -->
    <footer>
        <div class="container__footer">
            <div class="box__footer">
                <div class="logo">
                    <img src="img/logo.png" alt="" />
                </div>
            </div>
            <div class="box__footer">
                <h2>Nosotros</h2>
                <a href="nosotros.html">¿Quiénes somos?</a>
                <a href="#">Política de privacidad</a>
                <a href="#">Política de cookies</a>
                <a href="#">Libro de reclamaciones</a>
            </div>

            <div class="box__footer">
                <h2>Contáctanos</h2>
                <a href="#"><i class="fa-brands fa-whatsapp"></i> Whatsapp</a>
                <a href="#"><i class="fa-regular fa-envelope"></i> Correo</a>
                <a href="#"><i class="fa-solid fa-phone"></i> Teléfono</a>
                <a href="#"><i class="fa-solid fa-location-dot"></i> Av San Juan N° 1061, SJM 15801</a>
            </div>

            <div class="box__footer">
                <h2>Síguenos</h2>
                <a href="#"><i class="fab fa-facebook-square"></i> Facebook</a>
                <a href="#"><i class="fab fa-twitter-square"></i> Twitter</a>
                <a href="#"><i class="fab fa-instagram-square"></i> Instagram</a>
            </div>
        </div>

        <div class="box__copyright">
            <hr />
            <p>Todos los derechos reservados © 2023 <b>Pastelería Dolce Rivoluzione</b></p>
        </div>
    </footer>


</body>
</html>