<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <title>Editar Usuario</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <img src="../../../Cliente/recursos/img/logo.png" alt="" >
            <a class="titulo" href="indexAdministrador.php">Pastelería Dolce Rivoluzione</a>

            <div class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="btn " href="indexAdministrador.php" aria-current="page">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn " href="pedidos.php">Pedidos</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn " href="listaproductos.php">Productos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn " href="listarAdministrador.php">Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn "
                            href="../../../Cliente/vistas/Administrador/listarEmpleados.php">Empleados</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn " href="demanda.php">Demandas</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn " href="ingreso.php">Ingresos</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php
    $idU = $_GET['idU'];
    $usuarioU = $_GET['usuarioU'];
    $usuarioN = $_GET['usuarioN'];
    $usuarioP = $_GET['usuarioP']; 
    ?>

   <section>
       <h2>Editar Administrador</h2>
       <hr>
      <form action="../../../Servidor/PHP/Administrador/editarUsuarios.php"   method="POST"  name="formularioEditar"  enctype="multipart/form-data" >
         <div class="tituloSecundario">
            <label class="form-label" >Modificar los Datos :</label>
            <input type="hidden" name="idU" value="<?=$idU?>">
         </div>
          <div class="usu">
            <label class="form-label">Usuario : </label>
            <input type="text" class="form-control"  name="usuarioU" value="<?=$usuarioU?>">
          </div>
          <div class="nom">
            <label class="form-label">Nombre Completo : </label>
            <input type="text" class="form-control"  name="usuarioN" value="<?=$usuarioN?>">
          </div>
          <div class="pass">
            <label class="form-label"> Contraseña : </label>
            <input type="text" class="form-control"  name="usuarioP" value="<?=$usuarioP?>">
          </div>
          <div class="botones" >
            <button type="submit" onclick="mostrarConfirmacion()" class="boton">Actualizar</button>
            <a href="../../../Cliente/vistas/Administrador/listarAdministrador.php" class=" ">Volver</a>
          </div>   
      </form>

   </section>
    

    <style>
        body {
            margin: 0;
            font-family: "Lato", sans-serif;
            box-sizing: border-box;
        }

        nav {
            background-color: #f9cb9c;
        }
        .container-fluid img{
            width: 5em;
            
        }
        .container-fluid .titulo {
            text-decoration: none;
            color: #783f04;
            font-weight: 900;
            padding-left: 3px;
            font-size: 20px;
        }

        .navbar-nav a {
            margin-left: 3em;
            color: #783f04;
            font-weight:600;
            border: none;
        }
        .navbar-nav :hover{
            color: whitesmoke;
            text-shadow: 1px 2px 10px rgb(95, 67, 16);
            letter-spacing: 1px;
        }


        section{
            display: flex;
            flex-direction: column;
            margin: 30px 210px;
            box-shadow: 1px 2px 10px black;
        }
        section h2{
            text-align: center;
            padding-top: 13px;
            font-weight: 900;
            font-size: 35px;
            letter-spacing: 1px;
        }
         
        section form{
            padding-left:105px;
            padding-right:105px;
            font-size: 18px;
            letter-spacing: 1px;
            color: rgb(58, 58, 58);
            padding-bottom: 25px;
        }

        section .tituloSecundario{
            font-weight: 600;
            padding-bottom: 9px;
        }
        form .usu{
            padding-bottom: 14px;
        }
        .usu input{
            border: none;
            border-bottom: 1px solid black;
            padding-left: 10px;
            
        }
        form .nom{
            
            padding-bottom: 14px;
        }
        .nom input{
            border: none;
            border-bottom: 1px solid black;
            padding-left: 10px;
        }

        form .pass{
            padding-bottom: 36px;
        }

        .pass input{
            border: none;
            border-bottom: 1px solid black;
            padding-left: 10px;
        }
        form .botones{
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 9px;
        }
        .botones button{
            color: white;
            border: none;
            letter-spacing: 1px;
            box-shadow: 1px 2px 10px black;
            font-weight: bold;
            padding: 5px 10px;
            background-color: rgb(255, 136, 0);
            border-radius: 9px;
        }
        

        .botones a{
         text-decoration: none;
         text-align: center;
         display: flex;
         align-items: center;
         justify-content: center;
         color: white;
         font-weight: 900;
         letter-spacing: 1px;
         background-color: rgb(36, 34, 34);
         border-radius: 9px;
         box-shadow: 1px 2px 10px black
        }
        .botones :hover{
            box-shadow: 1px 2px 20px whitesmoke;
        }
    </style>
    
   

     <script src="../../../Cliente/js/mensajeActualizarAdmin.js"></script>
 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
       
</body>

</html>