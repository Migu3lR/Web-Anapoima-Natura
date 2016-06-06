<!doctype html>
<html class="no-js" lang="en" ng-app="app">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Natura Anapoima</title>
	<link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900' rel='stylesheet' type='text/css'>
	<!-- Frontend FrameWork CSS -->
    <link rel="stylesheet" href="css/foundation.css" /> 
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
			<li><a id="item1" href="../index.php#inicio">INICIO</a></li>
			<li><a id="item2" href="../index.php#hospedaje">HOSPEDAJE</a></li>
			<li><a id="item3" href="../index.php#reservas">RESERVAS</a></li>
			<li><a id="item4" href="../index.php#servicios">SERVICIOS</a></li>
			<li><a id="item5" href="../index.php#galeria">GALERÍA</a></li>
			<li><a id="item6" href="../index.php#contacto">CONTACTO</a></li>
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
					
					<div class="row"><div class="large-12 columns"><div class="callout small">
					<h4>¡DEJANOS UN COMENTARIO!</h4>
						<form accept-charset="UTF-8" ng-submit="newPost(nombre,email,mensaje,rate)">
							<div class="rate">
							<span>Calificanos: </span>
							<span class="rating">
								<input type="radio" class="rating-input" id="rating-input-1-5" name="rating-input-1" ng-model="rate" value="5"/>
								<label for="rating-input-1-5" class="rating-star"></label>
								<input type="radio" class="rating-input" id="rating-input-1-4" name="rating-input-1" ng-model="rate" value="4"/>
								<label for="rating-input-1-4" class="rating-star"></label>
								<input type="radio" class="rating-input" id="rating-input-1-3" name="rating-input-1" ng-model="rate" value="3"/>
								<label for="rating-input-1-3" class="rating-star"></label>
								<input type="radio" class="rating-input" id="rating-input-1-2" name="rating-input-1" ng-model="rate" value="2"/>
								<label for="rating-input-1-2" class="rating-star"></label>
								<input type="radio" class="rating-input" id="rating-input-1-1" name="rating-input-1" ng-model="rate" value="1" />
								<label for="rating-input-1-1" class="rating-star"></label>
							</span>
							</div>
							<div class="name-field">
							<input type="text" required placeholder="Nombre" ng-model="nombre">
							</div>
							<div class="email-field">
							<input type="email" required	placeholder="Dirección de correo electrónico"  ng-model="email">
							</div>
							<div class="text-field">
							<textarea required rows="5"
							placeholder="Mensaje"  ng-model="mensaje"></textarea>
							</div>
							<button type="submit" class="promo_button button" >Enviar</button>
						</form>
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
	<!-- Frontend Framework JS -->
    <script src="js/foundation.min.js"></script>
	
	<script src="js/app.js"></script>
	<!-- Resources -->
	<script src="js/smooth-scroll.js"></script> <!-- SmoothScrolling -->
	<script src="js/initialize.js"></script> <!-- SlideShow -->
	<script src="js/natura.js"> </script>
  </body>
</html>