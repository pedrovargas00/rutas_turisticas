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
					<div id="gtco-logo"><a href="../index.php">Traveler <em>.</em></a></div>
				</div>
				<div class="col-xs-8 text-right menu-1">
					<ul>
						<li><a href="../index.php">Inicio</a></li>
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
											<h3>Recuperar contraseña</h3>
											<form action="../helpers/recuperar.php" method="POST">
												<div class="row form-group">
													<div class="col-md-20">
														<input type="text" name="correo"
														placeholder="Ingrese el correo registrado en su cuenta" class="form-control" required></div>
												</div>
												<div class="row form-group">
													<div class="col-md-20">
														<input type="submit" class="btn btn-primary btn-block" value="Enviar">
													</div>
												</div>
											</form>
											<?php
											if (isset($_SESSION['correo_existe']) && $_SESSION['correo_existe'] == false) {
												echo '<div class="alert alert-danger">';
												echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
												echo '<strong>Error: </strong>El correo no está registrado en el sistema</div>';
												unset($_SESSION['correo_existe']);
											}
											if (isset($_SESSION['correo_existe']) && $_SESSION['correo_existe'] == true) {
												echo '<div class="alert alert-success">';
												echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
												echo '<strong>Éxito: </strong>Se le ha enviado un email con la contraseña</div>';
												unset($_SESSION['correo_existe']);
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

