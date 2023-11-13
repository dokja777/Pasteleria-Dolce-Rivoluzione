<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../Cliente/css/style.css" />
    <link rel="stylesheet" href="../../../Cliente/css/resumencompra.css" />
    <!-- Iconos en font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Resumen de Compra</title>
</head>
<body>
    <!-- Configuración del navbar -->
    <?php include '../../../Cliente/vistas/Cliente/headerCliente.php';?>
    <!-- Resumen de compra -->
    <main class="cuerpo">
        <div class="header">
            <!-- ... Tu código para el header ... -->
        </div>

        <!-- Usamos CSS Grid para dividir la página en dos columnas -->
        <div class="grid-container">
            <!-- Columna 1: Sección de Identificación y Pago -->
            <div class="identificacion-pago">
                <section class="identificacion-section">
                    <h2>Identificación</h2>
                    <br>
                    <p>
                        <label for="email">Correo electrónico:</label>
                        <input type="email" id="email" value="<?php echo utf8_decode($row['Correo']); ?>">
                    </p>
                    <p>
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" value="<?php echo utf8_decode($row['NOMBRE']); ?>">
                    </p>
                    <p>
                        <label for="telefono">Teléfono:</label>
                        <input type="tel" id="telefono" value="<?php echo utf8_decode($row['Telefono']); ?>">
                    </p>
                    <p>
                        <label for="fecha_recojo">Fecha de recojo:</label>
                        <input type="date" id="fecha_recojo" name="fecha"  min="<?php echo date('Y-m-d', strtotime('+3 days')); ?>"/>
                    </p>
                </section>
                <br>
                <br>
               <div class="met_pagos-container">
                <section class="pago-section">
                    <h2>Pago</h2>
                    <br>

                    <form class="met_pagos">
                        <input type="radio" id="tarjeta_debito" name="opciones" value="tarjeta_debito">
                        <label for="tarjeta_debito">Tarjeta de Débito</label>
                        
                        <input type="radio" id="yape" name="opciones" value="yape">
                        <label for="yape">Yape</label>

                        <input type="radio" id="paypal" name="opciones" value="paypal">
                        <label for="paypal">Paypal</label>

                        <input type="radio" id="efectivo" name="opciones" value="efectivo">
                        <label for="efectivo">Efectivo</label>
                    </form>

                    <div id="pago1" class="pago">
                        <div class="tarjeta_debito">
                            <?php include ('../../../Cliente/vistas/Cliente/MetodosPago/tarjetacredito.php');?>
                            <a href="../../../Cliente/vistas/Cliente/GenerarBoleta.php" onclick="return confirmarCompra('boleta')">
                                <button type="submit">COMPRAR CON BOLETA</button>
                            </a>
                            <button type="submit" id="btnFactura" >COMPRAR CON FACTURA</button>

                            <style>
                                .modal {
                                    display: none;
                                    position: fixed;
                                    z-index: 1;
                                    left: 0;
                                    top: 0;
                                    width: 100%;
                                    height: 100%;
                                    overflow: auto;
                                    background-color: rgba(0, 0, 0, 0.4);
                                }

                                .modal-contenido {
                                    background-color: #fff;
                                    margin: 10% auto;
                                    padding: 20px;
                                    border: 1px solid #888;
                                    width: 40%;
                                    border-radius: 10px;
                                    
                                }

                                .cerrar {
                                    color: #888;
                                    float: right;
                                    font-size: 28px;
                                    font-weight: bold;
                                    cursor: pointer;
                                }
                            </style>




                            <!-- Modal de facturación -->
                            <div id="modalFactura" class="modal">
                                <div class="modal-contenido">
                                    <span class="cerrar" id="cerrarModalFactura">&times;</span>
                                    <h2>Ingrese los datos de facturación</h2>
                                    <form action="GenerarFactura.php" method="post" onsubmit="return confirmarCompra('factura')">
                                        <br>
                                       
                                        <label for="ruc">RUC (Empresa):</label>
                                        <input type="text" id="ruc" name="ruc" required>
                                        <br><br>

                                        <label for="nombre">Razon Social (Nombre):</label>
                                        <input type="text" id="nombre" name="nombre" required>
                                        <br><br>

                                        <label for="direccion">Dirección:</label>
                                        <input type="text" id="direccion" name="direccion" required>
                                        <br><br>

                                        <label for="departamento">Departamento:</label>
                                        <input type="text" id="departamento" name="departamento" required>
                                        <br><br>

                                        <label for="provincia">Provincia:</label>
                                        <input type="text" id="provincia" name="provincia" required>
                                        <br><br>

                                        <label for="distrito">Distrito:</label>
                                        <input type="text" id="distrito" name="distrito" required>
                                        <br><br>

                                        <label for="codigo_postal">Código Postal:</label>
                                        <input type="text" id="codigo_postal" name="codigo_postal">
                                        <br><br>

                                        <label for="telefono">Teléfono de contacto:</label>
                                        <input type="tel" id="telefono" name="telefono"  class="pago-section-input">
                                        <br><br>

                                        <label for="email">Correo Electrónico:</label>
                                        <input type="email" id="email" name="email" class="pago-section-input" required>
                                        <br><br>

                                        <br>
                                        
                                        <button id="btnFactura" class="btn-compra" >Generar Factura</button>

                                    </form>
                                </div>
                            </div>

                            <script>
                                
                                var btnFactura = document.getElementById('btnFactura');
                                var modalFactura = document.getElementById('modalFactura');
                                var cerrarModalFactura = document.getElementById('cerrarModalFactura');

                                // abrir el modal
                                function abrirModal() {
                                    modalFactura.style.display = 'block';
                                }

                                //  cerrar el modal
                                function cerrarModal() {
                                    modalFactura.style.display = 'none';
                                }

                                // abrir el modal al hacer clic en el botón
                                btnFactura.addEventListener('click', abrirModal);

                                //  cerrar el modal al hacer clic en la "X"
                                cerrarModalFactura.addEventListener('click', cerrarModal);
                            
                                function confirmarCompra(tipoCompra) {
                                    var mensaje = "¿Estás seguro de realizar la compra con " + tipoCompra + "?";
                                    var confirmacion = confirm(mensaje);

                                    if (!confirmacion) {
                                        // Si el usuario cancela la confirmación, evita que el formulario se envíe
                                        return false;
                                    }

                                    // Si la confirmación es verdadera, el formulario se enviará normalmente
                                    return true;
                                }
                            
                            </script>

                        </div>
                    </div>
                    <div id="pago2" class="pago">Contenido de la Opción 2</div>
                    
                </section>
                </div> 
            </div>

        
            <!-- Columna 2: Sección de Carrito -->
            <div class="section-carrito">
                <div class="titulo-carrito" style="text-align:center; color:#783f04; padding-top:20px;">
                    <h3>Resumens de compra:</h3>
                </div>
                <div class="container-carrito">
                    <?php
                    include ('../../../Servidor/PHP/Cliente/resumenCompra.php');
                    ?>
                </div>
                <br>
            </div>
        </div>
    </main>

    <!-- ... Tu código para el footer ... -->
    <iframe src="../../../Cliente/vistas/Cliente/footer.html" frameborder="0" scrolling="no" width="100%" height="320px"></iframe>

    <script src="../../../Cliente/js/resumenCompra.js"></script>
    <style>
        .pago {
            display: none;
        }
    </style>
</body>
</html>
