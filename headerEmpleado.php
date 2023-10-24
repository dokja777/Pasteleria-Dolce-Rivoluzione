
<div class="sidebar close">
    <div class="logo-details">
      <img src="../img/logo.png" alt="" />
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
        <a href="../Empleado/cerrarSession.php">
        <i class="fa-solid fa-sign-out"></i> <!-- Icono de cerrar sesión -->
        <span class="link_name">Cerrar sesión</span>
  </a>
</li>
    </ul>
  </div>