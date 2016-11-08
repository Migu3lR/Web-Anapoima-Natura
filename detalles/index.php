<!-- Se llama initSite del layout general -->
<?php $_GET['section']='initSite'; require('../layout.php'); ?>

	<!-- Estilos del sitio -->
	<link rel="stylesheet" href="css/structure.css">
	<link rel="stylesheet" href="css/design.css">

  </head>
<body ng-controller="control" ng-cloak>
<!-- Se llama a header del layout general -->
<?php $_GET['section']='header'; require('../layout.php'); ?>
<!-- Se llama a reservation del layout general -->
<?php $_GET['section']='reservation'; require('../layout.php'); ?>
	<a name="casas"></a>
<!-- Se muetran secciones de cada tipo de hospedaje -->
	<div id="inicio" style="height:3em"></div>
	<div id="comentarios">
		<div class="title row text-center">
			<div class="large-12 columns">
				<div class="callout large" >
					<div class="row">
					<div class="large-12 columns">
						<h1>Hospedaje</h1>
						<h4>Acomodaciones disponibles</h4>
					</div>
					</div>
				</div>
			</div>
		</div>
		<div class="seccion_title_1">
			<div class="row seccion_title">
				<div class="large-12 columns">
					<div class="callout large" >
						<h3>CASAS</h3>
						<h5>Amplias y fascinantes casas familiares de 300 m<sup class="supercase">2</sup> (área privada)</h5>
					</div>
				</div>
			</div>
		</div>

		<div class="seccion seccion_1">
		<div class="franja"></div>
			<div class="row">
				<div class=" large-12 columns">
					<div class="callout large" >
						<a id="casas" name="casas"></a>
						<div class="row small-up-1 medium-up-1 large-up-2">
							<div class="column">
								<div class="callout ">
									<div class="row"><img src="../images/detalles/casas1.jpg"></div>
									<div id="img_separator" class="row"></div>
									<div class="row"><img src="../images/detalles/casas2.jpg"></div>
								</div>
							</div>
							<div class="column">
							<div class="p">
								<div class="icono">
									<img src="../images/detalles/persona.png">
								</div>
								<div class="personas">
									<h3>11-13</h3>
									<span>Personas</span>
									<span class="desc">(Adultos y niños mayores de 2 años)</span>
								</div>

							</div>

							<div>
								<p>Disfrute de la excelente privacidad que brindan espacios exclusivos y modernos, rodeados de hermosa vegetación.</p>
								<p>Estas Casas están totalmente dotadas constan de:</p>
								<ul>
								<li>Cocina integral totalmente equipada</li>
								<li>Comedor</li>
								<li>Sala de estar</li>
								<li>Solar</li>
								<li>3 habitaciones cada una con baño privado y agua caliente</li>
								<li>TV satelital</li>
								<li>Piscina privada</li>
								<li>Baño auxiliar</li>
								<li>Zona BBQ</li>
								<li>Patio</li>
								<li>4 parqueaderos</li>
								</ul>
								<p>Igualmente usted podrá hacer uso de todas las zonas comunes para que viva en Natura una experiencia familiar inolvidable.</p>
							</div>

							<div class="foot">
								<a href="../galeria/#casas"><img src="../images/detalles/verfotos.png"></a>
                                <span>¡REALICE SU RESERVA! <a href="../booking/" class="more_button button">INGRESAR</a></span>
							</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="seccion_title_2">
			<div class="row seccion_title">
				<div class="large-12 columns">
					<div class="callout large" >
						<h3>APARTAMENTOS</h3>
						<h5>Cómodos y acogedores apartamentos de 120 m<sup class="supercase">2</sup></h5>
					</div>
				</div>
			</div>
		</div>

		<div class="seccion seccion_2">
		<div class="franja"></div>
			<div class="row">
				<div class=" large-12 columns">
					<div class="callout large" >
						<a name="apartamentos"></a>
						<div class="row small-up-1 medium-up-1 large-up-2">
							<div class="column">
								<div class="callout ">
									<div class="row"><img src="../images/detalles/apartamento1.jpg"></div>
									<div id="img_separator" class="row"></div>
									<div class="row"><img src="../images/detalles/apartamento2.jpg"></div>
								</div>
							</div>
							<div class="column">
							<div class="p">
								<div class="icono">
									<img src="../images/detalles/persona.png">
								</div>
								<div class="personas">
									<h3>6-7</h3>
									<span>Personas</span>
									<span class="desc">(Adultos y niños mayores de 2 años)</span>
								</div>

							</div>

							<div>
								<p> Viva una grata experiencia de descanso en familia con el confort que ofrecen los amplios y funcionales apartamentos de Natura.</p>
								<p>Estos Cuentan con  completa dotación y constan de:</p>
								<ul>
								<li>Cocina integral totalmente equipada</li>
								<li>Comedor</li>
								<li>Sala Principal</li>
								<li>Sala de estar (En planta baja o balcón)</li>
								<li>2 habitaciones</li>
								<li>2 baños con agua caliente (Uno de ellos en la habitación principal)</li>
								<li>TV satelital</li>
								<li>Piscina Exclusiva para 2 apartamentos </li>
								<li>Zona BBQ</li>
								<li>Patio</li>
								<li>2 parqueaderos.</li>
								</ul>
								<p>Igualmente usted podrá hacer uso de todas las zonas comunes para que viva en Natura una experiencia familiar inolvidable.</p>
							</div>

							<div class="foot">
								<a href="../galeria/#apartamentos"><img src="../images/detalles/verfotos.png"></a>
								<span>¡REALICE SU RESERVA! <a href="../booking/" class="more_button button">INGRESAR</a></span>
							</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="seccion_title_3">
			<div class="row seccion_title">
				<div class="large-12 columns">
					<div class="callout large" >
						<h3>VILLAS</h3>
						<h5>Confortables y sofisticadas villas de 110 m<sup class="supercase">2</sup></h5>
					</div>
				</div>
			</div>
		</div>

		<div class="seccion seccion_3">
		<div class="franja"></div>
			<div class="row">
				<div class=" large-12 columns">
					<div class="callout large" >
						<a name="villas"></a>
						<div class="row small-up-1 medium-up-1 large-up-2">
							<div class="column">
								<div class="callout ">
									<div class="row"><img src="../images/detalles/villa1.jpg"></div>
									<div id="img_separator" class="row"></div>
									<div class="row"><img src="../images/detalles/villa2.jpg"></div>
								</div>
							</div>
							<div class="column">
							<div class="p">
								<div class="icono">
									<img src="../images/detalles/persona.png">
								</div>
								<div class="personas">
									<h3>4-6</h3>
									<span>Personas</span>
									<span class="desc">(Adultos y niños mayores de 2 años)</span>
								</div>

							</div>

							<div>
								<p> Comparta con su familia una estadía llena de descanso esparcimiento, disfrutando de la comodidad que ofrecen la villas de tipo duplex de estilo contemporáneo y sofisticado.</p>
								<p>Las Villas gozan de completa dotación y constan de:</p>
								<table class="villas">
								<tr>
									<td style="width: 50%;">
										<ul>
											<li><strong>Primer nivel</strong>
												<ul class="inter">
													<li>- Cocina integral equipada</li>
													<li>- Barra comedor</li>
													<li>- Sala de estar (sofacama)</li>
													<li>- 1 Baño con agua caliente</li>
												</ul>
											</li>
										</ul>
										<ul style="margin-bottom: 0;">
											<li><strong>Segundo nivel</strong>
												<ul class="inter">
													<li>- Habitación principal</li>
													<li>- 1 Baño con agua caliente</li>
												</ul>
											</li>
										</ul>
									</td>
									<td style="border-left: 1px solid; padding: 3em;">
										<ul>
											<li>TV satelital</li>
											<li>Porche</li>
											<li>BBQ con comedor</li>
											<li>2 parqueaderos</li>
											<li>Piscina multifamiliar</li>
										</ul>
									</td>
								</tr>
								</table>
								<p>Igualmente usted podrá hacer uso de todas las zonas comunes para que viva en Natura una experiencia familiar inolvidable.</p>
							</div>

							<div class="foot">
								<a href="../galeria/#villas"><img src="../images/detalles/verfotos.png"></a>
								<span>¡REALICE SU RESERVA! <a href="../booking/" class="more_button button">INGRESAR</a></span>
							</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="seccion_title_4">
			<div class="row seccion_title">
				<div class="large-12 columns">
					<div class="callout large" >
						<h3>APARTAESTUDIOS</h3>
						<h5>Amplios y modernos apartaestudios 45 m<sup class="supercase">2</sup></h5>
					</div>
				</div>
			</div>
		</div>

		<div class="seccion seccion_4">
		<div class="franja"></div>
			<div class="row">
				<div class=" large-12 columns">
					<div class="callout large" >
						<a name="apartaestudios"></a>
						<div class="row small-up-1 medium-up-1 large-up-2">
							<div class="column">
								<div class="callout ">
									<div class="row"><img src="../images/detalles/apartaestudio1.jpg"></div>
									<div id="img_separator" class="row"></div>
									<div class="row"><img src="../images/detalles/apartaestudio2.jpg"></div>
								</div>
							</div>
							<div class="column">
							<div class="p">
								<div class="icono">
									<img src="../images/detalles/persona.png">
								</div>
								<div class="personas">
									<h3>2-4</h3>
									<span>Personas</span>
									<span class="desc">(Adultos y niños mayores de 2 años)</span>
								</div>

							</div>

							<div>
								<p> Los apartaestudios son la opción ideal para una magnífica estancia de pequeñas familias. Un moderno espacio, en el cual podrá encontrar confort, descanso y excelente privacidad.</p>
								<p>Los apartaestudios estan completamente dotados y constan de:</p>
								<ul>
								<li>Cocina integral equipada</li>
								<li>Barra comedor</li>
								<li>Sala de estar (sofacama)</li>
								<li>Habitación principal con cama doble</li>
								<li>1 Baño con agua caliente </li>
								<li>TV satelital</li>
								<li>1 parqueadero</li>
                                <li>Piscina multifamiliar</li>
								</ul>
								<p>Igualmente usted podrá hacer uso de todas las zonas comunes para que viva en Natura una experiencia familiar inolvidable.</p>
							</div>

							<div class="foot">
								<a href="../galeria/#apartaestudios"><img src="../images/detalles/verfotos.png"></a>
								<span>¡REALICE SU RESERVA! <a href="../booking/" class="more_button button">INGRESAR</a></span>
							</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="seccion_title_5">
			<div class="row seccion_title text-center">
				<div class="large-12 columns">
					<div class="callout large" >
						<h3>COMPARATIVO - TIPOS DE HOSPEDAJE</h3>
					</div>
				</div>
			</div>
		</div>


		<div class="seccion seccion_5">
			<div class="row">
				<div class=" large-12 columns">
					<div class="callout large">
						<div class="row">
							<div class="column">
<table class="comp">
  <thead>
    <tr>
      <th>ESPECIFICACIONES</th>
      <th>CASAS</th>
      <th>APARTAMENTOS</th>
      <th>VILLAS</th>
	  <th>APARTAESTUDIOS</th>
    </tr>
  </thead>
  <tbody>
    <tr>
		<td class="ttl">Capacidad</td>
		<td>11-13 Personas</td>
		<td>6-7 Personas</td>
		<td>4-6 Personas</td>
		<td>2-4 Personas</td>
	</tr>
	<tr>
		<td class="ttl">Tamaño</td>
		<td>300m<sup class="supercase">2</sup></td>
		<td>120m<sup class="supercase">2</sup></td>
		<td>110m<sup class="supercase">2</sup></td>
		<td>45m<sup class="supercase">2</sup></td>
	</tr>
	<tr>
		<td class="ttl">Habitaciones</td>
		<td>3</td>
		<td>2</td>
		<td>1</td>
		<td>1</td>
	</tr>
	<tr>
		<td class="ttl">Baños</td>
		<td>4</td>
		<td>2</td>
		<td>2</td>
		<td>1</td>
	</tr>
	<tr>
		<td class="ttl">Cocina</td>
		<td>Ok</td>
		<td>Ok</td>
		<td>Ok</td>
		<td>Ok</td>
	</tr>
	<tr>
		<td class="ttl">Comedor</td>
		<td>Ok</td>
		<td>Ok</td>
		<td>Barra</td>
		<td>Barra</td>
	</tr>
	<tr>
		<td class="ttl">Sala</td>
		<td>Ok</td>
		<td>Ok</td>
		<td>Ok</td>
		<td>Ok</td>
	</tr>
	<tr>
		<td class="ttl">Solar</td>
		<td>Ok</td>
		<td>-</td>
		<td>-</td>
		<td>-</td>
	</tr>
	<tr>
		<td class="ttl">Balcón</td>
		<td>-</td>
		<td>1</td>
		<td>-</td>
		<td>-</td>
	</tr>
	<tr>
		<td class="ttl">TV Satelital</td>
		<td>Ok</td>
		<td>Ok</td>
		<td>Ok</td>
		<td>Ok</td>
	</tr>
	<tr>
		<td class="ttl">Piscina privada</td>
		<td>Ok</td>
		<td>Semi</td>
		<td>-</td>
		<td>-</td>
	</tr>
	<tr>
		<td class="ttl">Piscina multifamiliar</td>
		<td>Ok</td>
		<td>Ok</td>
		<td>Ok</td>
		<td>Ok</td>
	</tr>
	<tr>
		<td class="ttl">Patio</td>
		<td>Ok</td>
		<td>Ok</td>
		<td>-</td>
		<td>-</td>
	</tr>
	<tr>
		<td class="ttl">Zona B.B.Q.</td>
		<td>Ok</td>
		<td>Ok</td>
		<td>Ok</td>
		<td>-</td>
	</tr>
	<tr>
		<td class="ttl">Parqueaderos</td>
		<td>3</td>
		<td>2</td>
		<td>2</td>
		<td>1</td>
	</tr>
  </tbody>
</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


	</div>
<!-- se llama footer de layout general -->
<?php $_GET['section']='footer'; require('../layout.php'); ?>

<!-- Contolador js de Detalles -->
<script src="js/controller.Detalles.js"> </script>
</body>
</html>