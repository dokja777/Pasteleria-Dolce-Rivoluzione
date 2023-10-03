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
 <!-- Configuración del navbar user y lista -->
    <div class="menu" id="menu">
        <!-- Coloca aquí los elementos de menú -->
        <a href="#">Inicio</a>
        <a href="#">Acerca de</a>
        <a href="#">Servicios</a>
        <a href="#">Contacto</a>
    </div>

 <!-- Formulario de agregar Productos -->
     <br>
    <div class="container" >
        <h1 class="text-center"style=" background-color:black;color:white; font-family:var;">Agregar productos</h1>
    <form style="font-family:var;" action="CRUD/insertar.PHP" method="POST" enctype="multipart/form-data" >
 
      <!-- llamamos al administrador de  la base de datos  con php -->
      <!-- esta dentro del formulario  -->
        <label for="">Administrador</label>
    <select class="form-select mb-3 " name="Administrador">
        <option selected disabled>-- Selecciona tu nombre si vas a agregar --</option>
       
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
    <label for="">CATEGORIA</label>
    <select class="form-select mb-3 " name="CategoriaP">
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

        <div class="mb-3">
            <label class="form-label">Nombre Producto </label>
            <input type="text" class="form-control" name="nombreP" >
            
        </div>   
        <div class="mb-3">
            <label class="form-label">Descripcion </label>
            <input type="text" class="form-control" name="descripcionP">
            
        </div>
        <div class="mb-3">
            <label class="form-label">Precio </label>
            <input type="text" class="form-control" name="precioP">
            
        </div>
        <div class="mb-3">
            <label class="form-label">Stock </label>
            <input type="text" class="form-control" name="stockP" >
            
        </div> 
        <!-- en este apartado se agrega la imagen de los productos   -->
        <div class="mb-3">
            <label for="imagen" class="form-label" > Imagen del producto :</label>
            <input type="file" name="imagenP" id="imagen" class="form-control">
        </div>  
        
        <!-- este boton agregar sirve apra agregar  a la base de datos   -->
        <!-- este boton volver te redirecciona a la lista de productos , por ello dice
         listaproductos.php  -->
        <div class="text-center">
        <button type="submit" class="btn btn-danger">Agregar</button>
        <a href="listaproductos.php" class="btn btn-dark">Volver</a>
        </div>   
        
    </form>
    </div>
     <!-- esto son script de boostrap  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>