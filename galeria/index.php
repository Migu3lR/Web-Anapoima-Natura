<!doctype html>
<html class="no-js" lang="en" ng-app="app">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Natura Anapoima</title>
	<link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900' rel='stylesheet' type='text/css'>
	
	<!-- Natura Wireframe -->
	<link rel="stylesheet" href="css/structure.css">
	<link rel="stylesheet" href="css/design.css">
	
	<!-- Natura System -->
	<script src="../js/vendor/jquery.min.js" type="text/javascript" charset="utf-8"></script>
	<link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
	<script src="../js/vendor/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
	<script src="../js/angular.min.js"></script>	
	
  </head>
<body ng-controller="control" ng-cloak>
	<?php
	session_start();
	$nombre = "";
	if(isset($_SESSION['nombre'])) {
		$nombre = $_SESSION['nombre'];
		setcookie('nombre', $nombre, time() + (86400 * 1), "/");
	}
	$rol = "";
	if(isset($_SESSION['rol'])) $rol = $_SESSION['rol'];

	?>
	<div class="title-bar" data-responsive-toggle="main-menu" data-hide-for="medium">
	  <button class="menu-icon" type="button" data-toggle> </button>
	  <div class="title-bar-title">Menu</div>
	</div>

	<div class="top-bar sticky" id="main-menu">
	<div class="row column menu-wrap">
	<div class="callout large">
	  <div class="top-bar-left">
		<ul class="dropdown menu" data-dropdown-menu>
		  <li class="menu-text">
			<div class="logo-container" >
			  <a href="/"><img src="../images/galeria/logo.png" alt="Natura Anapoima"> </a>
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
	<div id="inicio" style="height:3em"></div>
	<div id="galerias">
		<div class="title row text-center">
			<div class="large-12 columns">
				<div class="callout large" >
					<div class="row ">
					<div class="large-12 columns">
						<h1>Galería</h1>
					</div>
					</div>
				</div>
			</div>
		</div>
		<div id="galeria" class="row">
			<div class="large-12 columns">
				<div class="callout large" >
				<div class="columns">
					<div class="row">
						<div class="column">
						<div class="seccion sec_1">
							<h5>ZONAS COMUNES Y RECREATIVAS</h5>
						</div>
						</div>
					</div>
					<div class="row small-up-2 medium-up-3 large-up-3">
						<div class="column"><a href="../images/galeria/850X530/COMUN/COMUN (1).jpg" rel="prettyPhoto[EspaciosComunes]">
						<img class="thumbnail" src="../images/galeria/400X249/COMUN/COMUN (1).jpg"></a>
						</div>
						<div class="column"><a href="../images/galeria/850X530/COMUN/COMUN (2).jpg" rel="prettyPhoto[EspaciosComunes]">
						<img class="thumbnail" src="../images/galeria/400X249/COMUN/COMUN (2).jpg"></a>
						</div>
						<div class="column"><a href="../images/galeria/850X530/COMUN/COMUN (3).jpg" rel="prettyPhoto[EspaciosComunes]">
						<img class="thumbnail" src="../images/galeria/400X249/COMUN/COMUN (3).jpg"></a>
						</div>
						<div class="column"><a href="../images/galeria/850X530/COMUN/COMUN (4).jpg" rel="prettyPhoto[EspaciosComunes]">
						<img class="thumbnail" src="../images/galeria/400X249/COMUN/COMUN (4).jpg"></a>
						</div>
						<div class="column"><a href="../images/galeria/850X530/COMUN/capilla10.jpg" rel="prettyPhoto[EspaciosComunes]">
						<img class="thumbnail" src="../images/galeria/400X249/COMUN/capilla10.jpg"></a>
						</div>
						<div class="column"><a href="../images/galeria/850X530/COMUN/capilla11.jpg" rel="prettyPhoto[EspaciosComunes]">
						<img class="thumbnail" src="../images/galeria/400X249/COMUN/capilla11.jpg"></a>
						</div>
						<div class="column"><a href="../images/galeria/850X530/COMUN/COMUN (5).jpg" rel="prettyPhoto[EspaciosComunes]">
						<img class="thumbnail" src="../images/galeria/400X249/COMUN/COMUN (5).jpg"></a>
						</div>
						<div class="column"><a href="../images/galeria/850X530/COMUN/COMUN (6).jpg" rel="prettyPhoto[EspaciosComunes]">
						<img class="thumbnail" src="../images/galeria/400X249/COMUN/COMUN (6).jpg"></a>
						</div>
						<div class="column"><a href="../images/galeria/850X530/COMUN/COMUN (7).jpg" rel="prettyPhoto[EspaciosComunes]">
						<img class="thumbnail" src="../images/galeria/400X249/COMUN/COMUN (7).jpg"></a>
						</div>
						<div class="column"><a href="../images/galeria/850X530/COMUN/COMUN (8).jpg" rel="prettyPhoto[EspaciosComunes]">
						<img class="thumbnail" src="../images/galeria/400X249/COMUN/COMUN (8).jpg"></a>
						</div>
						<div class="column"><a href="../images/galeria/850X530/COMUN/COMUN (9).jpg" rel="prettyPhoto[EspaciosComunes]">
						<img class="thumbnail" src="../images/galeria/400X249/COMUN/COMUN (9).jpg"></a>
						</div>
						<div class="column"><a href="../images/galeria/850X530/COMUN/COMUN (10).jpg" rel="prettyPhoto[EspaciosComunes]">
						<img class="thumbnail" src="../images/galeria/400X249/COMUN/COMUN (10).jpg"></a>
						</div>
						<div class="column"><a href="../images/galeria/850X530/COMUN/COMUN (11).jpg" rel="prettyPhoto[EspaciosComunes]">
						<img class="thumbnail" src="../images/galeria/400X249/COMUN/COMUN (11).jpg"></a>
						</div>
						<div class="column"><a href="../images/galeria/850X530/COMUN/COMUN (12).jpg" rel="prettyPhoto[EspaciosComunes]">
						<img class="thumbnail" src="../images/galeria/400X249/COMUN/COMUN (12).jpg"></a>
						</div>
						<div class="column"><a href="../images/galeria/850X530/COMUN/COMUN (13).jpg" rel="prettyPhoto[EspaciosComunes]">
						<img class="thumbnail" src="../images/galeria/400X249/COMUN/COMUN (13).jpg"></a>
						</div>
						<div class="column"><a href="../images/galeria/850X530/COMUN/COMUN (14).jpg" rel="prettyPhoto[EspaciosComunes]">
						<img class="thumbnail" src="../images/galeria/400X249/COMUN/COMUN (14).jpg"></a>
						</div>
						<div class="column"><a href="../images/galeria/850X530/COMUN/COMUN (15).jpg" rel="prettyPhoto[EspaciosComunes]">
						<img class="thumbnail" src="../images/galeria/400X249/COMUN/COMUN (15).jpg"></a>
						</div>
						<div class="column"><a href="../images/galeria/850X530/COMUN/COMUN (16).jpg" rel="prettyPhoto[EspaciosComunes]">
						<img class="thumbnail" src="../images/galeria/400X249/COMUN/COMUN (16).jpg"></a>
						</div>
						<div class="column"><a href="../images/galeria/850X530/COMUN/COMUN (17).jpg" rel="prettyPhoto[EspaciosComunes]">
						<img class="thumbnail" src="../images/galeria/400X249/COMUN/COMUN (17).jpg"></a>
						</div>
						<div class="column"><a href="../images/galeria/850X530/COMUN/COMUN (18).jpg" rel="prettyPhoto[EspaciosComunes]">
						<img class="thumbnail" src="../images/galeria/400X249/COMUN/COMUN (18).jpg"></a>
						</div>
						<div class="column"><a href="../images/galeria/850X530/COMUN/COMUN (19).jpg" rel="prettyPhoto[EspaciosComunes]">
						<img class="thumbnail" src="../images/galeria/400X249/COMUN/COMUN (19).jpg"></a>
						</div>
						<div class="column"><a href="../images/galeria/850X530/COMUN/COMUN (20).jpg" rel="prettyPhoto[EspaciosComunes]">
						<img class="thumbnail" src="../images/galeria/400X249/COMUN/COMUN (20).jpg"></a>
						</div>
						<div class="column"><a href="../images/galeria/850X530/COMUN/COMUN (21).jpg" rel="prettyPhoto[EspaciosComunes]">
						<img class="thumbnail" src="../images/galeria/400X249/COMUN/COMUN (21).jpg"></a>
						</div>
						<div class="column"><a href="../images/galeria/850X530/COMUN/COMUN (22).jpg" rel="prettyPhoto[EspaciosComunes]">
						<img class="thumbnail" src="../images/galeria/400X249/COMUN/COMUN (22).jpg"></a>
						</div>
						<div class="column"><a href="../images/galeria/850X530/COMUN/COMUN (23).jpg" rel="prettyPhoto[EspaciosComunes]">
						<img class="thumbnail" src="../images/galeria/400X249/COMUN/COMUN (23).jpg"></a>
						</div>
						<div class="column"><a href="../images/galeria/850X530/COMUN/COMUN (24).jpg" rel="prettyPhoto[EspaciosComunes]">
						<img class="thumbnail" src="../images/galeria/400X249/COMUN/COMUN (24).jpg"></a>
						</div>
						<div class="column"><a href="../images/galeria/850X530/COMUN/COMUN (25).jpg" rel="prettyPhoto[EspaciosComunes]">
						<img class="thumbnail" src="../images/galeria/400X249/COMUN/COMUN (25).jpg"></a>
						</div>
						<div class="column"><a href="../images/galeria/850X530/COMUN/COMUN (26).jpg" rel="prettyPhoto[EspaciosComunes]">
						<img class="thumbnail" src="../images/galeria/400X249/COMUN/COMUN (26).jpg"></a>
						</div>
						<div class="column"><a href="../images/galeria/850X530/COMUN/COMUN (27).jpg" rel="prettyPhoto[EspaciosComunes]">
						<img class="thumbnail" src="../images/galeria/400X249/COMUN/COMUN (27).jpg"></a>
						</div>
						<div class="column"><a href="../images/galeria/850X530/COMUN/COMUN (28).jpg" rel="prettyPhoto[EspaciosComunes]">
						<img class="thumbnail" src="../images/galeria/400X249/COMUN/COMUN (28).jpg"></a>
						</div>
						<div class="column"><a href="../images/galeria/850X530/COMUN/COMUN (29).jpg" rel="prettyPhoto[EspaciosComunes]">
						<img class="thumbnail" src="../images/galeria/400X249/COMUN/COMUN (29).jpg"></a>
						</div>
						<div class="column"><a href="../images/galeria/850X530/COMUN/COMUN (30).jpg" rel="prettyPhoto[EspaciosComunes]">
						<img class="thumbnail" src="../images/galeria/400X249/COMUN/COMUN (30).jpg"></a>
						</div>
						<div class="column"><a href="../images/galeria/850X530/COMUN/COMUN (31).jpg" rel="prettyPhoto[EspaciosComunes]">
						<img class="thumbnail" src="../images/galeria/400X249/COMUN/COMUN (31).jpg"></a>
						</div>
						<div class="column"><a href="../images/galeria/850X530/COMUN/COMUN (32).jpg" rel="prettyPhoto[EspaciosComunes]">
						<img class="thumbnail" src="../images/galeria/400X249/COMUN/COMUN (32).jpg"></a>
						</div>
						<div class="column"><a href="../images/galeria/850X530/COMUN/COMUN (33).jpg" rel="prettyPhoto[EspaciosComunes]">
						<img class="thumbnail" src="../images/galeria/400X249/COMUN/COMUN (33).jpg"></a>
						</div>
						<div class="column"><a href="../images/galeria/850X530/COMUN/COMUN (34).jpg" rel="prettyPhoto[EspaciosComunes]">
						<img class="thumbnail" src="../images/galeria/400X249/COMUN/COMUN (34).jpg"></a>
						</div>
						<div class="column"><a name="capilla"></a><a href="../images/galeria/850X530/COMUN/COMUN (35).jpg" rel="prettyPhoto[EspaciosComunes]">
						<img class="thumbnail" src="../images/galeria/400X249/COMUN/COMUN (35).jpg"></a>
						</div>
					</div>
						
					<div class="row">
						<div class="column">
							<div class="seccion sec_2">
							<h5>CAPILLA</h5>
						</div>
						</div>
					</div>
					<div class="row small-up-2 medium-up-3 large-up-3">
						<div class="column">
						<a href="../images/galeria/850X530/CAPILLA/CAPILLA (1).jpg" rel="prettyPhoto[Capilla]">
						<img class="thumbnail" src="../images/galeria/400X249/CAPILLA/CAPILLA (1).jpg"></a>
						</div>
						<div class="column">
						<a href="../images/galeria/850X530/CAPILLA/CAPILLA (2).jpg" rel="prettyPhoto[Capilla]">
						<img class="thumbnail" src="../images/galeria/400X249/CAPILLA/CAPILLA (2).jpg"></a>
						</div>
						<div class="column">
						<a href="../images/galeria/850X530/CAPILLA/CAPILLA (3).jpg" rel="prettyPhoto[Capilla]">
						<img class="thumbnail" src="../images/galeria/400X249/CAPILLA/CAPILLA (3).jpg"></a>
						</div>
						<div class="column">
						<a href="../images/galeria/850X530/CAPILLA/CAPILLA (4).jpg" rel="prettyPhoto[Capilla]">
						<img class="thumbnail" src="../images/galeria/400X249/CAPILLA/CAPILLA (4).jpg"></a>
						</div>
						<div class="column">
						<a href="../images/galeria/850X530/CAPILLA/CAPILLA (5).jpg" rel="prettyPhoto[Capilla]">
						<img class="thumbnail" src="../images/galeria/400X249/CAPILLA/CAPILLA (5).jpg"></a>
						</div>
						<div class="column">
						<a href="../images/galeria/850X530/CAPILLA/CAPILLA (6).jpg" rel="prettyPhoto[Capilla]">
						<img class="thumbnail" src="../images/galeria/400X249/CAPILLA/CAPILLA (6).jpg"></a>
						</div>
						<div class="column"><a name="casas"></a>
						<a href="../images/galeria/850X530/CAPILLA/CAPILLA (7).jpg" rel="prettyPhoto[Capilla]">
						<img class="thumbnail" src="../images/galeria/400X249/CAPILLA/CAPILLA (7).jpg"></a>

						</div>
						
					</div>
					
					
					<div class="row">
						<div class="column">
							<div class="seccion sec_3">
							<h5>CASAS</h5>
							</div>	
						</div>
					</div>
					<div class="row small-up-2 medium-up-3 large-up-3">
						<div class="column">
						<a href="../images/galeria/850X530/CASA/CASA (1).jpg" rel="prettyPhoto[Casas]">
						<img class="thumbnail" src="../images/galeria/400X249/CASA/CASA (1).jpg"></a>
						</div>
						<div class="column">
						<a href="../images/galeria/850X530/CASA/CASA (2).jpg" rel="prettyPhoto[Casas]">
						<img class="thumbnail" src="../images/galeria/400X249/CASA/CASA (2).jpg"></a>
						</div>
						<div class="column">
						<a href="../images/galeria/850X530/CASA/CASA (3).jpg" rel="prettyPhoto[Casas]">
						<img class="thumbnail" src="../images/galeria/400X249/CASA/CASA (3).jpg"></a>
						</div>
						<div class="column">
						<a href="../images/galeria/850X530/CASA/CASA (4).jpg" rel="prettyPhoto[Casas]">
						<img class="thumbnail" src="../images/galeria/400X249/CASA/CASA (4).jpg"></a>
						</div>
						<div class="column">
						<a href="../images/galeria/850X530/CASA/CASA (5).jpg" rel="prettyPhoto[Casas]">
						<img class="thumbnail" src="../images/galeria/400X249/CASA/CASA (5).jpg"></a>
						</div>
						<div class="column">
						<a href="../images/galeria/850X530/CASA/CASA (6).jpg" rel="prettyPhoto[Casas]">
						<img class="thumbnail" src="../images/galeria/400X249/CASA/CASA (6).jpg"></a>
						</div>
						<div class="column">
						<a href="../images/galeria/850X530/CASA/CASA (7).jpg" rel="prettyPhoto[Casas]">
						<img class="thumbnail" src="../images/galeria/400X249/CASA/CASA (7).jpg"></a>
						</div>
						<div class="column"><a name="apartamentos"></a>
						<a href="../images/galeria/850X530/CASA/CASA (8).jpg" rel="prettyPhoto[Casas]">
						<img class="thumbnail" src="../images/galeria/400X249/CASA/CASA (8).jpg"></a>
						</div>
					</div>
					
					<div class="row">
						<div class="column">
							<div class="seccion sec_4">
							<h5>APARTAMENTOS</h5>
							</div>
						</div>
					</div>
					<div class="row small-up-2 medium-up-3 large-up-3">
						<div class="column">
						<a href="../images/galeria/850X530/APARTAMENTO/APARTAMENTO (1).jpg" rel="prettyPhoto[Apartamentos]">
						<img class="thumbnail" src="../images/galeria/400X249/APARTAMENTO/APARTAMENTO (1).jpg"></a>
						</div>
						<div class="column">
						<a href="../images/galeria/850X530/APARTAMENTO/APARTAMENTO (2).jpg" rel="prettyPhoto[Apartamentos]">
						<img class="thumbnail" src="../images/galeria/400X249/APARTAMENTO/APARTAMENTO (2).jpg"></a>
						</div>
						<div class="column">
						<a href="../images/galeria/850X530/APARTAMENTO/APARTAMENTO (3).jpg" rel="prettyPhoto[Apartamentos]">
						<img class="thumbnail" src="../images/galeria/400X249/APARTAMENTO/APARTAMENTO (3).jpg"></a>
						</div>
						<div class="column">
						<a href="../images/galeria/850X530/APARTAMENTO/APARTAMENTO (4).jpg" rel="prettyPhoto[Apartamentos]">
						<img class="thumbnail" src="../images/galeria/400X249/APARTAMENTO/APARTAMENTO (4).jpg"></a>
						</div>
						<div class="column">
						<a href="../images/galeria/850X530/APARTAMENTO/APARTAMENTO (5).jpg" rel="prettyPhoto[Apartamentos]">
						<img class="thumbnail" src="../images/galeria/400X249/APARTAMENTO/APARTAMENTO (5).jpg"></a>
						</div>
						<div class="column">
						<a href="../images/galeria/850X530/APARTAMENTO/APARTAMENTO (6).jpg" rel="prettyPhoto[Apartamentos]">
						<img class="thumbnail" src="../images/galeria/400X249/APARTAMENTO/APARTAMENTO (6).jpg"></a>
						</div>
						<div class="column">
						<a href="../images/galeria/850X530/APARTAMENTO/APARTAMENTO (7).jpg" rel="prettyPhoto[Apartamentos]">
						<img class="thumbnail" src="../images/galeria/400X249/APARTAMENTO/APARTAMENTO (7).jpg"></a>
						</div>
						<div class="column">
						<a href="../images/galeria/850X530/APARTAMENTO/APARTAMENTO (8).jpg" rel="prettyPhoto[Apartamentos]">
						<img class="thumbnail" src="../images/galeria/400X249/APARTAMENTO/APARTAMENTO (8).jpg"></a>
						</div>
						<div class="column">
						<a href="../images/galeria/850X530/APARTAMENTO/APARTAMENTO (9).jpg" rel="prettyPhoto[Apartamentos]">
						<img class="thumbnail" src="../images/galeria/400X249/APARTAMENTO/APARTAMENTO (9).jpg"></a>
						</div>
						<div class="column">
						<a href="../images/galeria/850X530/APARTAMENTO/APARTAMENTO (10).jpg" rel="prettyPhoto[Apartamentos]">
						<img class="thumbnail" src="../images/galeria/400X249/APARTAMENTO/APARTAMENTO (10).jpg"></a>
						</div>
						<div class="column">
						<a href="../images/galeria/850X530/APARTAMENTO/APARTAMENTO (11).jpg" rel="prettyPhoto[Apartamentos]">
						<img class="thumbnail" src="../images/galeria/400X249/APARTAMENTO/APARTAMENTO (11).jpg"></a>
						</div>
						<div class="column"><a name="villas"></a>
						<a href="../images/galeria/850X530/APARTAMENTO/APARTAMENTO (12).jpg" rel="prettyPhoto[Apartamentos]">
						<img class="thumbnail" src="../images/galeria/400X249/APARTAMENTO/APARTAMENTO (12).jpg"></a>
						</div>
					</div>
					
					<div class="row">
						<div class="column">
							<div class="seccion sec_5">
							<h5>VILLAS</h5>
						</div>
						</div>
					</div>
					<div class="row small-up-2 medium-up-3 large-up-3">
						<div class="column">
						<a href="../images/galeria/850X530/VILLA/VILLA (1).jpg" rel="prettyPhoto[Villas]">
						<img class="thumbnail" src="../images/galeria/400X249/VILLA/VILLA (1).jpg"></a>
						</div>
						<div class="column">
						<a href="../images/galeria/850X530/VILLA/VILLA (2).jpg" rel="prettyPhoto[Villas]">
						<img class="thumbnail" src="../images/galeria/400X249/VILLA/VILLA (2).jpg"></a>
						</div>
						<div class="column">
						<a href="../images/galeria/850X530/VILLA/VILLA (3).jpg" rel="prettyPhoto[Villas]">
						<img class="thumbnail" src="../images/galeria/400X249/VILLA/VILLA (3).jpg"></a>
						</div>
						<div class="column">
						<a href="../images/galeria/850X530/VILLA/VILLA (4).jpg" rel="prettyPhoto[Villas]">
						<img class="thumbnail" src="../images/galeria/400X249/VILLA/VILLA (4).jpg"></a>
						</div>
						<div class="column">
						<a href="../images/galeria/850X530/VILLA/VILLA (5).jpg" rel="prettyPhoto[Villas]">
						<img class="thumbnail" src="../images/galeria/400X249/VILLA/VILLA (5).jpg"></a>
						</div>
						<div class="column">
						<a href="../images/galeria/850X530/VILLA/VILLA (6).jpg" rel="prettyPhoto[Villas]">
						<img class="thumbnail" src="../images/galeria/400X249/VILLA/VILLA (6).jpg"></a>
						</div>
						<div class="column"><a name="apartaestudios"></a>
						<a href="../images/galeria/850X530/VILLA/VILLA (7).jpg" rel="prettyPhoto[Villas]">
						<img class="thumbnail" src="../images/galeria/400X249/VILLA/VILLA (7).jpg"></a>
						</div>
					</div>		
						
					<div class="row">
						<div class="column">
							<div class="seccion sec_6">
							<h5>APARTAESTUDIOS</h5>
							</div>	
						</div>
					</div>
					<div class="row small-up-2 medium-up-3 large-up-3">
						<div class="column">
						<a href="../images/galeria/850X530/APARTAESTUDIO/APARTAESTUDIO (1).jpg" rel="prettyPhoto[Apartaestudios]">
						<img class="thumbnail" src="../images/galeria/400X249/APARTAESTUDIO/APARTAESTUDIO (1).jpg"></a>
						</div>
						<div class="column">
						<a href="../images/galeria/850X530/APARTAESTUDIO/APARTAESTUDIO (2).jpg" rel="prettyPhoto[Apartaestudios]">
						<img class="thumbnail" src="../images/galeria/400X249/APARTAESTUDIO/APARTAESTUDIO (2).jpg"></a>
						</div>
						<div class="column">
						<a href="../images/galeria/850X530/APARTAESTUDIO/APARTAESTUDIO (3).jpg" rel="prettyPhoto[Apartaestudios]">
						<img class="thumbnail" src="../images/galeria/400X249/APARTAESTUDIO/APARTAESTUDIO (3).jpg"></a>
						</div>
						<div class="column">
						<a href="../images/galeria/850X530/APARTAESTUDIO/APARTAESTUDIO (4).jpg" rel="prettyPhoto[Apartaestudios]">
						<img class="thumbnail" src="../images/galeria/400X249/APARTAESTUDIO/APARTAESTUDIO (4).jpg"></a>
						</div>
						<div class="column">
						<a href="../images/galeria/850X530/APARTAESTUDIO/APARTAESTUDIO (5).jpg" rel="prettyPhoto[Apartaestudios]">
						<img class="thumbnail" src="../images/galeria/400X249/APARTAESTUDIO/APARTAESTUDIO (5).jpg"></a>
						</div>
						<div class="column">
						<a href="../images/galeria/850X530/APARTAESTUDIO/APARTAESTUDIO (6).jpg" rel="prettyPhoto[Apartaestudios]">
						<img class="thumbnail" src="../images/galeria/400X249/APARTAESTUDIO/APARTAESTUDIO (6).jpg"></a>
						</div>
						<div class="column">
						<a href="../images/galeria/850X530/APARTAESTUDIO/APARTAESTUDIO (7).jpg" rel="prettyPhoto[Apartaestudios]">
						<img class="thumbnail" src="../images/galeria/400X249/APARTAESTUDIO/APARTAESTUDIO (7).jpg"></a>
						</div>
					</div>
				</div>	
				</div>
			</div>
		</div>
	</div>

	<footer>
		<div class="row text-center small-up-1 medium-up-3 large-up-3">
		<div class="column">
			<p>Desarrollo y programación Web: <a href="http://hitbizz.com" target="blank"> <strong>hitbizz.com</strong></a></p>
		</div>
		<div class="column">
			<p>Diseño Gráfico: <a href="http://mickerstudio.com" target="blank"><strong>mickerstudio.com</strong></a></p>
		</div>
		<div class="column">
			<p>www.anapoimanatura.com · Todos los derechos reservados</p>
		</div>
	</div>
	</footer>
	
	<div id="separator"></div>
	
	<script type="text/javascript" charset="utf-8">
	  $(document).ready(function(){
		$("a[rel^='prettyPhoto']").prettyPhoto({
		social_tools: '',
		overlay_gallery: false
	});
		
	  });
	</script>
	<!-- Natura Core -->
    <script src="../js/vendor/what-input.min.js"></script>
	<script src="../js/structure.js"></script>
	
	<!-- Apps -->
	<script src="../js/smooth-scroll.js"></script> <!-- SmoothScrolling -->
	<script src="js/natura.js"> </script>
  </body>
</html>