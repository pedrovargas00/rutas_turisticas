<?php
session_start();
include("../db/database.php");

use Encryption\Encryption;
use Encryption\Exception\EncryptionException;

$usuario = $_REQUEST['usuario'];
$password = $_REQUEST['password'];

$result = mysqli_query($conn, "SELECT usuario, tipo_usuario, id_usuario, contrasenia FROM usuario WHERE usuario = '$usuario'")
   or die (mysqli_error($conn));

if ($row = mysqli_fetch_array($result)) {
   try {
      $encryption = Encryption::getEncryptionObject();
      $pw = $encryption->decrypt($row['contrasenia'], $_ENV['ENCRYPT_KEY'], base64_decode($_ENV['ENCRYPT_IV']));
   }
   catch (EncryptionException $e) {
      echo $e;
   }
   if ($password == $pw) {
      //echo "<label style='color: green'>Login realizado correctamente</label>";
      $_SESSION['usuario'] = $row['usuario']; //variable de sesión
      $_SESSION['tipo'] = $row['tipo_usuario']; //variable de sesión
      $_SESSION['id_cliente'] = $row['id_usuario']; //variable de sesión
      $_SESSION['activa'] = true;
      if ($row['tipo_usuario'] == 1)
         header("Location: ../public/usuario/indexUsuario.php");
      else
         header("Location: ../public/admin/indexAdmin.php");
   } else {
      $_SESSION['activa'] = false;
      header("Location: ../login.php");
   }
      //echo "<label style='color: red'>Datos incorrectos</label>";
// } else
//    echo "<label style='color: red'>Usuario no encontrado</label>";
 } else {
      $_SESSION['activa'] = false;
      header("Location: ../login.php");
   }
?>