<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../../../Cliente/js/jquery-3.7.1.min.js"></script>
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
                                    } else {
                                        // Obtiene el método de pago seleccionado
                                        var metodoPago = obtenerMetodoPagoSeleccionado();

                                        // Si no se seleccionó ningún método de pago, muestra un mensaje y evita el envío del formulario
                                        if (!metodoPago) {
                                            alert("Por favor, selecciona un método de pago.");
                                            return false;
                                        }

                                        // Si la confirmación es verdadera, realiza una petición AJAX para enviar la fecha de recojo y el método de pago
                                        var fechaRecojo = document.getElementById('fecha_recojo').value;

                                        var xhr = new XMLHttpRequest();
                                        xhr.open('POST', '../../../Servidor/PHP/Cliente/RegistrarPedido.php', true);
                                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                        xhr.onreadystatechange = function () {
                                            if (xhr.readyState === 4) {
                                                if (xhr.status === 200) {
                                                    // Maneja la respuesta del servidor
                                                    console.log(xhr.responseText);
                                                } else {
                                                    // Maneja errores de la solicitud AJAX
                                                    console.error('Error en la solicitud AJAX:', xhr.status, xhr.statusText);
                                                }
                                            }
                                        };

                                        // Construye los datos a enviar
                                        var datos = "fecha_recojo=" + encodeURIComponent(fechaRecojo) + "&metodo_pago=" + encodeURIComponent(metodoPago);

                                        // Envía la petición
                                        xhr.send(datos);

                                        // Evita el envío del formulario si estás manejando todo en el mismo bloque de código
                                        return true;
                                    }
                                }

                                function obtenerMetodoPagoSeleccionado() {
                                    var opcionesMetodoPago = document.getElementsByName('opciones');

                                    for (var i = 0; i < opcionesMetodoPago.length; i++) {
                                        if (opcionesMetodoPago[i].checked) {
                                            var valorSeleccionado = opcionesMetodoPago[i].value;

                                            // Identifica el método de pago según el valor seleccionado
                                            if (valorSeleccionado === 'tarjeta_debito') {
                                                return 'Débito';
                                            } else if (valorSeleccionado === 'yape') {
                                                return 'Yape';
                                            } 
                                        }
                                    }

                                    // Retorna null si no se seleccionó ningún método de pago
                                    return null;
                                }
                            
                            </script>
                        </div>
                    </div>
                    
                    <div id="pago2" class="pago">
                        <div class="yape-content">
                            <br>
                            <p style="font-size: 15px;">
                                Importante: Si elegiste la opción de pago con Yape, Plin o Transferencia una vez realizado tu pago toma un 
                                screenshot y envíanos tu comprobante de pago a nuestro correo, colocando en la parte de asunto tu número 
                                de pedido. Este mensaje tiene que ser enviado durante las primeras 4 horas siguientes a haber realizado tu pedido en la web.
                            </p> 
                            <strong>Caso contrario será anulado</strong>

                            
                            <br><br>
                            <img src="YapeImagen.jpeg" alt="Yape" style="width: 60%; margin-left: 20%;">

                            <p style="font-size: 12px;">
                                <input type="checkbox" id="aceptoTerminos" name="aceptoTerminos">
                                <label for="aceptoTerminos">Acepto los términos y condiciones</label>
                            </p>
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
                                    } else {
                                        // Obtiene el método de pago seleccionado
                                        var metodoPago = obtenerMetodoPagoSeleccionado();

                                        // Si no se seleccionó ningún método de pago, muestra un mensaje y evita el envío del formulario
                                        if (!metodoPago) {
                                            alert("Por favor, selecciona un método de pago.");
                                            return false;
                                        }

                                        // Si la confirmación es verdadera, realiza una petición AJAX para enviar la fecha de recojo y el método de pago
                                        var fechaRecojo = document.getElementById('fecha_recojo').value;

                                        var xhr = new XMLHttpRequest();
                                        xhr.open('POST', '../../../Servidor/PHP/Cliente/RegistrarPedido.php', true);
                                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                        xhr.onreadystatechange = function () {
                                            if (xhr.readyState === 4) {
                                                if (xhr.status === 200) {
                                                    // Maneja la respuesta del servidor
                                                    console.log(xhr.responseText);
                                                } else {
                                                    // Maneja errores de la solicitud AJAX
                                                    console.error('Error en la solicitud AJAX:', xhr.status, xhr.statusText);
                                                }
                                            }
                                        };

                                        // Construye los datos a enviar
                                        var datos = "fecha_recojo=" + encodeURIComponent(fechaRecojo) + "&metodo_pago=" + encodeURIComponent(metodoPago);

                                        // Envía la petición
                                        xhr.send(datos);

                                        // Evita el envío del formulario si estás manejando todo en el mismo bloque de código
                                        return true;
                                    }
                                }

                                function obtenerMetodoPagoSeleccionado() {
                                    var opcionesMetodoPago = document.getElementsByName('opciones');

                                    for (var i = 0; i < opcionesMetodoPago.length; i++) {
                                        if (opcionesMetodoPago[i].checked) {
                                            var valorSeleccionado = opcionesMetodoPago[i].value;

                                            // Identifica el método de pago según el valor seleccionado
                                            if (valorSeleccionado === 'tarjeta_debito') {
                                                return 'Débito';
                                            } else if (valorSeleccionado === 'yape') {
                                                return 'Yape';
                                            } 
                                        }
                                    }

                                    // Retorna null si no se seleccionó ningún método de pago
                                    return null;
                                }
                            
                            </script>
                        </div>
                    </div>

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

    <iframe src="../../../Cliente/vistas/Cliente/footer.php" frameborder="0" scrolling="no" width="100%" height="320px"></iframe>

   <script src="../../../Cliente/js/resumenCompra.js"></script>
    <style>
        .pago {
            display: none;
        }
    </style>
</body>
</html>
