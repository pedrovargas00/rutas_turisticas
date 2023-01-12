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
	
	<header id="gtco-header" class="gtco-cover gtco-cover-sm" role="banner" style="background-image: url(../images/img_bg_3.jpg); height: 90px;">
		<div class="overlay"></div>	
	</header>
	<?php
	//include("../helpers/sesion.php");
	include("../../db/databaseDeep.php");
	include("../../helpers/sesion.php");

	$id = $_GET['resultado'];
	$result = mysqli_query($conn, "SELECT * FROM ruta WHERE id_ruta = '$id'")
		or die (mysqli_error($conn));
	$row = mysqli_fetch_array($result);
	$id_usuario = $row['id_usuario'];
	$nombre_ruta = $row['nombre_ruta'];
	$descripcion = $row['descripcion'];
	$lugar_principal = $row['lugar_principal'];
	$imagen_1 = $row['imagen_1'];
	$imagen_2 = $row['imagen_2'];
	$costo = $row['costo'];
	$actividad_1 = $row['actividad_1'];
	$actividad_2 = $row['actividad_2'];
	$hotel = $row['hotel'];

	$result1 = mysqli_query($conn, "SELECT usuario FROM usuario WHERE id_usuario = '$id_usuario'")
		or die (mysqli_error($conn));
	$row = mysqli_fetch_array($result1);
	$usuario = $row['usuario'];
	?>
	<section  id = "fondo-rutas">
		<div class="gtco-section border-bottom">
			<div class="gtco-container">
				<!--Ruta principal-->
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-2">
						</div>
						<div class="col-md-8">
							<div class="col-md-12 animate-box" style="text-align: center">
								<h4>Creado por: <?php echo $usuario; ?></h4>
								<h1>Ruta: <?php echo $nombre_ruta; ?></h1>
								<div class="col-md-12" style="text-align: justify">
									<h3>Descripción</h3>
									<p><?php echo $descripcion; ?></p>
								</div>
								<div class="col-md-12">
									<h3>Localización:</h3>
									<p><?php echo $lugar_principal; ?></p>
									<h3>Imágenes</h3>
									<img src=<?php echo $imagen_1; ?> width="500">
									<hr>
									<img src=<?php echo $imagen_2; ?> width="500">
									<hr>
									<h4>Costo total de la ruta: $<?php echo $costo; ?>.00 MNX</h4>
									<h3>Actividades</h3>
								</div>
								<div class="col-md-12" style="text-align: justify">
									<h4>Actividad 1:</h4>
									<p><?php echo $actividad_1; ?></p>
									<h4>Actividad 2:</h4>
									<p><?php echo $actividad_2; ?></p>
								</div>
								<div class="col-md-12">
									<h4>Hotel: <?php echo $hotel; ?></h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section id = "fondo-rutas">
		<div class="border-bottom">
			<div class="gtco-container">
				<!--Puntos de ruta-->
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-2">
						</div>
						<div class="col-md-8">
							<!--Esto se repetirá por la cantidad de punto que haya-->
							<?php
								$result2 = mysqli_query($conn, "SELECT * FROM punto WHERE id_ruta = '$id'")
									or die (mysqli_error($conn));
								while ($row = mysqli_fetch_array($result2)) {
									$nombre_punto = $row['nombre_punto'];
									$localizacion = $row['localizacion'];
									$descripcion = $row['descripcion'];
									$actividad = $row['actividad'];
									$imagen = $row['imagen'];
							?>
							<div class="col-md-12 animate-box gtco-section" style="text-align: center">
								<div class="col-md-12">
									<h2>Punto de ruta: <?php echo $nombre_punto; ?></h2>
									<p>Localización: <?php echo $localizacion; ?></p>
								</div>
								<div class="col-md-12" style="text-align: justify">
									<h3>Descripción:</h3>
									<p><?php echo $descripcion; ?></p>
									<h3>Actividad:</h3>
									<p><?php echo $actividad; ?></p>
								</div>
								<div class="col-md-12">
									<h3>Imagen:</h3>
									<img src=<?php echo $imagen; ?> width="500">
								</div>
								<?php } ?>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section id="fondo-rutas">
		<div class="border-bottom">
			<div class="gtco-container">
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-2">
						</div>
						<div class="col-md-8">
							<div class="col-md-12 animate-box " style="text-align: center">
								<h2>Comentarios y calificaciones</h2>
								<?php
									$result3 = mysqli_query($conn, "SELECT * FROM comentario WHERE id_ruta = '$id'")
										or die (mysqli_error($conn));
									while ($row = mysqli_fetch_array($result3)) {
										$id_usuario_comentario = $row['id_usuario'];
										$comentario = $row['comentario'];
										$calificacion = $row['calificacion'];
								?>
								<!--Esto se repetirá por la cantidad de comentarios que haya-->
								<div class="col-md-12 gtco-puntos-comentarios" style="text-align: justify">
									<figure>
										<?php 
										if ($id_usuario_comentario == 0)
											echo '<span><h3 class="icon-user"> Nombre de usuario: Anónimo </h3></span>';
										else{
											$usr = mysqli_query($conn, "SELECT usuario FROM usuario WHERE id_usuario = '$id_usuario_comentario'")
											or die (mysqli_error($conn));
											$r = mysqli_fetch_array($usr);
											echo '<span><h3 class="icon-user"> Nombre de usuario: ';?><?php echo $r['usuario']; ?><?php echo ' </h3></span>';
										}
										?>
										<figcaption>
												<p> <?php echo $comentario; ?></p>
										</figcaption>
									</figure>
								</div>
								<div class="col-md-12">
									<?php
										switch ($calificacion) {
											case 5: 
												echo "<h2 style = 'text-align: right'><font color='orange'>★★★★★</font></h2>";
												break;
											case 4:
												echo "<h2 style = 'text-align: right'><font color='orange'>★★★★</font><font color='grey'>★</font></h2>";
												break;
											case 3:
												echo "<h2 style = 'text-align: right'><font color='orange'>★★★</font><font color='grey'>★★</font></h2>";
												break;
											case 2:
												echo "<h2 style = 'text-align: right'><font color='orange'>★★</font><font color='grey'>★★★</font></h2>";
												break;
											case 1:
												echo "<h2 style = 'text-align: right'><font color='orange'>★</font><font color='grey'>★★★★</font></h2>";
												break;
											default:
												echo "<h2 style = 'text-align: right'><font color='grey'>★★★★★</font></h2>";
										}
									?>
										<!-- <input id="radio1" type="radio" name="estrellas" value="5">
										<label for="radio1">★</label> 
										<input id="radio2" type="radio" name="estrellas" value="4">
										<label for="radio2">★</label>
										<input id="radio3" type="radio" name="estrellas" value="3">
										<label for="radio3">★</label>
										<input id="radio4" type="radio" name="estrellas" value="2">
										<label for="radio4">★</label>
										<input id="radio5" type="radio" name="estrellas" value="1">
										<label for="radio5">★</label> -->
								</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<hr>
	<section>
		<div class="border-bottom">
			<div class="gtco-container">
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-2">
						</div>
						<div class="col-md-8">
							<div class="col-md-12 animate-box " style="text-align: center">
								<h2>Ingrese su comentario y calificación</h2>
								<form action="../../helpers/guardar_comentario.php" method="POST">
									<input type="hidden" name="formulario" value="formUsuario">
									<input type="hidden" name="id_usuario" value=<?php echo $_SESSION['id_cliente']; ?>>
									<input type="hidden" name="id_ruta" value=<?php echo $id; ?>>
									<div class="row form-group">
										<div class="col-md-12">
											<p class="clasificacion">
												<!--Utilizar checked para seleccionar el valor predeterminado-->
												<input id="radio6" type="radio" name="estrellas" value="5" required>
												<label for="radio6">★</label>
												<input id="radio7" type="radio" name="estrellas" value="4">
												<label for="radio7">★</label>
												<input id="radio8" type="radio" name="estrellas" value="3">
												<label for="radio8">★</label>
												<input id="radio9" type="radio" name="estrellas" value="2">
												<label for="radio9">★</label>
												<input id="radio10" type="radio" name="estrellas" value="1">
												<label for="radio10">★</label>
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
		</div>
	</section>
	<?php include("../include/footer_menu.php");?>
	</body>
</html>

