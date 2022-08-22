<?php 
include("../db/database.php");
include("sesion.php");
include("../cloudinary/config.php");
use Cloudinary\Api\Admin\AdminApi;

$id = $_GET['resultado'];

$result = mysqli_query($conn, "SELECT id_ruta FROM ruta WHERE id_ruta = '$id'")
	or die (mysqli_error($conn));
$row = mysqli_fetch_array($result);
$folder = $row['id_ruta'];
$res = (new AdminApi())->deleteAssetsByPrefix($folder);

// $result1 = mysqli_query($conn, "SELECT id_punto FROM punto WHERE id_ruta = '$id'")
// 	or die (mysqli_error($conn));
// while ($row = mysqli_fetch_array($result1)) {
// 	$subFolder = $row['id_punto'];
// 	$res = (new AdminApi())->deleteAssetsByPrefix($folder."/".$subFolder);
// }
$res = (new AdminApi())->deleteFolder($folder);

$result2 = mysqli_query($conn, "DELETE FROM ruta WHERE id_ruta = '$id'")
	or die (mysqli_error($conn));
$_SESSION['ruta_eliminada'] = true;
header("Location: ../public/usuario/resultados_propios.php");
?>