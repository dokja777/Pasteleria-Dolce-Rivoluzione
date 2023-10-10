<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agregar Productos</title>
    <link rel="stylesheet" href="StyleLista.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
                                   <!-- el diseño esta hecho con boostrap  --> 
                                 <!-- el styleLista.css es solo para el banner --> 
                                   
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

 <!-- Formulario de agregar Productos -->
     <br>
    <div class="container" >
        <h1 class="text-center"style=" background-color:black;color:white; font-family:var;">Agregar productos</h1>
    <form style="font-family:var;" action="CRUD/insertar.PHP" method="POST" enctype="multipart/form-data" >
 
      <!-- llamamos al administrador de  la base de datos  con php -->
      <!-- esta dentro del formulario  -->
        <label for=""  style="margin-left:1em;font-style:italic;font-size:20px;letter-spacing:2px;"  >Administrador :</label>
    <select class="form-select mb-3 " style="background-color:#EAE6CA;border-color:black;"   name="Administrador">
        <option     selected disabled>-- Selecciona tu nombre si vas a agregar --</option>
       
        <?php
         include ("config/conexion.php");
         $sql = $conexion-> query("SELECT*fROM ADMIN");
         while($resultado=$sql->fetch_assoc()){
            echo "<option value='".$resultado['ID_ADMIN']."'>".$resultado['NOMBRE']."</option> ";
         }
        
        ?>
        <!-- Llamaos a la categoria de la base de datos con php   -->
        <!-- esta dentro del formulario  -->
    </select>  
    <label for="" style="margin-left:1em;font-style:italic;font-size:20px; " >Categoria :</label>
    <select class="form-select mb-3 "  style="background-color:#EAE6CA;border-color:black;"   name="CategoriaP">
        <option selected disabled>-- Selecciona la categoria del producto --</option>

        <?php
         include ("config/conexion.php");
         $sql = $conexion-> query("SELECT*fROM categoria_producto");
         while($resultado=$sql->fetch_assoc()){
            echo "<option value='".$resultado['ID_CATEGORIA']."'>".$resultado['N_CATEGORIA']."</option> ";
         }
        
        ?>
        <!-- aqui se muestra los espacios para ingresar el nombre , precio , etc  -->
        <!-- es el formulario de registro  -->
    </select>   

        <div class="mb-3"  >
            <label class="form-label"  style="margin-left:1em;font-style:italic;font-size:20px;"  >Nombre Producto : </label>
            <input type="text" class="form-control" style="background-color:#EAE6CA;border-color:black;"   name="nombreP" >
            
        </div>   
        <div class="mb-3">
            <label class="form-label" style="margin-left:1em;font-style:italic;font-size:20px;"  >Descripcion : </label>
            <input type="text" class="form-control"  style="background-color:#EAE6CA;border-color:black;"  name="descripcionP">
            
        </div>
        <div class="mb-3">
            <label class="form-label" style="margin-left:1em;font-style:italic;font-size:20px;"  >Precio : </label>
            <input type="text" class="form-control" style="background-color:#EAE6CA;border-color:black;"   name="precioP">
            
        </div>
        <div class="mb-3">
            <label class="form-label" style="margin-left:1em;font-style:italic;font-size:20px;" >Stock : </label>
            <input type="text" class="form-control"  style="background-color:#EAE6CA;border-color:black;"  name="stockP" >
            
        </div> 
        <div class="mb-3">
            <label class="form-label"style="margin-left:1em;font-style:italic;font-size:20px;">Medida del pastel : </label>
            <input type="text" class="form-control" name="medidaP"  style="background-color:#EAE6CA;border-color:black;"   placeholder="E.j 12 cm de diametro">
            
        </div> 
        <!-- en este apartado se agrega la imagen de los productos   -->
        <div class="mb-3">
            <label for="imagen" class="form-label" style="margin-left:1em;font-style:italic;font-size:20px;"> Imagen del producto :</label>
            <input type="file" name="imagenP" id="imagen"  style="background-color:#EAE6CA;border-color:black;"  class="form-control">
        </div>  
        
        <!-- este boton agregar sirve apra agregar  a la base de datos   -->
        <!-- este boton volver te redirecciona a la lista de productos , por ello dice
         listaproductos.php  -->
        <div class="text-center" style="margin-bottom:1em;">
        <button type="submit" class="btn btn-danger"    >Agregar</button>
        <a href="listaproductos.php" class="btn btn-dark">Volver</a>
        </div>   
        
    </form>
    </div>
     <!-- esto son script de boostrap  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>