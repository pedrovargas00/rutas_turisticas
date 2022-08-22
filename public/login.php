<!DOCTYPE HTML>
<!--
	Traveler by freehtml5.co
	Twitter: http://twitter.com/fh5co
	URL: http://freehtml5.co
-->
<html>
	<?php include("include/head.php");
	session_start();?>

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
						<li><a href="index.php">Inicio</a></li>
						<li><a href="login.php" class="current">Iniciar Sesión</a></li>
						<li><a href="registro.php">Registro</a></li>
						<li><a href="resultados.php">Consultar Rutas</a></li>
						<li><a href="contacto.php">Contacto</a></li>
					</ul>	
				</div>
			</div>
		</div>
	</nav>
	
	<header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner" style="background-image: url(images/img_bg_2.jpg)">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-left">
					<div class="row row-mt-15em">
						<div class="col-md-8 col-md-push-2 animate-box" data-animate-effect="fadeInRight">
							<div class="form-wrap">
								<div class="tab">
									<div class="tab-content">
										<div class="tab-content-inner active" data-content="signup">
											<h3>Iniciar sesión</h3>
											<form action="../helpers/login.php" method="POST">
												<div class="row form-group">
													<div class="col-md-20">
														<input type="text" name="usuario"
														placeholder="Ingrese el nombre de usuario" class="form-control" required></div>
													<div class="col-md-20">
														<input type="password" name="password"
														placeholder="Ingrese la contraseña"	class="form-control" required></div>
													<div class="col-md-20">
														<a href="recuperarContrasena.php" name="usuario" style="text-align: center;">Recuperar contraseña</a></div>
												</div>
												<div class="row form-group">
													<div class="col-md-20">
														<input type="submit" class="btn btn-primary btn-block" value="Enviar">
													</div>
												</div>
											</form>
											<?php
											if (isset($_SESSION['activa']) && $_SESSION['activa'] == false) {
												echo '<div class="alert alert-danger">';
												echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
												echo '<strong>Error: </strong>Los datos son incorrectos</div>';
												unset($_SESSION['activa']);
											} ?>
											</div>
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
	
	<?php include("include/footer.php");?>
	</body>
</html>

