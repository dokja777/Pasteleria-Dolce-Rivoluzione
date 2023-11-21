<?php

include('../../../Servidor/conexion.php');

// Obtén los valores de correo y teléfono del formulario
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];

// Realiza la consulta en la base de datos
$sql = $sql = "SELECT * FROM cliente WHERE correo LIKE '$correo' AND telefono LIKE '$telefono'";
$result = $conexion->query($sql);

// Verifica si se encontraron resultados
if ($result->num_rows > 0) {
	// Los datos coinciden, puedes enviar el correo de recuperación aquí
	// Puedes realizar las acciones necesarias, como enviar un correo, actualizar la contraseña, etc.

	//include('recuperarContrasena.php');
	
	// Por ejemplo, aquí solo imprimiremos un mensaje de éxito
	$response = array();
	$response = array('exito' => true, 'redireccionar' => true, 'correo' => $correo);
	echo json_encode($response);
	
	// Después de validar los datos, incluye y ejecuta recuperarContrasena.php
	//include('recuperarContrasena.php');
	
} else {
	// Los datos no coinciden
	$response = array('exito' => false, 'mensaje' => 'Los datos no coinciden con la base de datos.');
	echo json_encode($response);
}

?>
