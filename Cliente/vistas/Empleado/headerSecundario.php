<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
  
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
  </head>

  <body>
    <nav class="navbar navbar-expand-lg">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"
          ><img src="../../../Cliente/recursos/img/logo.png" alt="" />
          <span>Pastelería Dolce Rivoluzione</span>
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNavAltMarkup"
          aria-controls="navbarNavAltMarkup"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a id="H"
              class="nav-link" active aria-current="page"
              href="../../../Cliente/vistas/Empleado/indexEmpleado.php"
              ><i class="fa-solid fa-house"></i>Inicio</a
            >
            <a id="H"
              class="nav-link"
              href="../../../Cliente/vistas/Empleado/pedidos.php"
              ><i class="fas fa-shopping-cart"></i>Pedidos</a
            >
            <a  id="H" class="nav-link" href="../Empleado/productoEmpleado.php"
              ><i class="fas fa-box"></i>Productos</a
            >
            <a id="H" class="nav-link" onclick="confirmLogout()"
              >Cerrar sessión <i class="fa-solid fa-sign-out"></i>
            </a>
          </div>
        </div>
      </div>
    </nav>
    <script>
      function confirmLogout() {
        Swal.fire({
          title: "¿Estás seguro de que deseas cerrar sessión  ?",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Sí, cerrar sessión",
          cancelButtonText: "Cancelar",
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href =
              "../../../Servidor/PHP/EmpleadoServidor/cerrarSession.php";
          }
        });
      }
    </script>

    <style>
      body {
        font-family: "Franklin Gothic Medium", "Arial Narrow", Arial, sans-serif;
      }

      img {
        margin: 0;
        width: 60px;
        position: relative;
      }

       a  {
        cursor: pointer;
        display: flex;
        align-items: center;
        text-align: center;
      }

      nav {
        background-color: #f9cb9c;
        display: flex;
      }

      span {
        padding-left: 10px;
        font-size: 17px;
      }

       a :hover {
        background-color: lightsalmon;
        font-size: 20px;
        box-shadow: 2px 2px 7px orangered;
      }

      @media (min-width: 992px) {
        body {
          margin: 0;
          font-family: "Roboto", "sans-serif";
        }

        img {
          margin: 0;
          width: 80px;
          position: relative;
        }

        .collapse {
          display: flex;
          flex-direction: column;
          align-items: center;
          text-align: center;
          font-size: 17px;
          font-weight: 900;
          padding: auto;
          letter-spacing: 3px;
        }

         #H{
          cursor: pointer;
          display: flex;
          align-items: center;
          text-align: center;
          margin: 0px 25px;
        }

        span {
          padding-left: 10px;
          font-size: 22px;
          font-weight: 700;
        }

        #H :hover {
          background-color: #f9cb9c;
          font-size: 20px;
          box-shadow: none;
        }
      }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
