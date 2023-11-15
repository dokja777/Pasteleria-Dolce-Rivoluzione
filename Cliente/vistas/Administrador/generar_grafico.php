<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../Cliente/css/filtroProductoAdmin.css">
    <link rel="stylesheet" href="../../../Cliente/css/graficoDemanda.css">

    <script defer src="../../../Cliente/js/buscar_productoAdmin.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
</head>
<body style="background-color:#EAE6CA; padding-bottom: 50px">

    <nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color:#f9cb9c;">
        <div class="container-fluid">
            <img src="img/logo.png" alt="" style="width:5em; margin-botton:1em;">
            <a class="navbar-brand" href="../../../Cliente/vistas/Administrador/indexAdministrador.php" style="font-family:var; color:#783f04; margin-left:1em; font-weight:600; font-size:22px;">Pastelería Dolce Rivoluzione</a>

            <div class="collapse navbar-collapse" id="bar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="../../../Cliente/vistas/Administrador/indexAdministrador.php" aria-current="page" style="color:#783f04; margin-left:3em; font-weight:600;">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="pedidos.php" style="margin-left:2em; color:#783f04; font-weight:600;">Pedidos</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="../../../Cliente/vistas/Administrador/listaproductos.php" style="color:#783f04; margin-left:2em; font-weight:600;">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="../../../Cliente/vistas/Administrador/listarAdministrador.php" style="color:#783f04; margin-left:2em; font-weight:600;">Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="../../../Cliente/vistas/Administrador/listarEmpleados.php" style="color:#783f04; margin-left:2em; font-weight:600;">Empleados</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="demanda.php" style="color:#783f04; margin-left:2em; font-weight:600;">Demandas</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="ingreso.php" style="color:#783f04; margin-left:2em; font-weight:600;">Ingresos</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <br>
    
    <form method="post" action="generar_grafico.php">
        <p>Ingrese el rango de las fechas</p>

        <br>
        <label for="fecha_inicio">Fecha de inicio:</label>
        <input type="date" name="fecha_inicio" id="fecha_inicio" required>

        <label for="fecha_fin">Fecha de fin:</label>
        <input type="date" name="fecha_fin" id="fecha_fin" required>
        <br>
        <br>

        <label for="cantidad_productos">Cantidad de productos a mostrar:</label>
        <input type="number" name="cantidad_productos" id="cantidad_productos" required min="1">
        <br>
        <br>

        <input type="submit" value="Generar Gráfico">
    </form>
   
    <?php
    include('../../../Config/conexion.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_fin = $_POST['fecha_fin'];
        $cantidad_productos = $_POST['cantidad_productos']; // Obtener la cantidad de productos desde el formulario

        $query = "SELECT p.N_PRODUCTO, SUM(dp.CANTIDAD) AS VENTAS
                  FROM detalle_pedido dp
                  JOIN pedido pe ON dp.ID_PEDIDO = pe.ID_PEDIDO
                  JOIN producto p ON dp.ID_PRODUCTO = p.ID_PRODUCTO
                  WHERE ESTADO IN ('Entregado', 'Pendiente')
                  AND pe.FECHA BETWEEN '$fecha_inicio' AND '$fecha_fin'
                  GROUP BY p.N_PRODUCTO
                  ORDER BY VENTAS DESC
                  LIMIT $cantidad_productos"; // Usar la cantidad de productos en la consulta

        $resultado = $conexion->query($query);
        $data = array();

        while ($row = $resultado->fetch_assoc()) {
            $data[$row['N_PRODUCTO']] = $row['VENTAS'];
            
        }

    }

    ?>



    <section>
    <h2 style="margin-left: 40%;">Productos más vendidos</h2>
        <!-- referencia a la biblioteca Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <canvas id="grafico" ></canvas>

        <script>
            var data = <?php echo json_encode($data); ?>;
            var ctx = document.getElementById('grafico').getContext('2d');

            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: Object.keys(data),
                    datasets: [{
                        label: 'Cantidad de Ventas',
                        data: Object.values(data),
                        backgroundColor: 'rgba(120, 63, 4, 0.2)',
                        borderColor: 'rgba(120, 63, 4, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </section>

<!-- Obtener datos para la tabla -->
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $cantidad_productos = $_POST['cantidad_productos'];

    $query = "SELECT p.N_PRODUCTO, p.IMG, SUM(dp.CANTIDAD) AS VENTAS
              FROM detalle_pedido dp
              JOIN pedido pe ON dp.ID_PEDIDO = pe.ID_PEDIDO
              JOIN producto p ON dp.ID_PRODUCTO = p.ID_PRODUCTO
              WHERE ESTADO IN ('Entregado', 'Pendiente')
              AND pe.FECHA BETWEEN '$fecha_inicio' AND '$fecha_fin'
              GROUP BY p.N_PRODUCTO
              ORDER BY VENTAS DESC
              LIMIT $cantidad_productos";

    $resultado = $conexion->query($query);
    $productosMasVendidos = array();

    while ($row = $resultado->fetch_assoc()) {
        $productosMasVendidos[] = array(
            'N_PRODUCTO' => $row['N_PRODUCTO'],
            'IMG' => $row['IMG'],
            'VENTAS' => $row['VENTAS']
        );
    }
}
?>

<!-- código para mostrar la tabla -->
<section>
<br>
        <br>
    <!-- código para mostrar la tabla con estilos -->
    <table class="table table-bordered" style="width: 77%; margin: 0 auto; border: 2px solid black;">
        <thead class="thead-dark">
            <tr>
                <th scope="col" style="border: 2px solid black;">Imagen del Producto</th>
                <th scope="col" style="border: 2px solid black;">Nombre del Producto</th>
                <th scope="col" style="border: 2px solid black;">Cantidad de Ventas</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productosMasVendidos as $producto) { ?>
                <tr>
                <td style="border: 2px solid black; color: #783f04;"><img style='width: 120px; border-radius: 3px;' src='data:image/jpg;base64,<?php echo base64_encode($producto['IMG']); ?>'></td>
                    <td style="border: 2px solid black; color: #783f04;"><?php echo $producto['N_PRODUCTO']; ?></td>
                     <td style="border: 2px solid black; color: #783f04;"><?php echo $producto['VENTAS']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>





    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
