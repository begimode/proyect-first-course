<?php

$nombre = $_POST["nombre"];
$apellidos = $_POST["apellidos"];
$email = $_POST["email"];
$movil = $_POST["movil"];
$asunto = $_POST["asunto"];
$mensaje = $_POST["mensaje"];

$body = "Nombre completo: " . $nombre . " " . $apellidos . "<br> Email: " . $email . "<br> Movil: " . $movil . "<br> Asunto: " . $asunto . "<br> Mensaje: " . $mensaje;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './Exception.php';
require './PHPMailer.php';
require './SMTP.php';

$mail = new PHPMailer(true);

try {
//Server settings
$mail->SMTPDebug = 0;

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'jaumeferrer414@gmail.com';
$mail->Password = 'Jaume_2003';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

//Recipients
$mail->setFrom('jaumeferrer414@gmail.com', $nombre);
$mail->addAddress('jaumeferrer414@gmail.com', 'CLIENTE');


//Content
$mail->isHTML(true);
$mail->CharSet = 'UTF-8';
$mail->Subject = $asunto;
$mail->Body = $body;

$mail->Send();

header("location:../html/contacto.html");

echo '<script>
window.history.go(-1);
</script>';

} catch (Exception $e) {
echo "El mensaje no ha podido ser enviado. Mailer Error: {$mail->ErrorInfo}";
}