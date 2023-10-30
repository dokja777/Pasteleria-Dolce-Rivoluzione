<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../Cliente/css/StyleLista.css">

</head>
<title>Lista de Empleados  </title>
</head>

<body  style="background-color:#EAE6CA;">

  <!-- Configuración del navbar user y lista -->
   <!-- Configuración del navbar user y lista -->
   <nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color:#f9cb9c;">
  <div class="container-fluid">
  <img src="img/logo.png" alt="" style="width:5em ;margin-botton:1em;">
    <a class="navbar-brand" href="indexAdministrador.php"  style="font-family:var;color:#783f04;margin-left:1em;font-weight:600;font-size:22px;">Pastelería Dolce Rivoluzione</a>
    
    <div class="collapse navbar-collapse" id="bar" >
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="btn btn-outline-light" href="indexAdministrador.php"  aria-current="page"  style="color:#783f04;margin-left:3em;font-weight:600;">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-outline-light" href="pedidos.php" style="margin-left:2em;color:#783f04;font-weight:600;">Pedidos</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-outline-light" href="listaproductos.php"  style="color:#783f04;margin-left:2em;font-weight:600;" >Productos </a>
        </li>
        <li class="nav-item">
          <a class="btn btn-outline-light" href="listarAdministrador.php" style="color:#783f04;margin-left:2em;font-weight:600;" >Usuarios</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-outline-light" href="listarEmpleados.php" style="color:#783f04;margin-left:2em;font-weight:600;" >Empleados</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-outline-light" href="demanda.php" style="color:#783f04;margin-left:2em;font-weight:600;">Demanda</a>
        </li>
        <li class="nav-item">
          <a  class="btn btn-outline-light"  href="ingreso.php" style="color:#783f04;margin-left:2em;font-weight:600;">Ingresos</a>
        </li>
      </ul>
     
    </div>
  </div>
</nav>
   
  <style>
    #bar a{
        border-style:none;
        background-color:;
        border-radius:10px;
    }
  </style>


  <!-- Tabla de  lista de  producto  titulo -->
  <br>
  <div class="container">
    <h1 class="text-center" style=" background-color:black;color:white; height: 80px; font-family:var;"> Lista de
      Empleados</h1>
  </div>

  <!-- Tabla de lista de administradores  -->

  <div class="container">
    <table class="table  table-striped" style="background-color:#f9cb9c; font-family:var;">
      <thead>
        <tr>
          <th scope="col">ID DEL EMPLEADO</th>
          <th scope="col">USUARIO</th>
          <th scope="col">NOMBRE</th>
          <th scope="col">CONTRASEÑA</th>
          <th scope="col">ACCIONES</th>
        </tr>
      </thead>
      <tbody>


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
        <a href='editarEmpleado.php?ID_ADMIN=$idEmpleado' class=\"btn btn-warning\">Editar</a>
        <br>
        <br>
        <a href='eliminarEmpleado.php?ID_ADMIN=$idEmpleado'class=\"btn btn-danger\">Eliminar</a>
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
      </tbody>
    </table>
    <div class="container">
      <a href="../../../Cliente/vistas/Administrador/agregarEmpleado.php" class="btn btn-success">Agregar Empleado</a>
    </div>

  </div>

  <style>
    .container {
      font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }
  </style>

  

  <!-- Incluir Bootstrap JS y jQuery (opcional) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>