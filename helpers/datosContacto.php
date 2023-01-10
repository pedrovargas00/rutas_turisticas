<?php
require("../vendor/autoload.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$nombre = $_REQUEST['nombre'];
$correo = $_REQUEST['email'];
$asunto = $_REQUEST['asunto'];
$mensaje = $_REQUEST['mensaje'];

$mail = new PHPMailer(true);
$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();
try {
   $mail->setLanguage('es');
   $mail->CharSet = 'UTF-8';
   //Server settings
   $mail->SMTPDebug = 2;                                       //Enable verbose debug output
   $mail->isSMTP();                                            //Send using SMTP
   $mail->Host       = 'smtp-mail.outlook.com; smtp.gmail.com;'; //Set the SMTP server to send through
   $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
   $mail->Username   = $_ENV['RECOVERY_USERNAME'];             //SMTP username
   $mail->Password   = $_ENV['PASSWORD'];                      //SMTP password
   $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
   $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

   //Recipients
   $mail->setFrom($_ENV['RECOVERY_USERNAME'], 'Sistemas');
   $mail->addAddress($_ENV['REPLY_EMAIL'], 'Solicitud'); //Add a recipient
   // $mail->addAddress('ellen@example.com');               //Name is optional
   //$mail->addReplyTo('piterv4650@gmail.com', 'Sistemas');
   // $mail->addCC('cc@example.com');
   // $mail->addBCC('bcc@example.com');

   //Attachments
   // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
   // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

   //Content
   $mail->isHTML(true);                                  //Set email format to HTML
   $mail->Subject = 'Correo de contacto';
   $mail->Body    = 'Mensaje de: '.$nombre.PHP_EOL.'Correo: '.$correo.PHP_EOL.'Asunto: '.$asunto.PHP_EOL.'Mensaje: '.$mensaje.PHP_EOL;
   
   // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

   $mail->send();
   $_SESSION['correo_existe'] = true;
   header("Location: ../public/index.php");
   //echo 'Message has been sent';
} catch (Exception $e) {
   echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>