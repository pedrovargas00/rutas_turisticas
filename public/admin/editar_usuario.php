<!DOCTYPE HTML>
<!--
	Traveler by freehtml5.co
	Twitter: http://twitter.com/fh5co
	URL: http://freehtml5.co
-->
<html>
	<?php include("../include/head_menu.php");?>

	<body>
	<div class="gtco-loader"></div>
	<div id="page">
	<!-- <div class="page-inner"> -->
	<nav class="gtco-nav" role="navigation">
		<div class="gtco-container">
			<div class="row">
				<div class="col-sm-4 col-xs-12">
					<div id="gtco-logo"><a href="indexAdmin.php">Traveler <em>.</em></a></div>
				</div>
				<div class="col-xs-8 text-right menu-1">
					<ul>
						<li><a href="indexAdmin.php">Inicio</a></li>
						<li><a href="../../helpers/generar_reporte.php">Generar Reporte</a></li>
						<li><a href="resultados_usuario.php">Consultar Usuarios</a></li>
						<li><a href="../../helpers/salir.php">Salir</a></li>
					</ul>	
				</div>
			</div>
		</div>
	</nav>
	
	<header id="gtco-header" class="gtco-cover gtco-cover-sm" role="banner" style="background-image: url(images/img_bg_3.jpg); height: 90px;">
		<div class="overlay"></div>	
	</header>
	<?php
	//include("../helpers/sesion.php");
	include("../../db/database.php");
	include("../../helpers/sesion.php");

	$id = $_GET['resultado'];
	$result = mysqli_query($conn, "SELECT * FROM usuario WHERE id_usuario = '$id'")
		or die (mysqli_error($conn));
	while ($row = mysqli_fetch_array($result)) {
		$nombre = $row['nombre'];
		$usuario = $row['usuario'];
		$correo = $row['correo'];
		$fecha_registro = $row['fecha_registro'];
		$contrasenia = $row['contrasenia'];
		$tipo_usuario = $row['tipo_usuario'];
	?>
	<div class="gtco-section border-bottom">
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12">
					<div class="col-md-6 animate-box">
					<h3>Modificar usuario</h3>
					<?php 
					if (isset($_SESSION['usuario_existe']) && $_SESSION['usuario_existe'] == true) {
						echo '<div class="aalert alert-success">';
						echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
						echo '<strong>Error: </strong>Los datos han sido registrados en otro usuario</div>';
						unset($_SESSION['usuario_existe']);
					}
					?>
					<form action="../../helpers/usuario_actualizar.php" method="post">
						<input type="hidden" name="id_usuario" value=<?php echo $id; ?>>
						<div class="row form-group">
							<div class="col-md-12">
								<input type="text" name="nombre" class="form-control" value=<?php echo $nombre; ?> required>
							</div>		
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<input type="text" name="usuario" class="form-control" value=<?php echo $usuario; ?> required>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<input type="email" name="correo" class="form-control" value=<?php echo $correo; ?> required>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<input type="password" name="password" class="form-control" value=<?php echo $contrasenia; ?> required>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<input type="number" name="tipo_usuario" class="form-control" value=<?php echo $tipo_usuario; ?> required>
							</div>
						</div>
						<div class="form-group">
							<input type="submit" value="Enviar" class="btn btn-primary">
						</div>
					</form>
					<?php } ?>		
				</div>
			</div>
		</div>
	</div>
</div>

	<?php include("../include/footer_menu.php");?>
	</body>
</html>

