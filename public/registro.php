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
						<li><a href="login.php">Iniciar Sesión</a></li>
						<li><a href="registro.php" class="current">Registro</a></li>
						<li><a href="resultados.php">Consultar Rutas</a></li>
						<li><a href="contacto.php">Contacto</a></li>
					</ul>	
				</div>
			</div>
		</div>
	</nav>
	
	<header id="gtco-header" class="gtco-cover gtco-cover-sm" role="banner" style="background-image: url(images/img_bg_3.jpg); height: 90px;">
		<div class="overlay"></div>	
	</header>
	
	<div class="gtco-section border-bottom">
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12">
					<div class="col-md-6 animate-box">
					<h3>Registro</h3>
					<form action="../helpers/registro.php" method="post">
						<div class="row form-group">
							<div class="col-md-12">
								<input type="text" name="nombre" class="form-control" placeholder="Nombre completo" required>
							</div>		
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<input type="text" name="usuario" class="form-control" placeholder="Nombre de usuario" required>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<input type="email" name="correo" class="form-control" placeholder="Correo electrónico (gmail u outlook)" required>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<input type="password" name="password" class="form-control" placeholder="Contraseña" required>
							</div>
						</div>
						<div class="form-group">
							<input type="submit" value="Enviar" class="btn btn-primary">
						</div>
					</form>
					<?php
					if (isset($_SESSION['registro']) && $_SESSION['registro'] == false) {
						echo '<div class="alert alert-danger">';
						echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
						echo '<strong>Error: </strong>Los datos ya han sido registrados o el correo no es válido</div>';
						unset($_SESSION['registro']);
					} ?>	
				</div>
			</div>
		</div>
	</div>
</div>
	<?php include("include/footer.php");?>
	</body>
</html>

