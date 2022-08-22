<?php
include("sesion.php");
include("../db/database.php");
require("../vendor/autoload.php");
include("../cloudinary/config.php");
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Api\Admin\AdminApi;

$id = $_REQUEST['id_punto'];
$id_ruta = $_REQUEST['id_ruta'];
$nombre_punto = $_REQUEST['nombre'];
$descripcion = $_REQUEST['descripcion'];
$localizacion = $_REQUEST['lugar'];
$imagen = $_FILES['imagen']['tmp_name'];
$actividad = $_REQUEST['actividad'];
$ids = $_REQUEST['ids'];
//print_r($ids);
$nombre_punto_upper = mb_strtoupper($nombre_punto);

$res = mysqli_query($conn, "SELECT id_punto FROM punto WHERE nombre_punto = '$nombre_punto_upper' AND id_punto != '$id' AND id_ruta = '$id_ruta';")
   or die (mysqli_error($conn));

if (mysqli_num_rows($res) != 0)
   $_SESSION['punto_editar_existe'] = false;

if (isset($_SESSION['punto_existe']) && $_SESSION['punto_existe'] == false) {
   $ids = unserialize($_REQUEST['ids']);
   array_unshift($ids, $id);
   $new_ids = htmlspecialchars(serialize($ids));
   return header("Location: ../public/usuario/editar_punto.php?resultado=$ids");
}

if (!empty($imagen)){
   $resImage = (new AdminApi())->deleteAssetsByPrefix($id_ruta.$id);
   $res_imagen = (new UploadApi())->upload($imagen, array("folder" => $id_ruta."/".$id));
   $rutaImagen = $res_imagen['secure_url'];
   $result = mysqli_query($conn, "UPDATE punto SET nombre_punto='$nombre_punto', localizacion='$localizacion',
      descripcion='$descripcion', actividad='$actividad', imagen='$rutaImagen' WHERE id_punto = '$id';")
      or die (mysqli_error($conn));
} else
   $result = mysqli_query($conn, "UPDATE punto SET nombre_punto='$nombre_punto', localizacion='$localizacion',
      descripcion='$descripcion', actividad='$actividad' WHERE id_punto = '$id';")
      or die (mysqli_error($conn));
$_SESSION['punto_editar_existe'] = true;
mysqli_close($conn);
header("Location: ../public/usuario/editar_punto.php?resultado=$ids");
?>