<!DOCTYPE HTML>
<!--
	Traveler by freehtml5.co
	Twitter: http://twitter.com/fh5co
	URL: http://freehtml5.co
-->
<html>
	<?php include("include/head.php"); ?>

	<body>
	<div class="gtco-loader"></div>
	<div id="page">
	<!-- <div class="page-inner"> -->
	<nav class="gtco-nav" role="navigation">
		<div class="gtco-container">
			<div class="row">
				<div class="col-sm-4 col-xs-12">
					<div id="gtco-logo"><a href="index.php">Traveler <em>.</em></a></div>
				</div>
				<div class="col-xs-8 text-right menu-1">
					<ul>
						<li><a href="index.php" class="current">Inicio</a></li>
						<li><a href="public/login.php">Iniciar Sesión</a></li>
						<li><a href="public/registro.php">Registro</a></li>
						<li><a href="public/resultados.php">Consultar Rutas</a></li>
						<li><a href="public/contacto.php">Contacto</a></li>
					</ul>	
				</div>
			</div>
		</div>
	</nav>
	
	<header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner" style="background-image: url(public/images/img_bg_2.jpg)">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-15 col-md-offset-0 text-left">
					<div class="row row-mt-15em">
						<div class="col-md-6 mt-text animate-box" data-animate-effect="fadeInUp">
							<h1>¿Planeando vacacionar?</h1>	
						</div>
						<div class="col-md-5 col-md-push-1 animate-box" data-animate-effect="fadeInRight">
							<div class="form-wrap">
								<div class="tab">
									<div class="tab-content">
										<div class="tab-content-inner active" data-content="signup">
											<h3>Buscar ruta turística</h3>
											<form action="public/resultados.php" method="POST">
												<div class="row form-group">
													<div class="col-md-20">
														<input type="text" name="buscar"
														placeholder="Ingrese el nombre de la ruta o el lugar donde se encuentra"
														class="form-control">
													</div>
												</div>
												<div class="row form-group">
													<div class="col-md-20">
														<input type="submit" class="btn btn-primary btn-block" value="Enviar">
													</div>
												</div>
											</form>	
										</div>		
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	
	<div class="gtco-section">
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
					<h2>Rutas Ingresadas</h2>
					<p>Estas son algunas rutas registradas por los usuarios.</p>
					<?php 
					include("db/databaseRoot.php");

					$result = mysqli_query($conn, "SELECT * FROM ruta LIMIT 3")
						or die (mysqli_error($conn));
					$row = mysqli_fetch_array($result);
					$imagen_2 = $row['imagen_2'];
					$nombre_ruta = $row['nombre_ruta'];
					$lugar = $row['lugar_principal'];
					?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-6">
					<a href=<?php echo $imagen_2; ?> class="fh5co-card-item image-popup">
						<figure>
							<div class="overlay"><i class="ti-plus"></i></div>
							<img src=<?php echo $imagen_2; ?> alt="Image" class="img-responsive">
						</figure>
						<div class="fh5co-text">
							<h2><?php echo $nombre_ruta; ?></h2>
							<p><?php echo $lugar; ?></p>
						</div>
					</a>
				</div>
				<?php
				$row = mysqli_fetch_array($result);
				$imagen_2 = $row['imagen_2'];
				$nombre_ruta = $row['nombre_ruta'];
				$lugar = $row['lugar_principal'];
				?>
				<div class="col-lg-4 col-md-4 col-sm-6">
					<a href=<?php echo $imagen_2; ?> class="fh5co-card-item image-popup">
						<figure>
							<div class="overlay"><i class="ti-plus"></i></div>
							<img src=<?php echo $imagen_2; ?> alt="Image" class="img-responsive">
						</figure>
						<div class="fh5co-text">
							<h2><?php echo $nombre_ruta; ?></h2>
							<p><?php echo $lugar; ?></p>
						</div>
					</a>
				</div>
				<?php
				$row = mysqli_fetch_array($result);
				$imagen_2 = $row['imagen_2'];
				$nombre_ruta = $row['nombre_ruta'];
				$lugar = $row['lugar_principal'];
				?>
				<div class="col-lg-4 col-md-4 col-sm-6">
					<a href=<?php echo $imagen_2; ?> class="fh5co-card-item image-popup">
						<figure>
							<div class="overlay"><i class="ti-plus"></i></div>
							<img src=<?php echo $imagen_2; ?> alt="Image" class="img-responsive">
						</figure>
						<div class="fh5co-text">
							<h2><?php echo $nombre_ruta; ?></h2>
							<p><?php echo $lugar; ?></p>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
	
	<div id="gtco-features">
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading animate-box">
					<h2>¿Cómo funciona?</h2>
					<p>A continuación, se muestran los pasos para crear tus rutas turísticas favoritas.</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 col-sm-6">
					<div class="feature-center animate-box" data-animate-effect="fadeIn">
						<span class="icon">
							<i>1</i>
						</span>
						<h3>Regístrate o inicia sesión</h3>
						<p>En el menú, encontrarás los accesos para crear tu cuenta o iniciar sesión.</p>
					</div>
				</div>
				<div class="col-md-4 col-sm-6">
					<div class="feature-center animate-box" data-animate-effect="fadeIn">
						<span class="icon">
							<i>2</i>
						</span>
						<h3>Ingresa a la opción en tu menú</h3>
						<p>Una vez iniciada la sesión, selecciona la opción del menú para crear la ruta</p>
					</div>
				</div>
				<div class="col-md-4 col-sm-6">
					<div class="feature-center animate-box" data-animate-effect="fadeIn">
						<span class="icon">
							<i>3</i>
						</span>
						<h3>Agrega la información</h3>
						<p>Anexa imágenes, comentarios, hoteles, entre otros a tu ruta turística para que todo el mundo la conozca.</p>
					</div>
				</div>
				<div class="col-md-4 col-sm-6">
					<div class="feature-center animate-box" data-animate-effect="fadeIn">
						<span class="icon">
							<i>4</i>
						</span>
						<h3>Publícala</h3>
						<p>Comparte la creada con otros usuarios o tus amigos y así puedan vivir la misma experiencia.</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="gtco-counter" class="gtco-section">
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading animate-box">
					<h2>Cifras</h2>
					<p>Estas son algunas cifras que se han logrado en esta página</p>
				</div>
			</div>
			<?php include("db/databaseRoot.php");
			
			$r1 = mysqli_query($conn, "SELECT id_ruta FROM ruta")
				or die (mysqli_error($conn));
			$r2 = mysqli_query($conn, "SELECT id_punto FROM punto")
				or die (mysqli_error($conn));
			$r3 = mysqli_query($conn, "SELECT id_usuario FROM usuario")
				or die (mysqli_error($conn));
			$r4 = mysqli_query($conn, "SELECT id_comentario FROM comentario")
				or die (mysqli_error($conn));
			
			$rutas = mysqli_num_rows($r1);
			$puntos = mysqli_num_rows($r2);
			$usuarios = mysqli_num_rows($r3);
			$comentarios = mysqli_num_rows($r4);
			?>
			<div class="row">
				<div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInUp">
					<div class="feature-center">
						<span class="counter js-counter" data-from="0" data-to=<?php echo $rutas; ?> data-speed="3000" data-refresh-interval="50">1</span>
						<span class="counter-label">Rutas</span>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInUp">
					<div class="feature-center">
						<span class="counter js-counter" data-from="0" data-to=<?php echo $puntos; ?> data-speed="3000" data-refresh-interval="50">1</span>
						<span class="counter-label">Puntos</span>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInUp">
					<div class="feature-center">
						<span class="counter js-counter" data-from="0" data-to=<?php echo $usuarios; ?> data-speed="3000" data-refresh-interval="50">1</span>
						<span class="counter-label">Usuarios</span>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInUp">
					<div class="feature-center">
						<span class="counter js-counter" data-from="0" data-to=<?php echo $comentarios; ?> data-speed="3000" data-refresh-interval="50">1</span>
						<span class="counter-label">Comentarios</span>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include("include/footer.php");?>
	</body>
</html>

