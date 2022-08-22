<?php
include("sesion.php");
include("../db/database.php");
require("../vendor/autoload.php");
include("../cloudinary/config.php");
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Api\Admin\AdminApi;

$id = $_REQUEST['id'];
$nombre_ruta = $_REQUEST['nombre'];
$descripcion = $_REQUEST['descripcion'];
$lugar_principal = $_REQUEST['lugar'];
$imagen_1 = $_FILES['imagen1']['tmp_name'];
$imagen_2 = $_FILES['imagen2']['tmp_name'];
$costo = $_REQUEST['costo'];
$actividad_1 = $_REQUEST['actividad1'];
$actividad_2 = $_REQUEST['actividad2'];
$hotel = $_REQUEST['hotel'];
$ids = $_REQUEST['ids'];
// print_r($ids);
$nombre_ruta_upper = mb_strtoupper($nombre_ruta);
$id_usuario = $_SESSION['id_cliente'];

$res = mysqli_query($conn, "SELECT id_ruta FROM ruta WHERE nombre_ruta = '$nombre_ruta_upper' AND id_ruta != '$id' AND id_usuario = '$id_usuario';")
   or die (mysqli_error($conn));

if (mysqli_num_rows($res) != 0){
   $_SESSION['ruta_editar_existe'] = false;
   return header("Location: ../public/usuario/editar_ruta.php?resultado=$id");
}

if (!empty($imagen_1) && !empty($imagen_2)){
   $resImage = (new AdminApi())->deleteAssetsByPrefix($id);
   $res_imagen1 = (new UploadApi())->upload($imagen_1, array("folder" => $id));
   $rutaImagen1 = $res_imagen1['secure_url'];
   $res_imagen2 = (new UploadApi())->upload($imagen_2, array("folder" => $id));
   $rutaImagen2 = $res_imagen2['secure_url'];
   $result1 = mysqli_query($conn, "UPDATE ruta SET nombre_ruta='$nombre_ruta', descripcion='$descripcion', lugar_principal='$lugar_principal', 
      imagen_1='$rutaImagen1', imagen_2='$rutaImagen2', costo='$costo', actividad_1='$actividad_1', actividad_2='$actividad_2', hotel='$hotel'
      WHERE id_ruta = '$id';")
   or die (mysqli_error($conn));
} else
   $result1 = mysqli_query($conn, "UPDATE ruta SET nombre_ruta='$nombre_ruta', descripcion='$descripcion', lugar_principal='$lugar_principal',
      costo='$costo', actividad_1='$actividad_1', actividad_2='$actividad_2', hotel='$hotel'
      WHERE id_ruta = '$id';")
   or die (mysqli_error($conn));
$_SESSION['ruta_editar_existe'] = true;
mysqli_close($conn);
header("Location: ../public/usuario/editar_punto.php?resultado=$ids");
?>