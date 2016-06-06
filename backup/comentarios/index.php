<!doctype html>
<html class="no-js" lang="en" ng-app="app">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Natura Anapoima</title>
	<link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900' rel='stylesheet' type='text/css'>
	<!-- Natura Wireframe -->
	<link rel="stylesheet" href="css/structure.css">
	<link rel="stylesheet" href="css/design.css">
	
	<!-- Natura System -->
	<script src="js/angular.min.js"></script>	
  </head>
<body ng-controller="control" ng-cloak>
	<div class="title-bar" data-responsive-toggle="main-menu" data-hide-for="medium">
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
			  <a href="/"><img src="img/logo.png" alt="Natura Anapoima"> </a>
			</div>
		  </li>
		</ul>
	  </div>
	
	  <div class="top-bar-right">
		<ul class="menu vertical medium-horizontal" data-responsive-menu="drilldown medium-dropdown">
			<li><a id="item1" href="../pruebas2/index.html#inicio">INICIO</a></li>
			<li><a id="item2" href="../pruebas2/index.html#hospedaje">HOSPEDAJE</a></li>
			<li><a id="item3" href="../pruebas2/index.html#reservas">RESERVAS</a></li>
			<li><a id="item4" href="../pruebas2/index.html#servicios">SERVICIOS</a></li>
			<li><a id="item5" href="../pruebas2/index.html#galeria">GALERÍA</a></li>
			<li><a id="item6" href="../pruebas2/index.html#contacto">CONTACTO</a></li>
		</ul>
	  </div>
	</div>
	</div>
	</div>
	<div id="inicio" style="height:1em"></div>
	<div id="comentarios">
		<div class="row">
			<div class="large-12 columns">
				<div class="callout large" >
					<div class="row text-center">
						<h1>Comentarios</h1>
					</div>
					
					<div class="row" ng-repeat="post in posts | limitTo : paginacion : paginacion*(pag-1)" >
						<div class="large-12 columns"><div class="callout small">
							<div class="row">
								<div class="left">
									<img class="avatar" src="img/user.png">
								</div>
								<div class="left">
									<h5>{{post.nombre}}</h5>
									<p class="puntaje" ng-if="post.rate != 0"><img ng-src="img/star{{post.rate}}.png"/></p>
									<p class="fecha">{{post.fecha}}</p>
								</div>
							</div>
							<div class="row">
								<p>{{post.mensaje}}</p>
							</div>
							<hr>
						</div></div>
					</div>
					
					<div class="row text-center"><div class="large-12 columns"><div class="callout small">
						<span ng-if="paginas > 1" class="pags" ng-repeat="i in paginas | range">
						
						<a ng-click="changePag(i)">{{ i }}</a>
						</span>
					</div></div></div>										
					
					
				</div>
			</div>
		</div>
	</div>

	<footer>
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
    <script src="js/vendor/jquery.min.js"></script>
    <script src="js/vendor/what-input.min.js"></script>
	<script src="js/structure.js"></script>
	
	<!-- Apps -->
	<script src="js/smooth-scroll.js"></script> <!-- SmoothScrolling -->
	<script src="js/natura.js"> </script>
	
	<script src="js/initialize.js"></script> <!-- SlideShow -->
	
  </body>
</html>