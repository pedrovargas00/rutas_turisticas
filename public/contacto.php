<!DOCTYPE HTML>
<!--
	Traveler by freehtml5.co
	Twitter: http://twitter.com/fh5co
	URL: http://freehtml5.co
-->
<html>
	<?php include("include/head.php");?>

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
						<li><a href="login.php">Iniciar Sesión</a></li>
						<li><a href="registro.php">Registro</a></li>
						<li><a href="resultados.php">Consultar Rutas</a></li>
						<li><a href="contacto.php" class="current">Contacto</a></li>
					</ul>	
				</div>
			</div>
		</div>
	</nav>
	
	<header id="gtco-header" class="gtco-cover gtco-cover-sm" role="banner" style="background-image: url(images/img_bg_3.jpg)">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-left">
					<div class="row row-mt-15em">
						<div class="col-md-7 mt-text animate-box" data-animate-effect="fadeInUp">
							<span class="intro-text-small">Si tienes dudas o sugerencias, contáctanos</span>
							<h1>Contacto</h1>	
						</div>
					</div>	
				</div>
			</div>
		</div>
	</header>
	
	
	<div class="gtco-section border-bottom">
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12">
					<div class="col-md-6 animate-box">
					<h3>Ingresa tus datos</h3>
					<form action="../helpers/datosContacto.php">
						<div class="row form-group">
							<div class="col-md-12">
								<input type="text" id="nombre" class="form-control" placeholder="Nombre Completo">
							</div>		
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<input type="email" id="email" class="form-control" placeholder="Correo Electrónico">
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<input type="text" id="asunto" class="form-control" placeholder="Asunto del mensaje">
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<textarea name="message" id="mensaje" cols="30" rows="10" class="form-control" placeholder="Escriba el mensaje"></textarea>
							</div>
						</div>
						<div class="form-group">
							<input type="submit" value="Enviar Mensaje" class="btn btn-primary">
						</div>
					</form>		
				</div>
				<div class="col-md-5 col-md-push-1 animate-box">	
					<div class="gtco-contact-info">
						<h3>información de contacto</h3>
						<ul>
							<li class="address">198 West 21th Street, <br> Suite 721 New York NY 10016</li>
							<li class="phone"><a href="tel://1234567920">+ 1235 2355 98</a></li>
							<li class="email"><a href="mailto:contacto@rutasturisticas.com">contacto@rutasturisticas.com</a></li>
							<li class="url"><a href="https://x.com">x.com</a></li>
						</ul>
					</div>
				</div>
				</div>
			</div>
		</div>
	</div>

	<?php include("include/footer.php");?>
	</body>
</html>

