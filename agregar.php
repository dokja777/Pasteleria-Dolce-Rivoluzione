<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agregar Productos</title>
    <link rel="stylesheet" href="StyleLista.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
        <h1 class="text-center"style=" background-color:black;color:white; ">Agregar productos</h1>
    <form >

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
        
    </select>   

        <div class="mb-3">
            <label class="form-label">Nombre Producto </label>
            <input type="text" class="form-control" >
            
        </div>   
        <div class="mb-3">
            <label class="form-label">Descripcion </label>
            <input type="text" class="form-control" >
            
        </div>
        <div class="mb-3">
            <label class="form-label">Precio </label>
            <input type="text" class="form-control" >
            
        </div>
        <div class="mb-3">
            <label class="form-label">Stock </label>
            <input type="text" class="form-control" >
            
        </div> 
        <div class="mb-3">
        <label for="imagen">Selecciona una imagen:</label>
            <input type="file" name="imagen" id="imagen">
        </div>  
        
        <div class="text-center">
        <button type="submit" class="btn btn-danger">Agregar</button>
        <a href="listaproductos.php" class="btn btn-dark">Volver</a>
        </div>   
        
    </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>