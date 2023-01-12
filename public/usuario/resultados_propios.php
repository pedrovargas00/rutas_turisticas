<!DOCTYPE HTML>
<!--
	Traveler by freehtml5.co
	Twitter: http://twitter.com/fh5co
	URL: http://freehtml5.co
-->
<html>
	<?php include("../include/head_menu.php");
	include("../../helpers/sesion.php"); ?>

	<body>
	<div class="gtco-loader"></div>
	<div id="page">
	<!-- <div class="page-inner"> -->
	<nav class="gtco-nav" role="navigation">
		<div class="gtco-container">
			<div class="row">
				<div class="col-sm-4 col-xs-12">
					<div id="gtco-logo"><a href="indexUsuario.php">Traveler <em>.</em></a></div>
				</div>
				<div class="col-xs-8 text-right menu-1">
					<ul>
						<li><a href="indexUsuario.php">Inicio</a></li>
						<li><a href="crear_ruta.php">Crear Ruta</a></li>
						<li><a href="resultados_propios.php">Consultar Rutas Creadas</a></li>
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
				if (isset($_SESSION['ruta_eliminada']) && $_SESSION['ruta_eliminada'] == true) {
					echo '<div class="alert alert-success">';
					echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					echo '<strong>Éxito: </strong>Ruta eliminada</div>';
					unset($_SESSION['ruta_eliminada']);
				}
				?>
				<?php
				include("../../db/databaseDeep.php");

				$id_usuario = $_SESSION['id_cliente'];
		
				$result = mysqli_query($conn, "SELECT id_ruta, nombre_ruta, imagen_1 FROM ruta WHERE id_usuario = '$id_usuario'")
					or die (mysqli_error($conn));
				
				while ($row = mysqli_fetch_array($result)) {
					$id = $row['id_ruta'];
					$nombre_ruta = $row['nombre_ruta'];
					$imagen_1 = $row['imagen_1'];
				?>
				<div class="col-lg-4 col-md-4 col-sm-6">
					<a href=<?php echo $imagen_1; ?> class="fh5co-card-item image-popup">
						<figure>
							<div class="overlay"><i class="ti-plus"></i></div>
							<img src=<?php echo $imagen_1; ?> alt="Image" class="img-responsive">
						</figure>
						<div class="fh5co-text">
							<h2><?php echo $nombre_ruta; ?></h2>
							<p><button name="editar" onclick="location.href='editar_ruta.php?resultado=<?php echo $id; ?>'" class="btn btn-primary">Editar</button>
							<button name="eliminar" onclick="location.href='../../helpers/eliminar_ruta.php?resultado=<?php echo $id; ?>'" class="btn btn-primary">Eliminar</button>
							<button name="ver" onclick="location.href='mostrar_ruta.php?resultado=<?php echo $id; ?>'" class="btn btn-primary">Ver</button>
							<button name="ver" onclick="location.href='agregar_punto.php?ruta=<?php echo $id; ?>'" class="btn btn-primary">Agregar Punto</button></p>
						</div>
					</a>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<?php include("../include/footer_menu.php");	?>
	</body>
</html>

