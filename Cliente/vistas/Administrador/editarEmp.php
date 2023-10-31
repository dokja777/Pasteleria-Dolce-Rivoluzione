<!Doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agregar Productos</title>
    <link rel="stylesheet" href="../../../Cliente/css/StyleLista.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
                                   
  <body style="background-color:#EAE6CA;">
    <!-- Configuración del navbar user y lista -->

  <nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color:#f9cb9c;" >
  <div class="container-fluid"   style="background-color:#f9cb9c;"  >
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
          <a class="btn btn-outline-light" href="../../../Cliente/vistas/Administrador/listarEmpleados.php" style="color:#783f04;margin-left:2em;font-weight:600;" >Empleados</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-outline-light" href="demanda.php" style="color:#783f04;margin-left:2em;font-weight:600;">Demandas</a>
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

  <?php
    $idE = $_GET['idE'];
    $usuarioE = $_GET['usuarioE'];
    $nombreE = $_GET['nombreE'];
    $contraseñaE = $_GET['contraseñaE'];
    
  ?>

 <!-- Formulario de agregar Productos -->
     <br>
    <div class="container" >
        <h1 class="text-center"style=" background-color:black;color:white; font-family:var;">Agregar Empleados</h1>
    <form style="font-family:var;" action="../../../Servidor/PHP/Administrador/editarEmpleado.php" method="POST" enctype="multipart/form-data" >   

        <div class="mb-3"  >
            <label class="form-label" style="font-style:italic;font-size:25px;">Ingresar Datos :</label>
            <input type="hidden" name="idE" value="<?=$idE?>">
        </div>  
        
        <!-- aqui se muestra los espacios para ingresar el usuario, nombre, contraseña del empleado  -->
        <!-- es el formulario de registro  --> 

        <div class="mb-3"  >
            <label class="form-label"  style="margin-left:1em;font-style:italic;font-size:20px;"  >Usuario : </label>
            <input type="text" class="form-control" style="background-color:#EAE6CA;border-color:black;"   name="usuarioE" value="<?=$usuarioE?>">
            
        </div>   
        <div class="mb-3">
            <label class="form-label" style="margin-left:1em;font-style:italic;font-size:20px;"  >Nombre : </label>
            <input type="text" class="form-control"  style="background-color:#EAE6CA;border-color:black;"  name="nombreE" value="<?=$nombreE?>">
            
        </div>
        <div class="mb-3">
            <label class="form-label" style="margin-left:1em;font-style:italic;font-size:20px;"  >Contraseña : </label>
            <input type="text" class="form-control" style="background-color:#EAE6CA;border-color:black;"   name="contraseñaE" value="<?=$contraseñaE?>">
            
        </div> 
        
        <!-- este boton agregar sirve apra agregar  a la base de datos   -->
        <!-- este boton volver te redirecciona a la lista de productos , por ello dice
         listarEmpleado.php  -->
        <div class="text-center" style="margin-bottom:1em;">
        <button type="submit" class="btn btn-danger"    >Actualizar</button>
        <a href="../../../Cliente/vistas/Administrador/listarEmpleados.php" class="btn btn-dark">Volver</a>
        </div>   
        
    </form>
    </div>
     <!-- esto son script de boostrap  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>