<div class="sidebar close">
  <div class="logo-details">
    <img src="../../../Cliente/recursos/img/logo.png" alt="" />
    <span class="logo_name">Pastelería Dolce Rivoluzione</span>
  </div>
  <ul class="nav-links">
    <li>
      <a href="../Empleado/indexEmpleado.php">
        <i class='fa-solid fa-house'></i>
        <span class="link_name">Inicio</span>
      </a>
      <ul class="sub-menu blank">
        <li><a href="../Empleado/indexEmpleado.php" class="link_name">Inicio</a></li>
      </ul>
    </li>
    <li>
      <div class="icon-link">
        <a href="../Empleado/pedidos.php">
          <i class='fas fa-shopping-cart'></i>
          <span class="link_name">Pedidos</span>
        </a>
      </div>
      <ul class="sub-menu">
        <li><a href="../Empleado/pedidos.php" class="link_name">Pedidos</a></li>

      </ul>
    </li>
    <li>
      <div class="icon-link">
        <a href="../Empleado/productoEmpleado.php">
          <i class='fas fa-box'></i>
          <span class="link_name">Productos</span>
        </a>
      </div>
      <ul class="sub-menu">
        <li><a href="../Empleado/productoEmpleado.php" class="link_name">Productos</a></li>
      </ul>
    </li>
    <li>
      <a href="">
        <i class='fas fa-users'></i>
        <span class="link_name">Usuarios</span>
      </a>
      <ul class="sub-menu blank">
        <li><a href="" class="link_name">Usuarios</a></li>
      </ul>
    </li>

    <li>
      <div class="profile-details">
        <div class="profile-content">
          <i class="fa-solid fa-user"></i>
        </div>
        <div class="name-job">
          <div class="profile_name">
            <?php
            echo $_SESSION['nombre_usuario']; // Mostrar el nombre del usuario
            ?>
          </div>
          <div class="job">Empleado</div>
        </div>
        <i class='fa-solid fa-arrow'></i>
      </div>
    </li>
    <li>
     <a href="#" onclick="confirmLogout()">
      <i class="fa-solid fa-sign-out"></i>
     <span class="link_name">Cerrar sesión</span>
     </a>
    </li>
    <script>
     function confirmLogout(){
      Swal.fire({
    title: "¿Estás seguro de que deseas cerrar sesión :( ?",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sí, cerrar sesión",
    cancelButtonText: "Cancelar"
  }).then((result) => {
    if (result.isConfirmed) {
      // Si el usuario hace clic en "Sí, cerrar sesión", redirige al archivo de cierre de sesión
      window.location.href = "../../../Servidor/PHP/EmpleadoServidor/cerrarSession.php";
    }
    // Si el usuario hace clic en "Cancelar", no se hace nada
  });
}
     


    </script>
  </ul>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>