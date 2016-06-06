<?php
require 'PHPMailerAutoload.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$postdata = file_get_contents("php://input");
$data = json_decode($postdata);

$mail = new PHPMailer;

//$mail->SMTPDebug = 1;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'localhost';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'desarrollo@anapoimanatura.com';                 // SMTP username
$mail->Password = 'x77340319x';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

$mail->setFrom('correo.fromnatura@gmail.com');
$mail->addAddress('anapoimanatura@gmail.com');     // Add a recipient
$mail->isHTML(True);                                  // Set email format to HTML

$mail->Subject = $data->nombre . ' te ha enviado un mensaje desde la Pagina Principal Natura';
$mail->Body    = 'Has recibido un correo nuevo desde la página principal de Natura.<br><br>';
$mail->Body    .= 'Nombre: ' . $data->nombre . '<br>';
$mail->Body    .= 'Email: ' . $data->email . '<br>';
$mail->Body    .= 'Mensaje: ' . $data->body . '<br><br>';
$mail->Body    .= 'Fin del mensaje.';

if(!$mail->send()) {
    echo '0';
} else {
    echo '1';
}
?>