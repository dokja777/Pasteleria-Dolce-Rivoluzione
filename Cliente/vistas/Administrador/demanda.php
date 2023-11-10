<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../Cliente/css/filtroProductoAdmin.css">
    <link rel="stylesheet" href="../../../Cliente/css/demanda.css">

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

        <input type="submit" value="Generar Gráfico">
    </form>


    <!-- Obtén los datos de los productos más vendidos (nombre y cantidad) y guárdalos en un array $productosMasVendidos -->

    <?php if (!empty($productosMasVendidos)) : ?>
<table>
    <caption>Productos más vendidos</caption>
    <thead>
        <tr>
            <th>Nombre del Producto</th>
            <th>Cantidad Vendida</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($productosMasVendidos as $producto) : ?>
            <tr>
                <td><?php echo $producto['N_PRODUCTO']; ?></td>
                <td><?php echo $producto['CANTIDAD']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php else : ?>
<?php endif; ?>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
