<?php
include("sesion.php");
include("../db/database.php");
require("../vendor/autoload.php");
include("../cloudinary/config.php");
use Cloudinary\Api\Upload\UploadApi;

$nombre_ruta = $_REQUEST['nombre'];
$descripcion = $_REQUEST['descripcion'];
$lugar_principal = $_REQUEST['lugar'];
$imagen_1 = $_FILES['imagen1']['tmp_name'];
$imagen_2 = $_FILES['imagen2']['tmp_name'];
$costo = $_REQUEST['costo'];
$actividad_1 = $_REQUEST['actividad1'];
$actividad_2 = $_REQUEST['actividad2'];
$hotel = $_REQUEST['hotel'];
$calificacion = $_REQUEST['estrellas'];
$comentario = $_REQUEST['comentario'];

$nombre_ruta_upper = mb_strtoupper($nombre_ruta);
$id_usuario = $_SESSION['id_cliente'];
// echo $id_usuario;
$res = mysqli_query($conn, "SELECT id_ruta FROM ruta WHERE nombre_ruta = '$nombre_ruta_upper' AND id_usuario = '$id_usuario';")
   or die (mysqli_error($conn));

if (mysqli_num_rows($res) != 0) {
   echo "Existe otra ruta";
   $_SESSION['ruta_existe'] = false;
   return header("Location: ../public/usuario/crear_ruta.php");
}

$usuario_sesion = $_SESSION['id_cliente'];

$result1 = mysqli_query($conn, "INSERT INTO ruta (id_usuario, nombre_ruta, descripcion, lugar_principal, costo, actividad_1, actividad_2, hotel)
   VALUES ('$usuario_sesion', '$nombre_ruta_upper', '$descripcion', '$lugar_principal', '$costo', '$actividad_1', '$actividad_2', '$hotel');")
   or die (mysqli_error($conn));
$_SESSION['id_ruta'] = mysqli_insert_id($conn);
$id_ruta = $_SESSION['id_ruta'];
$result2  = mysqli_query($conn, "INSERT INTO comentario (id_ruta, id_usuario, comentario, calificacion)
   VALUES ('$id_ruta', '$usuario_sesion', '$comentario', '$calificacion');")
   or die (mysqli_error($conn));

$res_imagen1 = (new UploadApi())->upload($imagen_1, array("folder" => $id_ruta));
//"eager" => [["width" => 700, "height" => 700, "crop" => "pad"]]
$res_imagen2 = (new UploadApi())->upload($imagen_2, array("folder" => $id_ruta));
$rutaImagen1 = $res_imagen1['secure_url'];
$rutaImagen2 = $res_imagen2['secure_url'];

$result3  = mysqli_query($conn, "UPDATE ruta SET imagen_1 = '$rutaImagen1', imagen_2 = '$rutaImagen2' WHERE id_ruta = '$id_ruta';")
   or die (mysqli_error($conn));
$_SESSION['nombre_ruta'] = $nombre_ruta;
$_SESSION['ruta_existe'] = true;
header("Location: ../public/usuario/crear_punto.php");
mysqli_free_result($result1);
mysqli_free_result($result2);
mysqli_free_result($result3);
mysqli_close($conn); 
?>