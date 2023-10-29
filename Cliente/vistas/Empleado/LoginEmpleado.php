<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Empleado </title>
  <link rel="stylesheet" href="../../../Cliente/css/loginEmpleado.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>
  <div class="container text-center">
    <div class="row">
      <div class="col">
        <div class="fondo">
          <div class="imagen">
            <img id="logo" src="../../../Cliente/recursos/img/logo.png" width="80px" alt="Logo de la pasteleria">
          </div>
          <div class="info">
            <h2>Pateleria Dolce Rivoluzione</h2>
            <h4> Login Empleados</h4>
            <img src="../../../Cliente/recursos/img/pastel.png" width="40px" alt="Descripción de la imagen">
          </div>
        </div>
      </div>
      <div class="col">
        <div class="item">
          <form action="../../../Servidor/PHP/EmpleadoServidor/ValidarEmpleado.php" method="POST">
            <h1>INICIA SESIÓN</h1>
            <hr>
            <br>
            <label>USUARIO <i class="fa fa-user"></i> </label>
            <input name="Correo" type="text" placeholder="Ingresar el usuario ">
            <br>
            <label>CONTRASEÑA <i class="fa fa-lock"></i></label>
            <input name="Contraseña" type="password" placeholder="Ingresar tu contraseña">
            <br>
            <hr>
            <br>
            <input type="submit" value="Iniciar sesión">
          </form>
        </div>
      </div>
    </div>
  </div>








  <style>
    body {
      background-image: url('../Empleado/pasteles.jpg');
      background-size: cover;
      background-repeat: no-repeat;
    }
  </style>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>