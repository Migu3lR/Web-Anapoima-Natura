<!DOCTYPE html>
<html lang="en"  class="no-js" >
<head>	
	<title>Natura Anapoima</title>
	<meta charset="utf-8">	
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900' rel='stylesheet' type='text/css'>
	<!-- Natura Wireframe -->
	<link rel="stylesheet" href="css/structure.css">
	<link rel="stylesheet" href="css/design.css">
	
</head>
<body >
	<script>
		$url=window.location.href;
		document.cookie = "returnUrl="+$url; 
	</script>	
	<?php
	session_start();
	$nombre = "";
	if(isset($_SESSION['nombre'])) {
		$nombre = $_SESSION['nombre'];
		setcookie('nombre', $nombre, time() + (86400 * 1), "/");
	}
	
	if(isset($_SESSION['apellido'])) setcookie('apellido', $_SESSION['apellido'], time() + (86400 * 1), "/");
	if(isset($_SESSION['telefono'])) setcookie('telefono', $_SESSION['telefono'], time() + (86400 * 1), "/");
	if(isset($_SESSION['correo'])) setcookie('correo', $_SESSION['correo'], time() + (86400 * 1), "/");
	if(isset($_SESSION['pais'])) setcookie('pais', $_SESSION['pais'], time() + (86400 * 1), "/");
	if(isset($_SESSION['ciudad'])) setcookie('ciudad', $_SESSION['ciudad'], time() + (86400 * 1), "/");
	
	
	$rol = "";
	if(isset($_SESSION['rol'])) $rol = $_SESSION['rol'];
	?>
	<div class="title-bar" data-responsive-toggle="main-menu" data-hide-for="large">
	  <button class="menu-icon" type="button" data-toggle></button>
	  <div class="title-bar-title">Menu</div>
	</div>

	<div class="top-bar sticky" id="main-menu">
	<div class="row column menu-wrap">
	<div class="callout large">
	  <div class="top-bar-left">
		<ul class="dropdown menu" data-dropdown-menu>
		  <li class="menu-text">
			<div class="logo-container" >
			  <a href="/"><img src="../images/booking/logo.png" alt="Natura Anapoima"> </a>
			</div>
		  </li>
		</ul>
	  </div>
	
	  <div class="top-bar-right">
			<div class="user">
				<p>
				<?php
				$cookie_name="returnUrl";
				if ($nombre != ""){
					echo "Bienvenido " . $nombre ;
				} else {
					//echo "<a href='../login/?returnUrl=$_COOKIE[$cookie_name]'>Inicia sesión en Natura!</a>";
					echo "<a href='../login/'>Inicia sesión en Natura!</a>";
				}
					
				?> 
				</p>
			</div>
		<ul class="menu vertical medium-horizontal" data-responsive-menu="drilldown medium-dropdown">
			<li><a id="item1" href="../index.php#inicio">INICIO</a></li>
			<li><a id="item2" href="../index.php#hospedaje">HOSPEDAJE</a></li>
			<li><a id="item3" href="../index.php#reservas">RESERVAS</a></li>
			<li><a id="item4" href="../index.php#servicios">SERVICIOS</a></li>
			<li><a id="item5" href="../index.php#galeria">GALERÍA</a></li>
			<li><a id="item6" href="../index.php#contacto">CONTACTO</a></li>
			<?php
			if($rol == "1"){
			?>			
				<li><a>ADMINISTRACIÓN</a>
					<ul class="menu">
					<li><a href="#">Clientes</a></li>
					<li><a href="bookAdmin.php">Reservaciones</a></li>
					<li><a href="../comentAdmin">Gestion de Comentarios</a></li>
					<li><a href="#">Códigos Promocionales</a></li>
					<li><a href="../login/logout.php">CERRAR SESIÓN</a></li>
					</ul>
				</li>
			<?php
			} elseif ($rol == "0") {
			?>
				<li><a>MI CUENTA</a>
					<ul class="menu">
					<li><a href="#">Portal de Usuario</a></li>
					<li><a href="../login/logout.php">CERRAR SESIÓN</a></li>
					</ul>
				</li>
			<?php
			}
			?>
		</ul>
	  </div>
	</div>
	</div>
	</div>
	<div id="inicio" style="height:5em"></div>
	<div style="max-width:900px">		
		<link href="bookAdmin.php?controller=pjFront&action=pjActionLoadCss&cid=1" type="text/css" rel="stylesheet" />		
		<script type="text/javascript" src="bookAdmin.php?controller=pjFront&action=pjActionLoad&cid=1"></script>	
	</div>
	<link rel="stylesheet" href="css/structure.css">
	<link rel="stylesheet" href="css/design.css">
	<footer class="sticky">
		<div class="row text-center small-up-1 medium-up-3 large-up-3">
		<div class="column">
			<p>Desarrollo y programación Web: <a href="http://hitbizz.com" target="blank"> hitbizz.com</a></p>
		</div>
		<div class="column">
			<p>Diseño Gráfico: <a href="http://mickerstudio.com" target="blank">mickerstudio.com</a></p>
		</div>
		<div class="column">
			<p>www.anapoimanatura.com · Todos los derechos reservados</p>
		</div>
	</div>
	</footer>
	
	<div id="separator"></div>
	<!-- Natura Core -->
    <script src="../js/vendor/jquery.min.js"></script>
    <script src="../js/vendor/what-input.min.js"></script>
		<script src="../js/structure.js"></script>    
</body>
</html>