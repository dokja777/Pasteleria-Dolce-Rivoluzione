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
    
    <form method="post" action="reporteVentasIngresos.php">
        <p>Ingrese el rango de las fechas</p>

        <br>
        <label for="fecha_inicio">Fecha de inicio:</label>
        <input type="date" name="fecha_inicio" id="fecha_inicio" required>

        <label for="fecha_fin">Fecha de fin:</label>
        <input type="date" name="fecha_fin" id="fecha_fin" required>
        <br>
        <br>

        <label for="mostrar_todos">Mostrar todos los días:</label>
        <select name="mostrar_todos" id="mostrar_todos">
            <option value="si">Sí</option>
            <option value="no">No</option>
        </select>

        <!-- Agregamos un div que contiene el campo cantidad_dias, pero inicialmente lo ocultamos -->
        <div id="cantidad_dias_container" style="display: none;">
            <label for="cantidad_dias">Cantidad de días con más ingresos a mostrar (opcional):</label>
            <input type="number" name="cantidad_dias" id="cantidad_dias" min="1">
        </div>

        <br>
        <input type="submit" value="Generar Gráfico">
    </form>

    <script>
        // Agregamos un script para mostrar/ocultar el campo cantidad_dias según la opción seleccionada
        document.getElementById('mostrar_todos').addEventListener('change', function () {
            var cantidadDiasContainer = document.getElementById('cantidad_dias_container');
            if (this.value === 'si') {
                cantidadDiasContainer.style.display = 'none';
            } else {
                cantidadDiasContainer.style.display = 'block';
            }
        });
    </script>

   
<?php
include('../../../Config/conexion.php');

$mostrar_todos = '0'; // AsignAMOS UN VALOR INICIAL

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];

    // Verificamos si se ingreso la cantidad de días
    if (isset($_POST['cantidad_dias']) && $_POST['cantidad_dias'] != '') {
        $cantidad_dias = $_POST['cantidad_dias'];

        $query = "SELECT DATE(FECHA) AS DIA, SUM(MONTO_FINAL) AS INGRESOS_DIARIOS
                  FROM pedido
                  WHERE ESTADO IN ('Entregado', 'Pendiente')
                  AND FECHA BETWEEN '$fecha_inicio' AND '$fecha_fin'
                  GROUP BY DATE(FECHA)
                  ORDER BY INGRESOS_DIARIOS DESC
                  LIMIT $cantidad_dias";

        $result = $conexion->query($query);
        $data = [];

        while ($row = $result->fetch_assoc()) {
            $data[$row['DIA']] = $row['INGRESOS_DIARIOS'];
        }
    } else {
        
        $query = "SELECT fecha FROM pedido WHERE fecha BETWEEN '$fecha_inicio' AND '$fecha_fin'";
        $result = $conexion->query($query);
        $dias_disponibles = [];

        while ($row = $result->fetch_assoc()) {
            $dias_disponibles[] = $row['fecha'];
        }

        
        $data = [];
        $fecha_actual = $fecha_inicio;

        while ($fecha_actual <= $fecha_fin) {
            $dia_actual = date('Y-m-d', strtotime($fecha_actual));

            if ($mostrar_todos == 'no' && !in_array($dia_actual, $dias_disponibles)) {
                // se omite los dias qu eno tienen ingresos
                $fecha_actual = date('Y-m-d', strtotime($fecha_actual . ' + 1 day'));
                continue;
            }

            if (!in_array($dia_actual, $dias_disponibles)) {
                // mostrar en 0 los dias que no tienen ingresos
                $data[$dia_actual] = 0;
            } else {
                // obtener el monto por dia
                $query = "SELECT DATE(FECHA) AS DIA, SUM(MONTO_FINAL) AS INGRESOS_DIARIOS
                        FROM pedido
                        WHERE ESTADO IN ('Entregado', 'Pendiente')
                        AND FECHA = '$dia_actual'";
                $result = $conexion->query($query);
                $row = $result->fetch_assoc();
                $data[$dia_actual] = $row['INGRESOS_DIARIOS'];
            }

            $fecha_actual = date('Y-m-d', strtotime($fecha_actual . ' + 1 day'));
        }
    }
}
?>



    <section>
    <h2 style="margin-left: 44%;">Ingresos Diarios</h2>
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
                        label: 'Ingresos Diarios S/',
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




<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>





    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>






