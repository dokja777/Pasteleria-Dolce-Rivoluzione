<!-- Esto hace que la session se siga manteniendo abierta -->
<?php
include('../Empleado/SessionAbierta.php');
?>
<!-- ----------------------------------------------------------- -->


<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tabla de pedidos </title>
    <link rel="stylesheet" href="../css/styleAdmin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
 </head>


  <body>
    <!-------- incluir el  navbar ----->
  <?php include '../headerEmpleado.php';?>
  <section class="home-section">
    <div class="home-content">
      <i class='fa-solid fa-bars'></i>
      <span class="text">Inicio</span>
    </div>
    


        <div class="contenidoTabla"  >
        <table class="table table-hover">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Cliente</th>
            <th scope="col">Empleado</th>
            <th scope="col">Fecha</th>
            <th scope="col">Monto final</th>
            <th scope="col">Metodo de pago</th>
            <th scope="col">Estado</th>
            <th scope="col">Acciones</th>
            </tr>
        </thead>

        <tbody>
        <?php
          require('../Config/conexion.php');

          // Consulta preparada
          $query = "SELECT pedido.ID_PEDIDO, cliente.NOMBRE, empleado.ID_EMPLEADO, pedido.FECHA, pedido.MONTO_FINAL, pedido.METODO_PAGO, pedido.ESTADO FROM pedido INNER JOIN cliente ON pedido.ID_CLIENTE = cliente.ID_CLIENTE INNER JOIN empleado ON pedido.ID_EMPLEADO = empleado.ID_EMPLEADO";

          if ($stmt = $conexion->prepare($query)) {
            // Ejecutar la consulta
            $stmt->execute();

            // Vincular resultados a variables
            $stmt->bind_result($idpedido, $idcliente, $idempleado, $fecha, $montofinal, $metodopago, $estado);

            while ($stmt->fetch()) {
              echo "<tr>";
              echo "<th scope='row'>$idpedido</th>";
              echo "<td>$idcliente</td>";
              echo "<td>$idempleado</td>";
              echo "<td>$fecha</td>";
              echo "<td>$montofinal</td>";
              echo "<td>$metodopago</td>";
              echo "<td>$estado</td>";
              echo "<td></td>";

              echo "</tr>";
            }

            // Cerrar la sentencia preparada
            $stmt->close();
          } else {
            echo "Error en la consulta preparada";
          }

          $conexion->close();
          ?>
          
           
        </tbody>
        
        </table>

        </div>
        </section>

   <script src="../js/inicioAdministrador.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>