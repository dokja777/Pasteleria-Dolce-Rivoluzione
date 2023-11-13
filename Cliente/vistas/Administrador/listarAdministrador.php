<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


</head>
<title>Lista de administradores </title>
</head>

<body >

  <!-- Configuración del navbar user y lista -->
  <!-- Configuración del navbar user y lista -->
  <nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color:#f9cb9c;">
    <div class="container-fluid">
      <img src="img/logo.png" alt="" style="width:5em ;margin-botton:1em;">
      <a class="navbar-brand" href="../../../Cliente/vistas/Administrador/indexAdministrador.php" style="font-family:var;color:#783f04;margin-left:1em;font-weight:600;font-size:22px;">Pastelería Dolce Rivoluzione</a>

      <div class="collapse navbar-collapse" id="bar">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="btn btn-outline-light" href="../../../Cliente/vistas/Administrador/indexAdministrador.php" aria-current="page" style="color:#783f04;margin-left:3em;font-weight:600;">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-outline-light" href="listaproductos.php" style="color:#783f04;margin-left:2em;font-weight:600;">Productos </a>
          </li>
          <li class="nav-item">
            <a class="btn btn-outline-light" href="../../../Cliente/vistas/Administrador/listarAdministrador.php" style="color:#783f04;margin-left:2em;font-weight:600;">Usuarios</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-outline-light" href="../../../Cliente/vistas/Administrador/listarEmpleados.php" style="color:#783f04;margin-left:2em;font-weight:600;">Empleados</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-outline-light" href="demanda.php" style="color:#783f04;margin-left:2em;font-weight:600;">Demanda</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-outline-light" href="ingreso.php" style="color:#783f04;margin-left:2em;font-weight:600;">Ingresos</a>
          </li>
        </ul>

      </div>
    </div>
  </nav>




  <!-- Tabla de  lista de  producto  titulo -->
  <br>
  <div class="container">
    <h1 class="text-center" > Lista de
      Administradores</h1>
  </div>
  <div class="containerboton">
      <a href="../../../Cliente/vistas/Administrador/agregarAdmin.php" class="boton">Agregar Administrador</a>
    </div>
  <!-- Tabla de lista de administradores  -->

  <div class="container">
    <table class="table  table-striped" style="background-color:#f9cb9c;">
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
        //  conexion para mostrar los empleados
        include('../../../Servidor/conexion.php');

        include('../../../Servidor/PHP/Administrador/listaAdm.php');
        ?>

      </tbody>
    </table>
    
  </div>

  <style>
    body{
      font-family: 'Lato', sans-serif;
    background-color:#EAE6CA;
     }
    #bar a {
      border-style: none;
      border-radius: 10px;
    }
    .container h1{
      background-color:black;
      color:white; 
      height: 80px;
      padding-top: 9px;
      font-weight: bold;
      box-shadow: 1px 2px 10px black;
    }
    .containerboton{
      margin: 14px 120px;
      font-weight: 900;
    
    }
    .containerboton a{
      background-color:green ;
      color: whitesmoke;
      border-radius: 6px;
      box-shadow: 1px 2px 10px black;
      padding: 7px  13px ;
      text-decoration: none;
      font-weight: bold;
    }
    .containerboton :hover{
      background-color: #008f39;
      box-shadow: 1px 2px 10px white;
    }

   
  </style>

  <!-- script para confirmacion de eliminar un empleado -->
  <script src="../../../Cliente/js/confirma_elim_admin.js"> </script>

  <!-- Incluir Bootstrap JS y jQuery (opcional) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>