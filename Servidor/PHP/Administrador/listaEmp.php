<?php
    //  conexion para mostrar los empleados
    include('../../../Servidor/conexion.php');

    $sql = $conexion->query("SELECT ID_EMPLEADO, USUARIO_EMPLEADO, N_EMPLEADO, CONTRASEÑA_EMPLEADO FROM empleado;");

    if ($sql) {
        while ($resultado = $sql->fetch_assoc()) {

        $idEmpleado = $resultado['ID_EMPLEADO'];
        $usuarioEmpleado = $resultado['USUARIO_EMPLEADO'];
        $nombreEmpleado = $resultado['N_EMPLEADO'];
        $contraseñaEmpleado = $resultado['CONTRASEÑA_EMPLEADO'];

        // Imprime las filas de la tabla con las columnas específicas
        echo "<tr>";
        echo "<th scope='row'>$idEmpleado</th>";
        echo "<td>$usuarioEmpleado</td>";
        echo "<td>$nombreEmpleado</td>";
        echo "<td>$contraseñaEmpleado</td>";
        echo "<th>
        <a href='../../../Cliente/vistas/Administrador/editarEmp.php?ID_EMPLEADO=$idEmpleado' class=\"btn btn-warning\">Editar</a>
        <br>
        <br>
        <a href='../../../Servidor/PHP/Administrador/eliminarEmpleado.php?ID_EMPLEADO=$idEmpleado' class=\"btn btn-danger eliminar_empleado\" > Eliminar </a>


      </th>";
            echo "</tr>";
          }
    } else {
        // Maneja el error si la consulta no se ejecuta correctamente
        echo "Error en la consulta: " . $conexion->error;
    }

    // Cierra la conexión a la base de datos cuando hayas terminado
    $conexion->close();
?>