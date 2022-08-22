<!DOCTYPE HTML>
<!--
	Traveler by freehtml5.co
	Twitter: http://twitter.com/fh5co
	URL: http://freehtml5.co
-->
<html>
	<?php include("../include/head_menu.php");
	include("../../helpers/sesion.php");?>

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
	
	<header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner" style="background-image: url(../images/img_bg_2.jpg); height: 90px;">
		<div class="overlay"></div>
	</header>
	
	<div class="gtco-section">
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
					<p>Resultados de la búsqueda.</p>
				</div>
			</div>
			<div class="row">
				<?php 
				if (isset($_SESSION['usuario_eliminado']) && $_SESSION['usuario_eliminado'] == true) {
					echo '<div class="aalert alert-success">';
					echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					echo '<strong>Éxito: </strong>Usuario eliminado</div>';
					unset($_SESSION['usuario_eliminado']);
					unset($_SESSION['usuario_existe']);
				}
				?>
				<?php
				include("../../db/database.php");

				$result = mysqli_query($conn, "SELECT * FROM usuario")
					or die (mysqli_error($conn));
				
				while ($row = mysqli_fetch_array($result)) {
					$id = $row['id_usuario'];
					$nombre = $row['nombre'];
					$usuario = $row['usuario'];
					$correo = $row['correo'];
				?>
				<div class="col-lg-4 col-md-4 col-sm-6">
					<a href="#" class="fh5co-card-item image-popup">
						<div class="fh5co-text">
							<h2><?php echo $usuario; ?></h2>
							<p><?php echo $nombre; ?></p>
							<p><?php echo $correo; ?></p>
							<p><button name="editar" onclick="location.href='editar_usuario.php?resultado=<?php echo $id; ?>'" class="btn btn-primary">Editar</button>
							<button name="eliminar" onclick="location.href='../../helpers/eliminar_usuario.php?resultado=<?php echo $id; ?>'" class="btn btn-primary">Eliminar</button>
							<button name="ver" onclick="location.href='mostrar_usuario.php?resultado=<?php echo $id; ?>'" class="btn btn-primary">Ver</button></p>
						</div>
					</a>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<?php include("../include/footer_menu.php");?>
	</body>
</html>

