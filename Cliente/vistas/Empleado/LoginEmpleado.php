<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Empleado </title>
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merienda&display=swap">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>
  <div   data-aos="zoom-out-down"   class="ContenedorPrincipal">
  <div class="contenedorInfo">
      <div class="fondo">
          <h2>Pasteleria Dolce Rivoluzione</h2>
          <h4> Login Empleado</h4>
          <img id="logo" src="../../../Cliente/recursos/img/logo.png" width="170px" alt="Logo de la pasteleria">
      </div>
    </div>
      <div class="contenedorInfo2">
            <h1>INICIA SESIÓN <br> EMPLEADO</h1>
             <hr>
          <form action="../../../Servidor/PHP/EmpleadoServidor/ValidarEmpleado.php" method="POST">
            
          <div class="usu">
          <label>USUARIO <i class="fa fa-user"></i> </label>
          <br>
          <input name="Correo" type="text" placeholder="Ingresar el usuario ">
          </div>
          <div class="pass">
          <label>CONTRASEÑA <i class="fa fa-lock"></i></label>
          <br>
          <input name="Contraseña" type="password" placeholder="Ingresar tu contraseña">
          </div>
          <div class="boton">
          <input type="submit" value="Iniciar sesión">
          </div>
          
          </form>
        
      </div>
    
  </div>








  <style>
    body {
     background-color: #EAE6CA;
      background-size: cover;
      background-repeat: no-repeat;
      font-family: 'Merienda', cursive;
      box-sizing: border-box;
    }
    .ContenedorPrincipal{
      display: grid;
      grid-template-columns: 60% 40%;
      margin: 50px 65px;
      box-shadow: 1px 2px 40px black;
    }
    .contenedorInfo{
      background-color: wheat;
      display: flex;
      align-items: center;
      text-align: center;
      justify-content: center;
    }

    .contenedorInfo .fondo{
      margin-top: 180px;
      margin-bottom: 90px;
    }
    .fondo h2{
      font-weight: 900;
      font-size: 35px;
      
    }
    

    .contenedorInfo2{
      display: flex;
      flex-direction: column;
      background-color:white ;
    }

    .contenedorInfo2 h1{
      font-weight: bold;
      font-size: 30px;
      padding-top: 90px;
      text-align: center;
    }

     .contenedorInfo2 form{
     padding-top: 35px;
     padding-left: 95px;
    }

    .contenedorInfo2 .usu{
     margin-bottom: 9px;
     padding-left: 20px;
     font-size: 18px;
     padding-bottom: 4px;
    }
    .usu input{
     border: none;
     margin-bottom: 2px;
     border-bottom: 1px solid black;
    } 

    .usu ::placeholder{
      padding-left: 5px;
      font-size: 16px;
      
    }

    .contenedorInfo2 .pass{
      margin-top: 20px;
      font-size: 18px;
      padding-left: 20px;
    }
    .pass ::placeholder{
      padding-left: 5px;
      font-size: 16px;
    }

    .pass input{
     border: none;
     margin-bottom: 2px;
     border-bottom: 1px solid black;
    } 

     .contenedorInfo2 .boton{
      margin-top: 40px;
      text-align: center;
     
     }
    .boton input{
     background-color: rgb(204, 138, 94);
     color: whitesmoke;
     font-weight: bold;
     border: none;
     border-radius: 5px;
     padding: 6px 60px;
     box-shadow: 1px 2px 10px black;
    }
    .boton :hover{
      background-color: rgb(255, 154, 87);
      letter-spacing: 3px;
      box-shadow: 1px 2px 10px white;
    }

  </style>
   

   <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>