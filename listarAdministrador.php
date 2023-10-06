<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="StyleLista.css">

</head>
<title>Lista de administradores</title>
</head>

<body>

  <!-- Configuración del navbar user y lista -->
  <div class="navbar">
    <div class="navbar-left">
      <div class="menu-icon" onclick="toggleMenu()">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
      </div>
    </div>
    <div class="navbar-right">
      <i class="fas fa-user"></i>
    </div>
  </div>


  <!-- tabla nomrbes -->
  <div class="menu" id="menu">
    <!-- Coloca aquí los elementos de menú -->
    <a href="#">Inicio</a>
    <a href="#">Acerca de</a>
    <a href="#">Servicios</a>
    <a href="#">Contacto</a>
  </div>

  <!-- Tabla de  lista de  producto  titulo -->
  <br>
  <div class="container">
    <h1 class="text-center" style=" background-color:black;color:white; height: 80px; font-family:var;"> Lista de
      productos</h1>
  </div>

  <!-- Tabla de lista de administradores  -->

  <div class="container">
    <table class="table  table-striped" style="background-color:#f9cb9c; font-family:var;">
      <thead>
        <tr>
          <th scope="col">ID DEL ADMINISTRADOR</th>
          <th scope="col">USUARIO</th>
          <th scope="col">NOMBRE</th>
          <th scope="col">CONTRASEÑA</th>
          <th scope="col">ACCIONES</th>
        </tr>
      </thead>
      <tbody>


        <?php
        //  conexion para mostrar los productos
        require("config/conexion.php");

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
      </tbody>
    </table>
    <div class="container">
      <a href="agregarAdmin.php" class="btn btn-success">Agregar Administrador</a>
    </div>

  </div>

  <style>
    .container {
      font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }
  </style>

  <!-- Script de hambuerguesa -Lista -->
  <script>
    function toggleMenu() {
      var menu = document.getElementById('menu');
      menu.classList.toggle('active');
    }
  </script>

  <!-- Incluir Bootstrap JS y jQuery (opcional) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>