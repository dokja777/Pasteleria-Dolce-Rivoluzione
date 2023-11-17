<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../../config.php';

require '../../../Cliente/recursos/libs/PHPMailer/Exception.php';
require '../../../Cliente/recursos/libs/PHPMailer/PHPMailer.php';
require '../../../Cliente/recursos/libs/PHPMailer/SMTP.php';

include('../../../Servidor/conexion.php');


//$correo = $_POST['correo'];
// Comprueba si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $correo = $_POST['correo'];
  $telefono = $_POST['telefono'];

  try {
    // Creación de una nueva instancia de PHPMailer
    $mail = new PHPMailer();
    // Configuración del servidor SMTP y la autenticación
    $mail->isSMTP();
    $mail->SMTPDebug = 2;
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'pasteleria.dolce.rivoluzione@gmail.com';
    $mail->Password = 'oexlowtjavsubfch';
    $mail->SMTPSecure = 'tls'; // Puedes cambiar a 'ssl' si tu servidor lo requiere
    $mail->Port = 587; // Puerto SMTP
    $mail->SMTPOptions = array(
      'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
      )
    );

    // Configura el correo electrónico
    $mail->setFrom('pasteleria.dolce.rivoluzione@gmail.com', 'Pasteleria Dolce Rivoluzione');
    
    $mail->addAddress($correo); // Cambia la dirección de destino
    $mail->Subject = 'Reestablecimiento de Contraseña';

    // Cuerpo del mensaje
    $mensaje = "Estimado usuario,\n\n";
    $mensaje .= "Hemos recibido una solicitud para restablecer la contraseña de tu cuenta en Pasteleria Dolce Rivoluzione.\n";
    $mensaje .= "Por favor, haz clic en el siguiente enlace para proceder con el cambio de contraseña:\n";
   
    $mensaje .= "Si no solicitaste este cambio, te recomendamos ignorar este mensaje y tu contraseña seguirá siendo la misma.\n";
    $mensaje .= "Este enlace es válido por un tiempo limitado por razones de seguridad.\n\n";
    $mensaje .= "Atentamente,\n";
    $mensaje .= "El equipo de Pasteleria Dolce Rivoluzione";
    $mail->Body = $mensaje;

    // Configura la codificación del mensaje en UTF-8
    $mail->CharSet = 'UTF-8';

    // Enviar el correo electrónico
    $mail->send();
    //error_log("Mensaje enviado con éxito. ¡Gracias por ponerte en contacto!");

    // Redirige al usuario a la página deseada
    //header("Location: ../../../Cliente/vistas/Cliente/inicioSesion.php");
  } catch (Exception $e) {
    //error_log("Error al enviar el mensaje: {$mail->ErrorInfo}");
  }
} else {
  //error_log("No se pudo procesar el formulario.");
}

function generarToken(){
  return md5(uniqid(mt_rand(),false));
}
?>