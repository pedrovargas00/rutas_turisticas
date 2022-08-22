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
						<li><a href="crear_ruta.php" class="current">Crear Ruta</a></li>
						<li><a href="resultados_propios.php">Consultar Rutas Creadas</a></li>
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
					<h3>Editar punto de ruta</h3>
					<?php
					if (isset($_SESSION['punto_editar_existe']) && $_SESSION['punto_editar_existe'] == false) {
						echo '<div class="alert alert-danger">';
						echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
						echo '<strong>Error: </strong>El nombre del punto ya existe en la ruta</div>';
						unset($_SESSION['punto_editar_existe']);
					}
					if (isset($_SESSION['punto_eliminado']) && $_SESSION['punto_eliminado'] == true) {
						echo '<div class="alert alert-success">';
						echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
						echo '<strong>Éxito: </strong>El punto ha sido eliminado</div>';
						unset($_SESSION['punto_eliminado']);
					} ?>
					<?php
					include("../../db/database.php");
					
					// $datos = unserialize($_REQUEST['ids']);
					// print_r($datos);
					$puntos = unserialize($_GET['resultado']);
					// print_r($puntos);
					// echo $puntos[0]."  ----   ";
					
					if (empty($puntos))
						header("Location: resultados_propios.php");
					$id_usuario = $_SESSION['id_cliente'];
					$id = $puntos[0];
					
					$result = mysqli_query($conn, "SELECT * FROM punto WHERE id_punto = '$id'")
						or die (mysqli_error($conn));

					$row = mysqli_fetch_array($result);
					$id_ruta = $row['id_ruta'];
					$nombre_punto = $row['nombre_punto'];
					$descripcion = $row['descripcion'];
					$localizacion = $row['localizacion'];
					$imagen = $row['imagen'];
					$actividad = $row['actividad'];
					array_shift($puntos);
					?>
					<form action="../../helpers/punto_actualizar.php" method="post" enctype="multipart/form-data">
						<input type="hidden" name="id_punto" value="<?php echo $id; ?>">
						<input type="hidden" name="id_ruta" value="<?php echo $id_ruta; ?>">
						<div class="row form-group">
							<div class="col-md-12">
								<h4>Nombre del punto</h4>
								<input type="text" name="nombre" class="form-control" value="<?php echo $nombre_punto; ?>" required>
							</div>		
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<h4>Localización del punto</h4>
								<input type="text" name="lugar" class="form-control" value="<?php echo $localizacion; ?>" onKeyUp="return limitar(event, this.value, 25)" onKeyDown="return limitar(event, this.value, 25)" required>
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
								<h3>Actividad</h3>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<textarea name="actividad" cols="30" rows="5" class="form-control" onKeyUp="return limitar(event, this.value, 255)" onKeyDown="return limitar(event, this.value, 255)" required><?php echo $actividad; ?></textarea>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<h3>Imagen</h3>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<input type="file" name="imagen" accept="image/*" class="form-control">
							</div>
						</div>
						<input type="hidden" name="ids" value="<?=htmlspecialchars(serialize($puntos));?>">
						<div class="form-group">
							<button type="submit" name="boton" class="btn btn-primary">Enviar</button>
						</div>
					</form>
					<button name="eliminar" onclick="location.href='../../helpers/eliminar_punto.php?ruta=<?php echo $id_ruta; ?>&punto=<?php echo $id; ?>&ids=<?=htmlspecialchars(serialize($puntos));?>'" class="btn btn-primary">Eliminar</button>
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

