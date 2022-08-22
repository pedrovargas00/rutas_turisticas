<?php
include("../db/database.php");
include("sesion.php");
include("../cloudinary/config.php");
use Cloudinary\Api\Admin\AdminApi;

$id = $_GET['resultado'];

$result = mysqli_query($conn, "SELECT id_ruta FROM ruta WHERE id_usuario = '$id'")
	or die (mysqli_error($conn));
while ($row = mysqli_fetch_array($result)) {
	$id_ruta = $row['id_ruta'];
	$res = (new AdminApi())->deleteAssetsByPrefix($id_ruta);
	// $result1 = mysqli_query($conn, "SELECT id_punto FROM punto WHERE id_ruta = '$id_ruta'")
	// 	or die (mysqli_error($conn));
	// while ($row = mysqli_fetch_array($result1)) {
	// 	$subFolder = $row['id_punto'];
	// 	$res = (new AdminApi())->deleteAssetsByPrefix($id_ruta."/".$subFolder);
	// }
	$res = (new AdminApi())->deleteFolder($id_ruta);
}

$result2 = mysqli_query($conn, "DELETE FROM ruta WHERE id_usuario = '$id'")
	or die (mysqli_error($conn));

$result = mysqli_query($conn, "DELETE FROM usuario WHERE id_usuario = '$id'")
	or die (mysqli_error($conn));
$_SESSION['usuario_eliminado'] = true;
header("Location: ../public/admin/resultados_usuario.php");
?>