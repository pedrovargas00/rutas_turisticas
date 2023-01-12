<?php
include("../db/database.php");

use Encryption\Encryption;
use Encryption\Exception\EncryptionException;

session_start();

$nombre = $_REQUEST['nombre'];
$usuario = $_REQUEST['usuario'];
$correo = $_REQUEST['correo'];
$password = $_REQUEST['password'];

$result = mysqli_query($conn, "SELECT * FROM usuario WHERE usuario = '$usuario' OR correo = '$correo'")
   or die (mysqli_error($conn));
$correoValidar = explode('@', $correo);

try {
   $encryption = Encryption::getEncryptionObject();
   $pw = $encryption->encrypt($password, $_ENV['ENCRYPT_KEY'], base64_decode($_ENV['ENCRYPT_IV']));
}
catch (EncryptionException $e) {
    echo $e;
}
//$pw = encrypt($password, 'aes-256-cbc', $_ENV['ENCRYPT_KEY'], base64_decode($_ENV['ENCRYPT_IV']));
// print_r($result);
// echo $correo;
// $row = mysqli_fetch_array($result);
// echo $row['usuario'];

if (mysqli_num_rows($result) == 0 && ($correoValidar[1] == "gmail.com" || $correoValidar[1] == "outlook.com" || $correoValidar[1] == "correo.buap.mx" || $correoValidar[1] == "alumno.buap.mx")) {
   $date = date("Y-m-d");
   $result = mysqli_query($conn, "INSERT INTO usuario (nombre, usuario, correo, fecha_registro, contrasenia, tipo_usuario)
      VALUES('$nombre', '$usuario', '$correo', '$date', '$pw', 1);")
      or die (mysqli_error($conn));
   // echo "<label style='color: green'>Registro realizado correctamente</label>";
   $_SESSION['registro'] = true;
   header("Location: ../index.php");
} else {
   $_SESSION['registro'] = false;
   // echo "<label style='color: red'>Los datos registrados ya existen</label>";
   header("Location: ../public/registro.php");
}
?>