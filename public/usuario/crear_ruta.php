<!DOCTYPE HTML>
<!--
	Traveler by freehtml5.co
	Twitter: http://twitter.com/fh5co
	URL: http://freehtml5.co
-->
<html>
	<?php include("../include/head_menu.php");
	include ("../../helpers/sesion.php");?>

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
					<?php
					// echo $_SESSION['ruta_existe'];
					if (isset($_SESSION['ruta_existe']) && $_SESSION['ruta_existe'] == false) {
						echo '<div class="alert alert-danger">';
						echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
						echo '<strong>Error: </strong>El nombre de la ruta ya existe en tu perfil</div>';
						unset($_SESSION['ruta_existe']);
					} ?>
					<h3>Crear ruta</h3>
					<form action="../../helpers/ruta.php" method="post" enctype="multipart/form-data">
						<div class="row form-group">
							<div class="col-md-12">
								<input type="text" name="nombre" class="form-control" placeholder="Ingrese el nombre de la ruta (20 caracteres)" onKeyUp="return limitar(event, this.value, 20)" onKeyDown="return limitar(event, this.value, 20)" required>
							</div>		
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<textarea name="descripcion" cols="30" rows="10" class="form-control" placeholder="Ingrese la descripción de la ruta (250 caracteres)" onKeyUp="return limitar(event, this.value, 255)" onKeyDown="return limitar(event, this.value, 255)" required></textarea>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<input type="text" name="lugar" class="form-control" placeholder="Ingrese la localización de la ruta (25 caracteres)" onKeyUp="return limitar(event, this.value, 25)" onKeyDown="return limitar(event, this.value, 25)" required>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<label>Imágenes</label>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<input type="file" name="imagen1" accept="image/*" class="form-control" required>
								<input type="file" name="imagen2" accept="image/*" class="form-control" required>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<input type="number" name="costo" class="form-control" placeholder="Inserte el costo total de la ruta" required>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<label>Actividades</label>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<textarea name="actividad1" cols="30" rows="5" class="form-control" placeholder="Ingrese una actividad relevante para la ruta (200 caracteres)" onKeyUp="return limitar(event, this.value, 255)" onKeyDown="return limitar(event, this.value, 255)" required></textarea>
								<textarea name="actividad2" cols="30" rows="5" class="form-control" placeholder="Ingrese una actividad relevante para la ruta (200 caracteres)" onKeyUp="return limitar(event, this.value, 255)" onKeyDown="return limitar(event, this.value, 255)" required></textarea>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<input type="text" name="hotel" class="form-control" placeholder="Ingrese el nombre del hotel recomendado" required>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<label>Comentario y calificación</label>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<p class="clasificacion">
									<!--Utilizar checked para seleccionar el valor predeterminado-->
									<input id="radio1" type="radio" name="estrellas" value="5" required>
									<label for="radio1">★</label>
									<input id="radio2" type="radio" name="estrellas" value="4">
									<label for="radio2">★</label>
									<input id="radio3" type="radio" name="estrellas" value="3">
									<label for="radio3">★</label>
									<input id="radio4" type="radio" name="estrellas" value="2">
									<label for="radio4">★</label>
									<input id="radio5" type="radio" name="estrellas" value="1">
									<label for="radio5">★</label>
								</p>
								<textarea name="comentario" cols="30" rows="5" class="form-control" placeholder="Ingrese un comentario de esta ruta" required></textarea>
							</div>
						</div>
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

