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
					<div id="gtco-logo"><a href="indexUsuario.php">Traveler <em>.</em></a></div>
				</div>
				<div class="col-xs-8 text-right menu-1">
					<ul>
						<li><a href="indexUsuario.php">Inicio</a></li>
						<li><a href="crear_ruta.php" class="current">Crear Ruta</a></li>
						<li><a href="resultados_propios.php">Buscar Rutas Creadas</a></li>
						<li><a href="../../helpers/salir.php">Salir</a></li>
					</ul>	
				</div>
			</div>
		</div>
	</nav>
	
	<header id="gtco-header" class="gtco-cover gtco-cover-sm" role="banner" style="background-image: url(../images/img_bg_3.jpg); height: 90px;">
		<div class="overlay"></div>	
	</header>
	
	<div class="gtco-section border-bottom">
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12">
					<div class="col-md-6 animate-box" style="text-align: center">
					<h3>Editar ruta</h3>
					<?php
					if (isset($_SESSION['ruta_editar_existe']) && $_SESSION['ruta_editar_existe'] == false) {
						echo '<div class="alert alert-danger">';
						echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
						echo '<strong>Error: </strong>El nombre de la ruta ya existe en tu perfil</div>';
						unset($_SESSION['ruta_editar_existe']);
					} ?>
					<?php
					include("../../db/database.php");
					
					$id = $_GET['resultado'];
					$id_usuario = $_SESSION['id_cliente'];
					$result = mysqli_query($conn, "SELECT * FROM ruta WHERE id_ruta = '$id'")
						or die (mysqli_error($conn));
					
					$row = mysqli_fetch_array($result);
					$nombre_ruta = $row['nombre_ruta'];
					$descripcion = $row['descripcion'];
					$lugar_principal = $row['lugar_principal'];
					$imagen_1 = $row['imagen_1'];
					$imagen_2 = $row['imagen_2'];
					$costo = $row['costo'];
					$actividad_1 = $row['actividad_1'];
					$actividad_2 = $row['actividad_2'];
					$hotel = $row['hotel'];
					?>
					<form action="../../helpers/ruta_actualizar.php" method="post" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<div class="row form-group">
							<div class="col-md-12">
								<h4>Nombre de la ruta</h4>
								<input type="text" name="nombre" class="form-control" value="<?php echo $nombre_ruta; ?>" onKeyUp="return limitar(event, this.value, 25)" onKeyDown="return limitar(event, this.value, 25)" required>
							</div>		
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<h4>Descripción</h4>
								<textarea name="descripcion" cols="30" rows="10" class="form-control" onKeyUp="return limitar(event, this.value, 255)" onKeyDown="return limitar(event, this.value, 255)" required><?php echo $descripcion; ?></textarea>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<h4>Lugar principal de la ruta</h4>
								<input type="text" name="lugar" class="form-control" value="<?php echo $lugar_principal; ?>" required>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<h3>Imágenes</h3>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<input type="file" name="imagen1" accept="image/*" class="form-control">
								<input type="file" name="imagen2" accept="image/*" class="form-control">
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<h4>Costo total de la ruta</h4>
								<input type="number" name="costo" class="form-control" value="<?php echo $costo; ?>" required>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<h3>Actividades</h3>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<h4>Actividad 1</h4>
								<textarea name="actividad1" cols="30" rows="5" class="form-control" onKeyUp="return limitar(event, this.value, 255)" onKeyDown="return limitar(event, this.value, 255)" required><?php echo $actividad_1; ?></textarea>
								<h4>Actividad 2</h4>
								<textarea name="actividad2" cols="30" rows="5" class="form-control" onKeyUp="return limitar(event, this.value, 255)" onKeyDown="return limitar(event, this.value, 255)" required><?php echo $actividad_2; ?></textarea>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<h4>Nombre del hotel</h4>
								<input type="text" name="hotel" class="form-control" value="<?php echo $hotel; ?>" required>
							</div>
						</div>
						<?php
						include("../../db/database.php");
						
						$ids_puntos = array();
						$n = 0;
						$result1 = mysqli_query($conn, "SELECT * FROM punto WHERE id_ruta = '$id'")
							or die (mysqli_error($conn));

						while ($row = mysqli_fetch_array($result1)){
							$ids_puntos[$n] = $row['id_punto'];
							$n++;
						}
						?>
						<input type="hidden" name="ids" value="<?=htmlspecialchars(serialize($ids_puntos));?>">
						<div class="form-group">
							<input type="submit" value="Enviar" class="btn btn-primary">
						</div>
					</form>
				</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		// Funcion para limitar el numero de caracteres de un textarea o input
		// Tiene que recibir el evento, valor y número máximo de caracteres
		function limitar(e, contenido, caracteres) {
			// obtenemos la tecla pulsada
			var unicode=e.keyCode? e.keyCode : e.charCode;

			// Permitimos las siguientes teclas:
			// 8 backspace
			// 46 suprimir
			// 13 enter
			// 9 tabulador
			// 37 izquierda
			// 39 derecha
			// 38 subir
			// 40 bajar
			if(unicode==8 || unicode==46 || unicode==13 || unicode==9 || unicode==37 || unicode==39 || unicode==38 || unicode==40)
				return true;
			// Si ha superado el limite de caracteres devolvemos false
			if(contenido.length>=caracteres)
				return false;
			return true;
		}
   </script>
	<?php include("../include/footer_menu.php");?>
	</body>
</html>

