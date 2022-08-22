<!DOCTYPE HTML>
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
	
	<header id="gtco-header" class="gtco-cover gtco-cover-sm" role="banner" style="background-image: url(../images/img_bg_3.jpg); height: 90px;">
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
	<section id = "fondo-rutas">
		<div class="gtco-section border-bottom">
			<div class="gtco-container">
				<!--Ruta principal-->
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-2">
						</div>
						<div class="col-md-8">
							<div class="col-md-12 animate-box" style="text-align: center">
								<h3>Nombre completo</h3>
								<p style="font-size: 17px;"><?php echo $nombre; ?></p>
								<h3>Usuario</h3>
								<p style="font-size: 17px;"><?php echo $usuario; ?></p>
								<br><br>
								<div class="col-md-12">
									<h3>Correo</h3>
									<p style="font-size: 17px;"><?php echo $correo; ?></p>
									<h3>Contraseña</h3>
									<p style="font-size: 17px;"><?php echo $contrasenia; ?></p>
									<br>
									<h3>Fecha de registro</h3>
									<p style="font-size: 17px;"><?php echo $fecha_registro; ?></p>
									<br><br>
								</div>
								<?php
								if ($tipo_usuario == 1)
									echo '<div class="col-md-12" style="font-size: 17px;"> <p>Es usuario de la plataforma</p> </div>';
								else
									echo '<div class="col-md-12" style="font-size: 17px;"> <p>Es administrador la plataforma</p> </div>';
								?>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<hr>
	<?php include("../include/footer_menu.php");?>
	</body>
</html>

