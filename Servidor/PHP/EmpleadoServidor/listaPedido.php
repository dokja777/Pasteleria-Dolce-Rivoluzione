<?php
        require('../../../Config/conexion.php');

        $porPagina = 5;

        // Página actual (por defecto, es la página 1)
        $pagina = isset($_GET['page']) ? $_GET['page'] : 1;

        // Calcular el desplazamiento (offset) en la consulta
        $offset = ($pagina -1) * $porPagina;

        // Consulta SQL modificada con LIMIT y OFFSET
        $query = "SELECT pedido.ID_PEDIDO, cliente.NOMBRE, empleado.N_EMPLEADO, pedido.FECHA, pedido.MONTO_FINAL, pedido.METODO_PAGO, pedido.ESTADO 
          FROM pedido 
          INNER JOIN cliente ON pedido.ID_CLIENTE = cliente.ID_CLIENTE 
          INNER JOIN empleado ON pedido.ID_EMPLEADO = empleado.ID_EMPLEADO
          LIMIT $porPagina OFFSET $offset";
      

        // Calcular el número total de páginas
        
        $queryTotal = "SELECT COUNT(*) AS total FROM pedido";  //=22
        $totalResult = $conexion->query($queryTotal);   //=22
        $total = $totalResult->fetch_assoc()['total'];   // recoge todos los datos
        $totalPaginas = ceil($total / $porPagina); // dividir y el ceil es para redonder = numero entero 

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
            echo "<td>S/ $montofinal</td>";
            echo "<td>$metodopago</td>";
            echo "<td>$estado</td>";
            echo "<td>
              <a href='../Empleado/editarPedidoEm.php?id=$idpedido' class=\"btn btn-warning\"><i class='fas fa-pencil-alt'></i></a>
              <br>
              <br>
              <a href='../../../Servidor/PHP/EmpleadoServidor/eliminarPedido.php?ID_PEDIDO=$idpedido'class=\"btn btn-danger\"><i class='fas fa-trash-alt'></i>
              </a>
              </td>";
            echo "<td>
              <a href='../Empleado/detallePedidoEm.php?id=$idpedido' class=\"btn btn-success\">Ver detalle de pedido</a>
                </td>";

            echo "</tr>";
          }


          echo '<div class="w3-bar">';
          for ($i = 1; $i <= $totalPaginas; $i++) {
            $activeClass = ($i == $pagina) ? 'active' : '';
            echo '<a href="?page=' . $i . '" class="w3-button ' . $activeClass . '">' . $i . '</a>';
          }
          echo '</div>';

          // Cerrar la sentencia preparada
          $stmt->close();
        } else {
          echo "Error en la consulta preparada";
        }



        $conexion->close();
        ?>