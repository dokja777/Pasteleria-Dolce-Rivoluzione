<?php
    //  conexion para mostrar los productos
    include('../../../Servidor/conexion.php');

    $sql = $conexion->query("SELECT ID_ADMIN, USUARIO, NOMBRE, CONTRASEÑA FROM admin;");

    if ($sql) {
        while ($resultado = $sql->fetch_assoc()) {

        $idAdmin = $resultado['ID_ADMIN'];
        $usuarioAdmin = $resultado['USUARIO'];
        $nombreAdmin = $resultado['NOMBRE'];
        $contraseñaAdmin = $resultado['CONTRASEÑA'];

        // Imprime las filas de la tabla con las columnas específicas
        echo "<tr>";
        echo "<th scope='row'>$idAdmin</th>";
        echo "<td>$usuarioAdmin</td>";
        echo "<td>$nombreAdmin</td>";
        echo "<td>$contraseñaAdmin</td>";
        echo "<th>
        <a href='editarAdmin.php?ID_ADMIN=$idAdmin' class=\"btn btn-warning\">Editar</a>
        <br>
        <br>
        <a href='eliminarAdmin.php?ID_ADMIN=$idAdmin'class=\"btn btn-danger\">Eliminar</a>
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