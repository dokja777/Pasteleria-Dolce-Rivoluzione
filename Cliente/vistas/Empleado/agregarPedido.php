<?php
include('../../../Servidor/PHP/EmpleadoServidor/SessionAbierta.php');
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agregar Productos</title>
    <link rel="stylesheet" href="StyleLista.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
                                   
  <body style="background-color:#EAE6CA;">
 

 <!-- Formulario de agregar Productos -->
     <br>
    <div class="container" >
        <h1 class="text-center"style=" background-color:black;color:white; font-family:var;">Agregar Pedidos</h1>
    <form style="font-family:var;" action="../../../Servidor/PHP/EmpleadoServidor/insertarPedidoEm.php" method="POST" enctype="multipart/form-data" >   
      
    <div class="mb-3"  >
            <label class="form-label"  style="margin-left:1em;font-style:italic;font-size:20px;"  >Empleado : </label>
            <input type="text" class="form-control" style="background-color:#EAE6CA; border-color:black;" name="empleado" value="<?php echo $_SESSION['ID_EMPLEADO']; ?>" readonly>

            
        </div>

        <div class="mb-3"  >
            <label class="form-label"  style="margin-left:1em;font-style:italic;font-size:20px;"  >Cliente : </label>
            <select class="form-select mb-3 "  style="background-color:#EAE6CA;border-color:black;"   name="cliente">
            <option selected disabled>-- Seleccionar cliente --</option>
            <?php
         include ("../../../config/conexion.php");
         $sql = $conexion-> query("SELECT*fROM cliente");
         while($resultado=$sql->fetch_assoc()){
            echo "<option value='".$resultado['ID_CLIENTE']."'>".$resultado['NOMBRE']."</option> ";
         }
        
         



         ?>
         </select> 
        </div>
        
        
        <div class="mb-3">
            <label class="form-label" style="margin-left:1em;font-style:italic;font-size:20px;"  >Monto Final S/ : </label>
            <input type="number" class="form-control"  style="background-color:#EAE6CA;border-color:black;"  name="montoFinal" required>
            
        </div>
        <div class="mb-3">
            <label class="form-label" style="margin-left:1em;font-style:italic;font-size:20px;"  >Fecha : </label>
            <input type="date" class="form-control" style="background-color:#EAE6CA;border-color:black;"   name="fecha" required>
            
        </div> 
        <div class="mb-3">
                    <label for="Metodo pago" style="margin-left:1em;font-style:italic;font-size:20px;">Metodo de pago :</label>
                    <select class="form-select" style="background-color:#EAE6CA;border-color:black;"   aria-label="Default select example" name="metodoPago" required>
                    <option value="Credito">Credito</option>
                    <option value="Yape">Yape</option>
                    <option value="Paypal">Paypal</option>
                    </select>
        </div>
        <div class="mb-3">
                <label for="estado" style="margin-left:1em;font-style:italic;font-size:20px;">Estado</label>
                <select class="form-select" style="background-color:#EAE6CA;border-color:black;"  aria-label="Default select example" name="estado" required>
                    <option value="Pendiente">Pendiente</option>
                    <option value="Completado">Completado</option>
                    <option value="Entregado">Entregado</option>
                    </select>
        </div>
        
        <!-- este boton agregar sirve apra agregar  a la base de datos   -->
        <!-- este boton volver te redirecciona a la lista de productos , por ello dice
         listarEmpleado.php  -->
        <div class="text-center" style="margin-bottom:1em;">
        <button type="submit" class="btn btn-danger"    >Agregar</button>
        <a href="../Empleado/pedidos.php" class="btn btn-dark">Volver</a>
        </div>   
        
    </form>
    </div>
     <!-- esto son script de boostrap  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>