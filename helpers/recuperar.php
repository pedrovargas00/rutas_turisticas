<?php
session_start();
include("../db/database.php");
require("../vendor/autoload.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

use Encryption\Encryption;
use Encryption\Exception\EncryptionException;

// require 'path/to/PHPMailer/src/Exception.php';
// require 'path/to/PHPMailer/src/PHPMailer.php';
// require 'path/to/PHPMailer/src/SMTP.php';

$correo = $_REQUEST['correo'];

$mail = new PHPMailer(true);
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__FILE__, 2));
$dotenv->load();

$result = mysqli_query($conn, "SELECT contrasenia, usuario FROM usuario WHERE correo = '$correo'")
   or die (mysqli_error($conn));

if (mysqli_num_rows($result) == 0) {
   $_SESSION['correo_existe'] = false;
   return header("Location: ../public/recuperarContrasena.php");
}

$row = mysqli_fetch_array($result);
$usuario = $row['usuario'];
try {
   $encryption = Encryption::getEncryptionObject();
   $pw = $encryption->decrypt($row['contrasenia'], $_ENV['ENCRYPT_KEY'], base64_decode($_ENV['ENCRYPT_IV']));
}
catch (EncryptionException $e) {
    echo $e;
}

try {
   $mail->setLanguage('es');
   $mail->CharSet = 'UTF-8';
   //Server settings
   $mail->SMTPDebug = 2;                                          //Enable verbose debug output
   $mail->isSMTP();                                               //Send using SMTP
   $mail->Host       = 'smtp-mail.outlook.com; smtp.gmail.com;';   //Set the SMTP server to send through
   $mail->SMTPAuth   = true;                                      //Enable SMTP authentication
   $mail->Username   = $_ENV['RECOVERY_USERNAME'];                //SMTP username
   $mail->Password   = $_ENV['PASSWORD'];                         //SMTP password
   $mail->SMTPSecure = 'tls';                                     //Enable implicit TLS encryption
   $mail->Port       = 587;                                       //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

   //Recipients
   $mail->setFrom($_ENV['RECOVERY_USERNAME'], 'Sistemas');
   $mail->addAddress($correo, $usuario);                    //Add a recipient
   // $mail->addAddress('ellen@example.com');               //Name is optional
   $mail->addReplyTo($_ENV['REPLY_EMAIL'], 'Sistemas');
   // $mail->addCC('cc@example.com');
   // $mail->addBCC('bcc@example.com');

   //Attachments
   // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
   // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

   //Content
   $mail->isHTML(true);                                  //Set email format to HTML
   $mail->Subject = 'Recuperación de contraseña';
   $mail->Body    = 'Su contraseña es: '.$pw;
   // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

   $mail->send();
   $_SESSION['correo_existe'] = true;
   header("Location: ../public/recuperarContrasena.php");
   //echo 'Message has been sent';
} catch (Exception $e) {
   echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>