<?php
include("sesion.php");
include("../db/database.php");

$id_usuario = $_REQUEST['id_usuario'];
$nombre = $_REQUEST['nombre'];
$usuario = $_REQUEST['usuario'];
$correo = $_REQUEST['correo'];
$password = $_REQUEST['password'];
$tipo_usuario = $_REQUEST['tipo_usuario'];

$res = mysqli_query($conn, "SELECT id_usuario FROM usuario WHERE nombre = '$nombre' OR correo = '$correo' AND id_usuario != '$id_usuario';")
   or die (mysqli_error($conn));

if (mysqli_num_rows($res) != 0){
   $_SESSION['usuario_existe'] = true;
   return header("Location: ../public/usuario/crear_ruta.php?resultado=<?php echo $id_usuario; ?>");
}

$result = mysqli_query($conn, "UPDATE usuario SET nombre='$nombre', usuario='$usuario', correo='$correo', 
   contrasenia='$password', tipo_usuario='$tipo_usuario' WHERE id_usuario = '$id_usuario';")
   or die (mysqli_error($conn));

header("Location: ../public/admin/indexAdmin.php"); 
mysqli_close($conn); 
?>