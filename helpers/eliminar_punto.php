<?php 
include("../db/database.php");
include("sesion.php");
include("../cloudinary/config.php");
use Cloudinary\Api\Admin\AdminApi;

$id_punto = $_GET['punto'];
$id_ruta = $_GET['ruta'];
$ids = $_REQUEST['ids'];

$result = mysqli_query($conn, "SELECT id_punto FROM punto WHERE id_punto = '$id_punto'")
	or die (mysqli_error($conn));
$res = (new AdminApi())->deleteAssetsByPrefix($id_ruta."/".$id_punto);
$res = (new AdminApi())->deleteFolder($id_ruta."/".$id_punto);

$result2 = mysqli_query($conn, "DELETE FROM punto WHERE id_punto = '$id_punto'")
	or die (mysqli_error($conn));
$_SESSION['punto_eliminado'] = true;
header("Location: ../public/usuario/editar_punto.php?resultado=$ids");
?>