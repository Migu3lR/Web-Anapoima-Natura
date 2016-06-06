<!doctype html>
<html class="no-js" lang="en" ng-app="app">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Natura Anapoima</title>
	<link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900' rel='stylesheet' type='text/css'>
	<!-- Frontend FrameWork CSS -->
    <link rel="stylesheet" href="css/foundation.css" /> 
	<!-- Resources -->
    <link href="owl-carousel/owl.carousel.css" rel="stylesheet"> <!-- SlideShow -->
    <link href="owl-carousel/owl.theme.css" rel="stylesheet"> <!-- SlideShow -->
	<link href="owl-carousel/owl.transitions.css" rel="stylesheet"> <!-- SlideShow -->
	<link rel="stylesheet" href="css/smk-accordion.css" /> <!-- Accordion -->
	<!-- Natura Wireframe -->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="css/social-icons.css"/> 
	<link rel="stylesheet" href="css/structure.css">
	<link rel="stylesheet" href="css/design.css">
	<link rel="stylesheet" href="css/paraxify.css">
	
  </head>
<body ng-controller="control" ng-cloak>
<?php
session_start();
$nombre = "";
if(isset($_SESSION['nombre'])) $nombre = $_SESSION['nombre'];
$rol = "";
if(isset($_SESSION['rol'])) $rol = $_SESSION['rol'];
?>
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
			  <a href="/"><img src="img/logo.jpg" alt="Natura Anapoima"> </a>
			</div>
		  </li>
		</ul>
	  </div>
	  <div class="top-bar-right">
		<div class="user">
		<p><?php
		if ($nombre != ""){
			echo "Bienvenido " . $nombre ;
		} else {
			echo "<a href=\"../login/\">Inicia sesión en Natura!</a>";
		}
			
		?> 
		</p>
		</div>
		<ul class="dropdown menu vertical medium-horizontal" data-responsive-menu="drilldown medium-dropdown" data-dropdown-menu>
		  <li><a id="item1" link href="index.html#inicio">Inicio</a></li>
		  <li><a id="item2" link href="index.html#hospedaje">Hospedaje</a></li>
		  <li><a id="item3" link href="index.html#reservas">Reservas</a></li>
		  <li><a id="item4" link href="index.html#servicios">Servicios</a></li>
		  <li><a id="item5" link href="index.html#galeria">Galería</a></li>
		  <li><a id="item6" link href="index.html#contacto">Contacto</a></li>
		<?php
		if($rol == "1"){
		?>			
		  <li><a href="#">Administración</a>
			<ul class="menu">
			  <li><a href="#">Clientes</a></li>
			  <li><a href="../booking">Reservaciones</a></li>
			  <li><a href="../promocodesAPP">Códigos Promocionales</a></li>
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
	<div id="inicio" style="height:0"></div>
	<div id="Slider" class="owl-carousel owl-theme slider_parallax">
		<div class="item slide_0">
			<div class="parallax_bg parallax_css background" ></div>
			<div class="container">
				<div class="slide_description">
					<h1 class="slide_title">Bienvenidos</h1>
					<div class="slide_content">
						<p>¡REALICE SU RESERVA! <a link href="#contacto" class="more_button button">INGRESAR</a></p>
					</div>
				</div>
			</div>
		</div>
		<div class="item slide_image slide_1">
			<div class="parallax_bg parallax_css background" ></div>
			<div class="container">
				<div class="slide_description">
					<div class="slide_content">
						<div class="left_content">
							<img src="img/natura.png">
						</div>
						<div class="right_content">
							<h2 class="slide_title">¡Natura tiene todo para disfrutar en familia!</h2>
							<p>¡REALICE SU RESERVA!<a link href="#contacto" class="more_button button">INGRESAR</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="item slide_2">
			<div class="parallax_bg parallax_css background" ></div>
			<div class="container">
				<div class="slide_description">
					<h4 class="slide_title">Un  exclusivo lugar con modernos espacios, ideal para el descanso en familia.</h4>
					
				</div>
			</div>
		</div>
		<div class="item slide_image slide_3">
			<div class="parallax_bg parallax_css background" ></div>
			<div class="container">
				<div class="slide_description">
					<div class="slide_content">
						<div class="left_content">
							<img src="img/natura.png">
						</div>
						<div class="right_content">
							<h2 class="slide_title">Descubra la escencia del encanto natural</h2>
							<p>¡REALICE SU RESERVA!<a link href="#contacto" class="more_button button">INGRESAR</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
	<div id="reservation" class="sticky">
	<form name="registro" accept-charset="UTF-8" ng-submit="book(adultos,ninos)">
		<div class="field">
			<select ng-model="adultos" required autocomplete="off">
				<option value="" disabled selected hidden>Adultos</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
			</select>
		</div>
		<div class="field">
			<select ng-model="ninos" required autocomplete="off">
				<option value="" disabled selected hidden>Niños</option>
				<option value="0">0</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
			</select>
		</div>
		
		<div  class="field">
			<input ng-model="checkin" type="text" id="from" name="from"  placeholder="Llegada" required autocomplete="off" dpin/>
		</div>
		<div class="field">
			<input ng-model="checkout" type="text" id="to" name="to" placeholder="Salida" required autocomplete="off" dpout/>
		</div>
		<div class="search">
		<button type="submit" class="promo_button button" />Reservar</button>
		</div>
		
	</form>
	</div>
	<div id="hospedaje" class="paraxify">
		<div class="row">
			<div class="large-12 columns">
				<div class="callout large">
					<div class="row text-center">
						<h1>Hospedaje</h1>
					</div>
					<div class="row">
					<div class="large-12 columns">
					<div class="callout small">
						<div class="accordion"> 
						
							<!-- Section 1 -->
							<div class="accordion_in acc_border acc_0">
							<div class="acc_head"><h5>CASAS</h5></div>
							<div class="acc_content">
							
								<div class="acc_content_left">
								<h5><strong>Modernas y amplias casas de 300 m<span class="super">2</span> (área privada)</strong></h5>
								<p>Disfrute de la excelente privacidad que brindan espacios exclusivos y modernos, rodeados de hermosa vegetación.</p>

								<p>Totalmente amobladas y una completa dotación que consta de: 3 habitaciones con sus respectivos juegos de almohadas y lencería para cada huésped, toallas y baño privado con agua caliente. Cocina integral equipada, comedor, sala de estar, solar, TV satelital, piscina privada, zona BBQ, patio y 4 parqueaderos amplios, pensando en su comodidad y la de toda su familia durante su estadía.</p>
								
								<div class="acc_bottom">
									
									<a><img id="link" src="img/verfotos.png"></a>
								</div>
								</div>
								<div class="acc_content_right">
									<img src="img/hosp0.jpg">
								</div>
							
							</div>
							</div>

							<!-- Section 2 -->
							<div class="accordion_in acc_border acc_1">
							<div class="acc_head"><h5>APARTAMENTOS</h5></div>
							<div class="acc_content">
							
								<div class="acc_content_left">
								<h5><strong>Cómodos y acogedores apartamentos de 120 m<span class="super">2</span></strong></h5>
								<p>Siéntase como en casa con el confort que ofrece un lugar amplio y funcional, para que su descanso sea una grata experiencia.</p>

								<p>Los apartamentos cuentan con una completa dotación distribuida en: 2 habitaciones con sus respectivos juegos de almohadas, lencería y toallas para cada huésped.  2 baños con agua caliente, uno de ellos ubicado en el dormitorio principal. Cocina integral equipada, comedor, sala principal y sala de estar (balcón), TV satelital, piscina multifamiliar, zona BBQ, patio y 2 parqueaderos amplios, pensando en su comodidad y la de toda su familia durante su estadía.</p>
								
								<div class="acc_bottom">
									
									<a><img id="link" src="img/verfotos.png"></a>
								</div>
								</div>
								<div class="acc_content_right">
									<img src="img/hosp1.jpg">
								</div>
							
							</div>
							</div>

							<!-- Section 3 -->
							<div class="accordion_in acc_border acc_2">
							<div class="acc_head"><h5>VILLAS</h5></div>
							<div class="acc_content">
							
								<div class="acc_content_left">
								<h5><strong>Acogedoras y confortables Villas de 110 m<span class="super">2</span></strong></h5>
								<p>Comparta con su familia una estadía llena de descanso y sano esparcimiento, disfrutando de la comodidad que ofrecen las villas tipo duplex de estilo contemporáneo y sofisticado.</p>

								<p>Amobladas y una completa dotación que consta de: Habitación principal ubicada en el segundo nivel con sus respectivos juegos de almohadas, lencería y toallas para cada huésped. 2 Baños con agua caliente. Cocina integral equipada, barra comedor, sala de estar (sofacama), TV satelital, porche, BBQ, piscina multifamiliar y 2 parqueaderos, pensando en su comodidad.</p>
								
								<div class="acc_bottom">
									
									<a><img id="link" src="img/verfotos.png"></a>
								</div>
								</div>
								<div class="acc_content_right">
									<img src="img/hosp2.jpg">
								</div>
							
							</div>
							</div>
														
							<div class="accordion_in acc_border acc_3">
							<div class="acc_head"><h5>APARTAESTUDIOS</h5></div>
							<div class="acc_content">
								<div class="acc_content_left">
								<h5><strong>Confortables y acogedores apartaestudios de 45 m<span class="super">2</span> </strong></h5>
								<p>Un acogedor y moderno espacio, en el cual podrá encontrar toda la comodidad necesaria para su descanso con una excelente privacidad.</p>
								<p>Cuenta con una completa dotación que consta de: Habitación principal con sus respectivos juegos de almohadas, lencería y toallas para cada huésped, baño con agua caliente, cocina integral equipada, barra comedor, sala de estar (sofacama), TV satelital, piscina multifamiliar y 1 parqueadero amplio, pensando en su comodidad.</p>
								
								<div class="acc_bottom">
									
									<a><img id="link" src="img/verfotos.png"></a>
								</div>
								</div>
								<div class="acc_content_right">
									<img src="img/hosp3.jpg">
								</div>
							</div>
							</div>
							<div id="condiciones" class="row text-center">
								<a><h5>Ver Condiciones Generales</h5></a>
							</div>
						</div>
					</div>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="reservas">
		<div class="row column text-center">
			<h2>Reservas</h2>
			<p>Realiza aquí tu reserva</p>
			<a link class="promo_button button" href="#contacto">Ingresar</a>
		</div>
	</div>
	<div id="servicios" class="paraxify">
		<div class="row">
			<div class="large-12 columns">
				<div class="callout large">
					<div class="row text-center">
						<h1>Servicios</h1>
					</div>
					<div class="row">
					<div class="large-12 columns">
					<div class="callout small">
						<div class="accordion"> 
						
							<!-- Section 1 -->
							<div class="accordion_in acc_border acc_4">
							<div class="acc_head"><h5>ZONAS COMUNES Y RECREATIVAS</h5></div>
							<div class="acc_content">
							
								<div class="acc_content_left">
								<p>Natura cuenta con diversas zonas comunes para realizar actividades deportivas y de esparcimiento, para usted y su familia, sin costo adicional.</p>

								<div>
									<div style="float:left;">
										<ul>
											<li>Parque de agua</li>
											<li>Piscina</li>
											<li>Fútbol 5 en grama</li>
											<li>Tenis</li>
											<li>Volleyball playa</li>
											<li>Baloncesto</li>
											<li>Golfito</li>
											<li>Pesca deportiva</li>
											<li>Gimnasio</li>
										</ul>
									</div>
									<div style="float:right;">
										<ul>
											<li>Futbolin</li>
											<li>Ping Pong</li>
											<li>Juegos de Mesa</li>
											<li>Canopy (para niños)</li>
											<li>Casa en el árbol</li>
											<li>Parque infantil</li>
											<li>Arenera</li>
											<li>Bicicletas todo terreno</li>
										</ul>
									</div>
								</div>
								
								<div class="acc_bottom">
									<span><a>Ver Condiciones Generales</a></span>
									<span><a><img id="link" src="img/verfotos.png"></a></span>
								</div>
								</div>
								<div class="acc_content_right">
									<img src="img/serv0.jpg">
								</div>
							
							</div>
							</div>

							<!-- Section 2 -->
							<div class="accordion_in acc_border acc_0">
							<div class="acc_head"><h5>CAPILLA, EVENTOS Y REUNIONES SOCIALES</h5></div>
							<div class="acc_content">
							
								<div class="acc_content_left">
								<p>Natura es un excelente lugar para celebrar sus eventos religiosos, ya que cuenta con una hermosa capilla dentro de sus instalaciones, donde podrá llevar a cabo: retiros, encuentros de oración, Eucaristías, Bautizos, Primeras Comuniones, Bodas y Aniversarios.</p>
								<p>Igualmente Natura le brinda la posibilidad de realizar sus reuniones sociales y eventos empresariales.</p>								
								<p>Estos servicios tienen un costo adicional al plan de hospedaje contratado, y deben reservarse con anticipación.</p>
								<p>Mayor información: (+57) 313 879 0310</p>
								
								<div class="acc_bottom">
									<span><a>Ver Condiciones Generales</a></span>
									<span><a><img id="link" src="img/verfotos.png"></a></span>
								</div>
								</div>
								<div class="acc_content_right">
									<img src="img/serv1.jpg">
								</div>
							
							</div>
							</div>

							<!-- Section 3 -->
							<div class="accordion_in acc_border acc_3">
							<div class="acc_head"><h5>SERVICIOS ADICIONALES</h5></div>
							<div class="acc_content">
							
								<div class="acc_content_left">
								<p>Natura le ofrece los siguientes servicios durante su estadía, si usted lo requiere, con un costo adicional:</p>

								<ul>
									<li>Servicio de Lavandería</li>
									<li>Servicio de mucama</li>
								</ul>
								
								<div class="acc_bottom">
									<span><a>Ver Condiciones Generales</a></span>
									<span><a><img id="link" src="img/verfotos.png"></a></span>
								</div>
								</div>
								<div class="acc_content_right">
									<img src="img/serv2.jpg">
								</div>
							
							</div>
							</div>
							
							<div id="foot" class="row text-center">
								<h5>Viva una grata experiencia de descanso, confort y diversión en Natura. 
Disfrute las diversas zonas comunes y servicios adicionales, pensados para su comodidad.</h5>
							</div>
						</div>
					</div>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="puntajes">
		<div class="row small-up-1 medium-up-2 large-up-2">
			<div id="informacion" class="column">
				<div class="callout large">
					<h1>Acerca de Natura</h1>
					<p>Natura es un lugar diseñado para el descanso en familia, goza de 3000 metros cuadrados, donde cada huésped puede disfrutar de las ventajas de un espacio rodeado de naturaleza, que en conjunto con una sofisticada arquitectura minimalista, le brinda a sus visitantes una experiencia llena de confort, diversión, tranquilidad y privacidad.</p>

					<p>Ubicado en el municipio de Anapoima, al suroccidente del departamento de Cundinamarca, a tan solo 87 Km de Bogotá, D. C. A una altura de 700 m sobre el nivel del mar, posee un clima cálido-seco con una temperatura promedio de 24-28º, catalogado como el mejor clima de Colombia y el segundo en el mundo.<p>
				</div>
			</div>
			<div id="booking" class="column">
				<div class="callout large">
					
					<div class="dinamicos">
						<div class="capacidad">
							<img src="img/capacidad.png">
						</div>
						<div class="booking">
							<div class="number">
								<h4> 2014 </h4>
								<canvas id="arcBooking" width="100px" height="100px"> </canvas>
								<div id="pntj3">
									<h1>0</h1>
								</div>
							</div>
							<div class="number">
								<h4> 2015 </h4>
								<canvas id="arcVisitantes" width="100px" height="100px"> </canvas>
								<div id="pntj4">
									<h1>0</h1>
								</div>
							</div>
							<h4>PUNTAJE BOOKING.COM</h4>
						</div>
					</div>
					<div class="visitantes">
						<img src="img/visitantes.png">
					</div>
					
				</div>
			</div>
		</div>
	</div>
    <div id="galeria" class="row small-up-2 medium-up-2 large-up-4">
		<div id="img_1" class="column">
			<div class="image-wrapper overlay-fade-in">
				<img class="thumbnail" src="img/gal1.jpg">
				<div class="image-overlay-content">
					<h2>Natura</h2>
					<p class="price">Ver más...</p>
				</div>
			</div>
		</div>
		<div id="img_2" class="column">
			<div class="image-wrapper overlay-fade-in">
				<img class="thumbnail" src="img/gal2.jpg">
				<div class="image-overlay-content">
					<h2>Natura</h2>
					<p class="price">Ver más...</p>
				</div>
			</div>
		</div>
		<div id="img_3" class="column">
			<div class="image-wrapper overlay-fade-in">
				<img class="thumbnail" src="img/gal3.jpg">
				<div class="image-overlay-content">
					<h2>Natura</h2>
					<p class="price">Ver más...</p>
				</div>
			</div>
		</div>
		<div id="img_4" class="column">
			<div class="image-wrapper overlay-fade-in">
				<img class="thumbnail" src="img/gal4.jpg">
				<div class="image-overlay-content">
					<h2>Natura</h2>
					<p class="price">Ver más...</p>
				</div>
			</div>
		</div>
		<div id="img_5" class="column">
			<div class="image-wrapper overlay-fade-in">
				<img class="thumbnail" src="img/gal5.jpg">
				<div class="image-overlay-content">
					<h2>Natura</h2>
					<p class="price">Ver más...</p>
				</div>
			</div>
		</div>
		<div id="img_6" class="column">
			<div class="image-wrapper overlay-fade-in">
				<img class="thumbnail" src="img/gal6.jpg">
				<div class="image-overlay-content">
					<h2>Natura</h2>
					<p class="price">Ver más...</p>
				</div>
			</div>
		</div>
		<div id="img_7" class="column">
			<div class="image-wrapper overlay-fade-in">
				<img class="thumbnail" src="img/gal7.jpg">
				<div class="image-overlay-content">
					<h2>Natura</h2>
					<p class="price">Ver más...</p>
				</div>
			</div>
		</div>
		<div id="img_8" class="column">
			<div class="image-wrapper overlay-fade-in">
				<img class="thumbnail" src="img/gal8.jpg">
				<div class="image-overlay-content">
					<h2>Natura</h2>
					<p class="price">Ver más...</p>
				</div>
			</div>
		</div>
	</div>
	<div id="contacts">

		<div class="row text-center small-up-1 medium-up-1 large-up-3">
			<div id="info" class="column text-column">
				<div class="row text-center">
					<h5>reservas@anapoimanatura.com</h5>
				</div>
				<div id="info_data" class="row text-center">
					<h5>
						<ul>
							<li>Información:</li>
							<li>+57 313 879 0310</li>
							<li>+57 313 879 1585</li>
						</ul>
					</h5>

					<h5>
						<ul>
							<li>Reservas:</li>
							<li>+57 313 879 3824</li>
							<div class="tel_ws">
								<div class="tel_left">
								<li>+57 313 879 5942</li>
								<li>+57 313 879 1585</li>
								</div>
								<div class = "tel_right">
								<img id="ws" src="img/ws_logo.png">
								</div>
							</div>
						</ul>
					</h5>

					<h5>
						<ul>
							<li>Administración Anapoima:</li>
							<li>+57 301 567 3608</li>
						</ul>
					</h5>
				</div>
			</div>
			<div id="contactForm" class="column">
				<div class="row">
					<a id="contacto" onclick="activate()"><h1>Contacto</h1>
					<h5>Escríbanos, su opinión es muy importante para nosotros.</h5></a>
				</div>
				<div class="row">
					<form data-abide>
					<div class="name-field">
					<input type="text" required pattern="[a-zA-Z]+" placeholder="Nombre">
					</div>
					<div class="email-field">
					<input type="email" required 
					placeholder="Dirección de correo electrónico">
					</div>
					<div class="text-field">
					<textarea required rows="5"
					placeholder="Mensaje"></textarea>
					</div>
					<button type="submit" class="promo_button button" >Enviar</button>
					</form>
				</div>
			</div>
			<div id="social" class="column">
				<div class="row text-center">
				<a href="#" class="icon icon-mono facebook">facebook</a>
				<a href="#" class="icon icon-mono twitter">twitter</a>
				<a href="#" class="icon icon-mono googleplus">google+</a>
				<a href="#" class="icon icon-mono instagram">instagram</a>
				<a href="#" class="icon icon-mono youtube">youtube</a>
				</div>
				<div id="social_data" class="row text-center">
				<h5>
					<ul>
						<li>Anapoima Km 3</li>
						<li>Vía Las Mercedes</li>
						<li>Cundinamarca - Colombia</li>
						<li>
						<img src="img/natura.png" width="150px">
						</li>
					</ul>
				</h5>
				</div>
			</div>
		</div>
	</div>	
	
	<div id="map"></div>
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
    <script src="js/jquery-1.10.2.js"></script>
	<script src="js/jquery-ui.js"></script>
    <script src="js/vendor/what-input.min.js"></script>
	
	<!-- Natura System -->
	<script src="js/moment.js"></script>
	<script src="js/angular.min.js"></script>
	<script src="js/angular-moment.js"></script>	
	<!-- Frontend Framework JS -->
    <script src="js/foundation.min.js"></script>
	
	<script src="js/app.js"></script>
	<!-- Resources -->
	<script src="owl-carousel/owl.carousel.min.js"></script> <!-- SlideShow -->
	<script src="js/parallax.min.js"></script>
	<script src="js/paraxify.js"></script>
	<script type="text/javascript" src="js/smk-accordion.min.js"></script>
	<script src="js/smooth-scroll.js"></script> <!-- SmoothScrolling -->
	<script src="js/initialize.js"></script> <!-- SlideShow -->
	<script src='http://maps.google.com/maps/api/js?sensor=false&callback=initMap'> </script>
	<script src="js/scroll.js"> </script> <!-- Scroll Control -->
	<script src="js/natura.js"> </script>
  </body>
</html>