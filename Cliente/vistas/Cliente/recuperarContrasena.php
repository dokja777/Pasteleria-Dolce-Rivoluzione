<?php
include('../../../Config/conexion.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../../../Cliente/css/style.css" />
	<link rel="stylesheet" href="../../../Cliente/css/recuperarContrasena.css">
	<!-- Iconos en font awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
		integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />
	<title>Productos</title>
</head>

<body>
	<!-- Configuración del navbar -->

	<header>
		<div class="header-left">
			<div class="logo">
				<a href="indexCliente.php">
					<img src="../../../Cliente/recursos/img/logo.png" alt="" />
				</a>
			</div>
			<nav>
				<ul>
					<li>
						<a href="indexCliente.php" class="active">Inicio</a>
					</li>
					<li>
						<a href="productos.php">Productos</a>
					</li>
					<li>
						<a href="nosotros.php">Nosotros</a>
					</li>
				</ul>
				<div class="perfil-carrito">
					<a href="perfil.html"><i class="fa-solid fa-user"></i></a>
					<a href="agregar_al_carrito.php"><i class="fa-solid fa-cart-shopping"></i></a>
				</div>
			</nav>
		</div>
		<div class="header-right">
			<div class="perfil-carrito">
				<a href="inicioSesion.php"><i class="fa-solid fa-right-to-bracket" style="color: #51361f;"></i> Inicia
					Sesión</a>

				<a href="agregar_al_carrito.php"><i class="fa-solid fa-cart-shopping"></i></a>
			</div>
			<div class="hamburger">
				<div></div>
				<div></div>
				<div></div>
			</div>
		</div>
	</header>
	<script>
		hamburger = document.querySelector(".hamburger");
		nav = document.querySelector("nav");
		hamburger.onclick = function () {
			nav.classList.toggle("active");
		};
	</script>

	<main class="cuerpo">
		<div class="header">

			<!--Recuperación contraseña---->

			<form method="POST" onsubmit="return validarRecuperacion()">
				<h1>RECUPERACIÓN DE CONTRASEÑA</h1>
				<hr>
				<br>
				<i class="fa-solid fa-at"></i>
				<label>Correo</label>
				<input id="correo" name="correo" type="email" placeholder="Ingresa tu correo electronico" required>
				<br>
				<i class="fa-solid fa-phone"></i>
				<label>Teléfono</label>
				<input id="telefono" name="telefono" type="tel" placeholder="Ingresa tu número telefónico" required>
				<br>
				<hr>
				<br>
				<button type="submit" class="btn btn-primary">Enviar correo de recuperación</button>
			</form>

			<!--FIN RECUPERACIÓN CONTRASEÑA---->
		</div>

	</main>

	<script>
		function validarRecuperacion() {
			// Obtén los valores de correo y teléfono
			var correo = document.getElementById('correo').value;
			var telefono = document.getElementById('telefono').value;

			// Crea un objeto FormData para enviar los datos al servidor
			var formData = new FormData();
			formData.append('correo', correo);
			formData.append('telefono', telefono);

			// Realiza una solicitud AJAX
			var xhr = new XMLHttpRequest();
			xhr.open('POST', '../../../Servidor/PHP/Cliente/validacionDatosContrasena.php', true);
			xhr.onreadystatechange = function () {
				if (xhr.readyState === 4) {
					if (xhr.status === 200) {
						// Maneja la respuesta del servidor
						var respuesta = JSON.parse(xhr.responseText);

						if (respuesta.exito) {

							if (respuesta.redireccionar) {
								// Los datos coinciden, muestra un mensaje de éxito
								alert("Correo enviado con éxito. Revise su bandeja de entrada.");
								console.log("Correo enviado con éxito. Revise su bandeja de entrada.");

								// Redirige solo si se especifica en la respuesta
								window.location.href = "inicioSesion.php"; // Cambia "tu_pagina_actual.php" con tu ruta real
							}
						} else {
							// Los datos no coinciden, muestra un mensaje de error
							alert(respuesta.mensaje);
							console.error(respuesta.mensaje);
						}
					} else {
						// Maneja errores de la solicitud AJAX
						console.error('Error en la solicitud AJAX:', xhr.status, xhr.statusText);
					}
				}
			};

			// Envía la solicitud al servidor con los datos del formulario
			xhr.send(formData);

			// Evita que el formulario se envíe de forma convencional
			return false;
		}

	</script>

	<!-- Footer -->
	<?php
	include('../../../Cliente/vistas/Cliente/footer.php');
	?>

</body>

</html>