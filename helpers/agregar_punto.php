<?php
include("sesion.php");
include("../db/database.php");
require("../vendor/autoload.php");
include("../cloudinary/config.php");
use Cloudinary\Api\Upload\UploadApi;

$id_ruta = $_REQUEST['ruta'];
$nombre_punto = $_REQUEST['nombre'];
$descripcion = $_REQUEST['descripcion'];
$localizacion = $_REQUEST['lugar'];
$imagen = $_FILES['imagen']['tmp_name'];
$actividad = $_REQUEST['actividad'];

$nombre_punto_upper = mb_strtoupper($nombre_punto);

$res = mysqli_query($conn, "SELECT id_punto FROM punto WHERE id_ruta = '$id_ruta' AND nombre_punto = '$nombre_punto_upper';")
  or die (mysqli_error($conn));
// print_r($res);
// echo " ----- ".mysqli_num_rows($res);
if (mysqli_num_rows($res) != 0){
  $_SESSION['punto_existe'] = false;
  return header("Location: ../public/usuario/crear_punto.php");
}

$result = mysqli_query($conn, "INSERT INTO punto (id_ruta, nombre_punto, localizacion, descripcion, actividad)
  VALUES('$id_ruta', '$nombre_punto_upper', '$localizacion', '$descripcion', '$actividad');")
  or die (mysqli_error($conn));

$id_punto = mysqli_insert_id($conn);
$res_imagen = (new UploadApi())->upload($imagen, array("folder" => $id_ruta."/".$id_punto));
$rutaImagen = $res_imagen['secure_url'];

$result2  = mysqli_query($conn, "UPDATE punto SET imagen = '$rutaImagen' WHERE id_punto = '$id_punto';")
   or die (mysqli_error($conn));
$_SESSION['punto_existe'] = true;

header("Location: ../public/usuario/resultados_propios.php");
mysqli_free_result($result); 
mysqli_free_result($result2);
mysqli_close($conn); 
?>