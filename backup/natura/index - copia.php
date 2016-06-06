<!doctype html>
<html class="no-js" lang="en" ng-app="app">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Natura Anapoima</title>
	<link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900' rel='stylesheet' type='text/css'>
	
	<!-- Natura Wireframe -->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="css/structure.css">
	<link rel="stylesheet" href="css/design.css">
	
	<!-- Natura System -->
	<script src="js/angular.min.js"></script>	
	
  </head>
<body ng-controller="control" ng-cloak>
<?php
session_start();
$nombre = "";
if(isset($_SESSION['nombre'])) $nombre = $_SESSION['nombre'];
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
			  <a href="/"><img src="img/logo.png" alt="Natura Anapoima"> </a>
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
		<ul class="menu vertical medium-horizontal" data-responsive-menu="drilldown medium-dropdown">
			<li><a id="item1" link href="index.php#inicio">INICIO</a></li>
			<li><a id="item2" link href="index.php#hospedaje">HOSPEDAJE</a></li>
			<li><a id="item3" link href="index.php#reservas">RESERVAS</a></li>
			<li><a id="item4" link href="index.php#servicios">SERVICIOS</a></li>
			<li><a id="item5" link href="index.php#galeria">GALERÍA</a></li>
			<li><a id="item6" link href="index.php#contacto">CONTACTO</a></li>
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
					<h1 class="slide_title">Bienvenidos a Natura</h1>
					<div class="slide_content">
					<h4>Exclusivo condominio vacacional para la familia</h4>
						<p>¡REALICE SU RESERVA! <a href="booking/" class="more_button button">INGRESAR</a></p>
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
							<p>¡REALICE SU RESERVA!<a href="booking/" class="more_button button">INGRESAR</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="item slide_2">
			<div class="parallax_bg parallax_css background" ></div>
			<div class="container">
				<div class="slide_description">
					<h4 class="slide_title">Viva a plenituud el descanso y confort en modernos espacios familiares</h4>
					
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
							<p>¡REALICE SU RESERVA!<a href="booking/" class="more_button button">INGRESAR</a></p>
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
						<h2>Hospedaje</h2>
					</div>
					<div class="row">
					<div class="large-12 columns">
					<div class="callout small">
						<div class="accordion"> 
						
							<!-- Section 1 -->
							<div class="accordion_in acc_border acc_0">
							<div class="acc_head"><p>CASAS</p></div>
							<div class="acc_content">
							
								<div class="acc_content_left">
								<h5><strong>Amplias y fascinantes casas familiares de 300 m<span class="super">2</span> (área privada)</strong></h5>
								
								<ul>
								<li>Cocina integral</li>
								<li>Comedor</li>
								<li>Sala de estar</li>
								<li>Solar</li>
								<li>3 habitaciones con baño privado</li>
								<li>TV satelital</li>
								<li>Piscina privada</li>
								<li>Zona BBQ</li>
								<li>4 parqueaderos</li>
								</ul>		
								
								<div class="acc_bottom" ng-init="casas_hover=false">
									<a href="../galeria/#casas" ng-mouseover="casas_hover=true" ng-mouseleave="casas_hover=false">
										<img id="link" ng-src="{{casas_hover?'img/verfotosHover.png':'img/verfotos.png'}}">
									</a>
									<p class="detalles"><a link href="../detalles/#casas" class="more_button button">Leer más...</a></p>
								</div>
								</div>
								<div class="acc_content_right">
									<img src="img/hosp0.jpg">
								</div>
							
							</div>
							</div>

							<!-- Section 2 -->
							<div class="accordion_in acc_border acc_1">
							<div class="acc_head"><p>APARTAMENTOS</p></div>
							<div class="acc_content">
							
								<div class="acc_content_left">
								<h5><strong>Cómodos y acogedores apartamentos de 120 m<span class="super">2</span></strong></h5>
								
								<ul>
								<li>Cocina integral</li>
								<li>Comedor</li>
								<li>Sala</li>
								<li>Sala de estar</li>
								<li>2 habitaciones</li>
								<li>2 baños</li>
								<li>TV satelital</li>
								<li>Piscina exclusiva para 2 apartamentos</li>
								<li>Zona BBQ</li>
								<li>2 parqueaderos</li>
								</ul>		
								
								<div class="acc_bottom" ng-init="apartamentos_hover=false">
									<a href="../galeria/#apartamentos" ng-mouseover="apartamentos_hover=true" ng-mouseleave="apartamentos_hover=false">
										<img id="link" ng-src="{{apartamentos_hover?'img/verfotosHover.png':'img/verfotos.png'}}">
									</a>
									<p class="detalles"><a link href="../detalles/#apartamentos" class="more_button button">Leer más...</a></p>
								</div>
								</div>
								<div class="acc_content_right">
									<img src="img/hosp1.jpg">
								</div>
							
							</div>
							</div>

							<!-- Section 3 -->
							<div class="accordion_in acc_border acc_2">
							<div class="acc_head"><p>VILLAS</p></div>
							<div class="acc_content">
							
								<div class="acc_content_left">
								<h5><strong>Confortables y sofisticadas Villas de 110 m<span class="super">2</span></strong></h5>
								
								<ul>
								<li>Cocina integral</li>
								<li>Barra comedor</li>
								<li>Sala de estar</li>
								<li>1 Habitación (2do piso)</li>
								<li>2 baños</li>
								<li>TV satelital</li>
								<li>Porche y BBQ</li>
								<li>2 parqueaderos</li>
								<li>Piscina Multifamiliar</li>
								</ul>	
								
								<div class="acc_bottom" ng-init="villas_hover=false">
									<a href="../galeria/#villas" ng-mouseover="villas_hover=true" ng-mouseleave="villas_hover=false">
										<img id="link" ng-src="{{villas_hover?'img/verfotosHover.png':'img/verfotos.png'}}">
									</a>
									<p class="detalles"><a link href="../detalles/#villas" class="more_button button">Leer más...</a></p>
								</div>
								</div>
								<div class="acc_content_right">
									<img src="img/hosp2.jpg">
								</div>
							
							</div>
							</div>
														
							<div class="accordion_in acc_border acc_3">
							<div class="acc_head"><p>APARTAESTUDIOS</p></div>
							<div class="acc_content">
								<div class="acc_content_left">
								<h5><strong>Amplios y modernos apartaestudios de 45 m<span class="super">2</span></strong></h5>
								<ul>
								<li>Cocina integral</li>
								<li>Barra comedor</li>
								<li>Sala de estar</li>
								<li>1 Habitación</li>
								<li>1 Baño</li>
								<li>TV satelital</li>
								<li>1 parqueadero</li>
								<li>Piscina Multifamiliar</li>
								</ul>
								
								<div class="acc_bottom" ng-init="apartaestudios_hover=false">
									<a href="../galeria/#apartaestudios" ng-mouseover="apartaestudios_hover=true" ng-mouseleave="apartaestudios_hover=false">
										<img id="link" ng-src="{{apartaestudios_hover?'img/verfotosHover.png':'img/verfotos.png'}}">
									</a>
									<p class="detalles"><a link href="../detalles/#apartaestudios" class="more_button button">Leer más...</a></p>
								</div>
								</div>
								<div class="acc_content_right">
									<img src="img/hosp3.jpg">
								</div>
							</div>
							</div>
							
							<div class="accordion_in condiciones">
							<div class="acc_head"><center><p>CONDICIONES GENERALES</p></center></div>
							<div class="acc_content">
							<p><strong>Natura ha sido creado exclusivamente para el disfrute de sus huéspedes, por lo tanto tenga en cuenta las siguientes recomendaciones:</strong></p>
								<div class="acc_content_left">
								<ul>
								<li>No se admiten visitas.</li>
								<li>Prohibido el ingreso de mascotas.</li>
								<li>Favor no fumar dentro y fuera de las acomodaciones y zonas comunes tales como piscinas y juegos recreativos.</li>
								<li>Todo menor de edad deberá estar siempre bajo la supervisión de un adulto responsable.</li>
								<li>La restricción del ruido inicia a partir de las 10:00 p.m.</li>
								<li>No es permitido colgar ropa o toallas en los balcones y  barandas. Utilice los tubos de los baños o tendederos de los patios.</li>
								</ul>
								
								<div class="acc_bottom">
									<p>Check in:  2:00 p.m.  -  Check out: 12:00 m.
									<a href="REGLAMENTO_GENERAL_NATURA.pdf" class="more_button button">Ver todas las Condiciones Generales</a></p>
								</div>
								</div>
								<div class="acc_content_right">
									<img src="img/logo.png">
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
	</div>
	<div id="reservas">
		<div class="row column text-center">
			<h2>Reservas</h2>
			<p>REALICE AQUÍ SU RESERVA</p>
			<a link class="promo_button button" href="booking/">INGRESAR</a>
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
							<div class="acc_head"><p>ZONAS COMUNES Y RECREATIVAS</p></div>
							<div class="acc_content">
							
								<div class="acc_content_left">
								<p>Natura cuenta con diversas zonas comunes para realizar actividades deportivas y de esparcimiento, para usted y su familia, sin costo adicional.</p>

								<div>
									<div style="float:left;">
										<ul>
											<li>Parque de agua</li>
											<li>Piscina</li>
											<li>Cancha de Fútbol 5 en grama</li>
											<li>Cancha de Tenis</li>
											<li>Cancha de Voleiplaya</li>
											<li>Cancha de Baloncesto</li>
											<li>Campo de Golfito</li>
											<li>Pesca deportiva</li>
										</ul>
									</div>
									<div style="float:right;">
										<ul>
											<li>Futbolin</li>
											<li>Mesas de Ping Pong</li>
											<li>Canopy (para niños)</li>
											<li>Casa en el árbol</li>
											<li>Parque infantil</li>
											<li>Arenera</li>
											<li>Bicicletas todo terreno</li>
										</ul>
									</div>
								</div>
								
								<div class="acc_bottom">
									<a href="../galeria"><img id="link" src="img/verfotos.png"></a></span>
								</div>
								</div>
								<div class="acc_content_right">
									<img src="img/serv0.jpg">
								</div>
							
							</div>
							</div>

							<!-- Section 2 -->
							<div class="accordion_in acc_border acc_0">
							<div class="acc_head"><p>CAPILLA, EVENTOS Y REUNIONES SOCIALES</p></div>
							<div class="acc_content">
								<div class="acc_content_left">
								<p>Natura es un excelente lugar para celebrar sus eventos religiosos, ya que cuenta con una hermosa capilla dentro de sus instalaciones, donde podrá llevar a cabo: retiros, encuentros de oración, Eucaristías, Bautizos, Primeras Comuniones, Bodas y Aniversarios.</p>
								<p>Igualmente Natura le brinda la posibilidad de realizar sus reuniones sociales y eventos empresariales para máximo 100 personas en horarios hasta las 11:00pm.</p>								
								<p>Estos servicios tienen un costo adicional al plan de hospedaje contratado, y deben reservarse con anticipación.</p>
																
								<div class="acc_bottom">
									<span><a href="../galeria"><img id="link" src="img/verfotos.png"></a></span>
								</div>
								</div>
								<div class="acc_content_right">
									<img src="img/serv1.jpg">
								</div>
							
							</div>
							</div>

							<!-- Section 3 -->
							<div class="accordion_in acc_border acc_3">
							<div class="acc_head"><p>SERVICIOS ADICIONALES</p></div>
							<div class="acc_content">
							
								<div class="acc_content_left">
								<p>Natura le ofrece los siguientes servicios durante su estadía, si usted lo requiere, con un costo adicional:</p>

								<ul>
									<li>Servicio de Lavandería</li>
									<li>Servicio de preparación de alimentos</li>
								</ul>
								
								</div>
								<div class="acc_content_right">
									<img src="img/serv2.jpg">
								</div>
							
							</div>
							</div>
							
							<div id="foot" class="row text-center">
								<p>Disfrute en familia las diversas zonas comunes y recreatvas de Natura
<BR>para que viva una grata experiencia de descanso, confort y diversión.</p>
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
					<p>Natura es un exclusivo condominio vacacional diseñado para el descanso en familia. Goza de 11.000 metros cuadrados, donde cada huésped puede disfrutar de las ventajas de un espacio rodeado de naturaleza, que en conjunto con una sofisticada arquitectura minimalista, le brinda a sus visitantes una experiencia llena de confort, diversión, tranquilidad y privacidad.</p>

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
								<h5> 2014 </h5>
								<canvas id="arcBooking" width="100px" height="100px"> </canvas>
								<div id="pntj3">
									<h1>0</h1>
								</div>
							</div>
							<div class="number">
								<h5> 2015 </h5>
								<canvas id="arcVisitantes" width="100px" height="100px"> </canvas>
								<div id="pntj4">
									<h1>0</h1>
								</div>
							</div>
							<a><h5>PUNTAJE BOOKING.COM</h5></a>
						</div>
					</div>
					<div class="visitantes" ng-init="hover=false">
						<a href="../comentarios" ng-mouseover="hover=true" ng-mouseleave="hover=false">
							<img ng-src="{{hover?'img/visitantesHover.png':'img/visitantes.png'}}">
						</a>
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
					<a href="../galeria"><p class="price">Ver más...</p></a>
				</div>
			</div>
		</div>
		<div id="img_2" class="column">
			<div class="image-wrapper overlay-fade-in">
				<img class="thumbnail" src="img/gal2.jpg">
				<div class="image-overlay-content">
					<h2>Natura</h2>
					<a href="../galeria"><p class="price">Ver más...</p></a>
				</div>
			</div>
		</div>
		<div id="img_3" class="column">
			<div class="image-wrapper overlay-fade-in">
				<img class="thumbnail" src="img/gal3.jpg">
				<div class="image-overlay-content">
					<h2>Natura</h2>
					<a href="../galeria"><p class="price">Ver más...</p></a>
				</div>
			</div>
		</div>
		<div id="img_4" class="column">
			<div class="image-wrapper overlay-fade-in">
				<img class="thumbnail" src="img/gal4.jpg">
				<div class="image-overlay-content">
					<h2>Natura</h2>
					<a href="../galeria"><p class="price">Ver más...</p></a>
				</div>
			</div>
		</div>
		<div id="img_5" class="column">
			<div class="image-wrapper overlay-fade-in">
				<img class="thumbnail" src="img/gal5.jpg">
				<div class="image-overlay-content">
					<h2>Natura</h2>
					<a href="../galeria"><p class="price">Ver más...</p></a>
				</div>
			</div>
		</div>
		<div id="img_6" class="column">
			<div class="image-wrapper overlay-fade-in">
				<img class="thumbnail" src="img/gal6.jpg">
				<div class="image-overlay-content">
					<h2>Natura</h2>
					<a href="../galeria"><p class="price">Ver más...</p></a>
				</div>
			</div>
		</div>
		<div id="img_7" class="column">
			<div class="image-wrapper overlay-fade-in">
				<img class="thumbnail" src="img/gal7.jpg">
				<div class="image-overlay-content">
					<h2>Natura</h2>
					<a href="../galeria"><p class="price">Ver más...</p></a>
				</div>
			</div>
		</div>
		<div id="img_8" class="column">
			<div class="image-wrapper overlay-fade-in">
				<img class="thumbnail" src="img/gal8.jpg">
				<div class="image-overlay-content">
					<h2>Natura</h2>
					<a href="../galeria"><p class="price">Ver más...</p></a>
				</div>
			</div>
		</div>
	</div>
	<div id="contacts">

		<div class="row text-center small-up-1 medium-up-1 large-up-3">
			<div id="info" class="column text-column">
				<div class="row text-center">
					<p>reservas@anapoimanatura.com</p>
				</div>
				<div id="info_data" class="row text-center">
					<p>
						<ul>
							<li>Reservas:</li>
							<li>+57 313 879 5942</li>
							<li>+57 313 879 3824</li>
						</ul>
					</p>
					<p>
						<ul>
							<li>Información:</li>
							<li>+57 313 879 0310</li>
							<li>+57 313 879 1585</li>
							<li>+57 301 567 3608</li>
						</ul>
					</p>
					<p>
						<ul>
							<li>Administración Natura:</li>
							<li>+57 301 567 3608</li>
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
					</p>
					<p>
						<ul>
							<li>Horario de Atención Telefónica:</li>
							<li>Lunes a Domingo de 7:00 am a 8:00 pm</li>
						</ul>
					</p>
				</div>
			</div>
			<div id="contactForm" class="column">
				<div class="row">
					<a id="contacto" onclick="activate()"  ng-mouseover="hover2=true" ng-mouseleave="hover2=false"><h2>Contáctanos</h2>
					<img class="arrow" ng-src="{{hover2?'img/arrow_hover.png':'img/arrow.png'}}"></a>
					<h5>Escríbanos, su opinión es muy importante para nosotros.</h5>
				</div>
				<div class="row">
					<form data-abide accept-charset="UTF-8" ng-submit="sendMail(nombre,email,body)">
					<div class="name-field">
					<input type="text" require placeholder="Nombre" ng-model="nombre">
					</div>
					<div class="email-field">
					<input type="email" required 
					placeholder="Dirección de correo electrónico"  ng-model="email">
					</div>
					<div class="text-field">
					<textarea required rows="5"
					placeholder="Mensaje"  ng-model="body"></textarea>
					</div>
					<button type="submit" class="promo_button button" >ENVIAR</button>
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
				<p>
					<ul>
						<li>Anapoima Km 3</li>
						<li>Vía Las Mercedes</li>
						<li>Cundinamarca - Colombia</li>
						<li>
						<img src="img/natura.png" width="150px">
						</li>
					</ul>
				</p>
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
    <script src="js/vendor/jquery-1.10.2.js"></script>
    <script src="js/vendor/jquery-ui.js"></script>	
    <script src="js/vendor/what-input.min.js"></script>
	
	<script src="js/structure.js"></script>
	
	<!-- Apps -->
	<script src="js/scroll.js"> </script> <!-- Scroll Control -->
	<script src="js/natura.js"> </script>
	<script src="js/smooth-scroll.js"></script> <!-- SmoothScrolling -->
	
	<script src="js/initialize.js"></script> <!-- SlideShow -->
	
	<!-- Resources -->
	<script src='http://maps.google.com/maps/api/js?sensor=false&callback=initMap'> </script>
  </body>
</html>
