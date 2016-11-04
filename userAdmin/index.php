<!DOCTYPE html>
<html ng-app="app">
  <head>
  <!-- Se llama a initAdmin del layout general -->
	<?php $_GET['section']='initAdmin'; require('../layout.php'); ?>
	<script src="../js/angular-hmac-sha512.js"></script> <!-- libreria de encriptacion sha512 -->
	<link href="css/structure.css" rel="stylesheet">
	<link href="css/design.css" rel="stylesheet">
  </head>
  <body ng-controller="control" ng-cloak ng-show="user.rol == 1"> <!-- Se invoca controlador y se valida que el usuario sea administrador -->
  	<!-- Seccion de encabezado -->
  	<div class="header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-5">
	              <!-- Logo -->
	              <div class="logo">
	                 <h1><a href="index.html">Sistema de Usuarios</a></h1>
	              </div>
	           </div>
			   <!-- Menu superior -->
	           <div class="col-md-5"><div class="row"><div class="col-lg-12"></div></div></div>
	           <div class="col-md-2">
	              <div class="navbar navbar-inverse" role="banner">
	                  <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
	                    <ul class="nav navbar-nav">
	                      <li class="dropdown">
	                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Opciones<b class="caret"></b></a>
	                        <ul class="dropdown-menu animated fadeInUp">
	                          <li><a href="../index.php">Salir</a></li>
	                        </ul>
	                      </li>
	                    </ul>
	                  </nav>
	              </div>
	           </div>
	        </div>
	     </div>
	</div>
	<!-- Menu  navegacion izquierda -->
    <div class="page-content">
    	<div class="row">
		  <div class="col-md-2">
		  	<div class="sidebar content-box" style="display: block;">
                <ul class="nav">
                    <!-- Main menu -->
                    <li class="current"><a href="index.php"><i class="glyphicon glyphicon-home"></i> Escritorio</a></li>
                    <li><a href="gestion.php"><i class="glyphicon glyphicon-calendar"></i> Gestion</a></li>


                </ul>
             </div>
		  </div>

		  <!-- Este div contiene la seccion de gestion -->
		  <div class="col-md-10">
		  	<div class="row">
		  		<div class="col-md-2">
		  			<div class="content-box">
		  				<div class="panel-heading">
							<div class="panel-title">Generales</div>
						</div>
		  				<div class="panel-body">
		  					<ul class="general_stats">
							  <!-- Se invocan funciones goto_filter, definidas dentro del controlador -->
								  <li>Registrados <a href="#"  ng-click="goto_filter('estado','A')">{{stats.registrado}}</a></li>
								  <li>No Registrados <a href="#"  ng-click="goto_filter('estado','I')">{{stats.noregistrado}}</a></li>
								  <li>Activos <a href="#"  ng-click="goto_filter('frecuencia','Frecuente')">{{stats.frecuente}}</a></li>
								  <li>Inactivos <a href="#"  ng-click="goto_filter('frecuencia','Ocasional')">{{stats.ocasional}}</a></li>
							</ul>

		  				</div>
		  			</div>
		  		</div>

		  		<div class="col-md-10">
		  			<div class="row">
		  				<div class="col-md-12">
		  					<div class="content-box-header">
			  					<div class="panel-title">Busqueda de Clientes por Nombre o Correo Electrónico:</div>
				  			</div>
				  			<div class="content-box-large box-with-header">
							  <!-- Se invoca funcion add_filter al enviar formulario, definido dentro del controlador -->
				  				<form accept-charset="UTF-8" ng-submit="encontrados=0; add_filter('nombre_correo',nombre_correo);">
									<fieldset>
										<div class="form-group">
											<label>Nombre o Correo</label>
											<input ng-model="nombre_correo" class="form-control" placeholder="Escriba aqui el nombre o correo electrónico del cliente" type="text"s required>
										</div>
									</fieldset>
									<div>
										<input type="submit" value="Buscar" name="solc">
										<span class="results bad" ng-if="encontrados == 0 && filtro_busqueda">No se encontró ningun resultado</span>
										<span class="results ok" ng-if="encontrados >= 1  && filtro_busqueda">Se han encontrado {{encontrados}} coincidencias</span>
									</div>
								</form>
							</div>
		  				</div>
		  			</div>

					<!-- Busqueda de usuarios realizada-->
					<div class="row" ng-if="encontrados >= 1 && filtro_busqueda" ng-repeat="user in usuarios track by $index">
		  				<div class="col-md-12">
		  					<div class="content-box-header">
			  					<a href="#" ng-click="goto_filter('correo',user.correo)">
									<div class="panel-title"><strong>Usuario: </strong>{{user.correo}}</div>
									<span> Clic para ir a opciones de gestion</span>
								</a>
				  			</div>
				  			<div class="content-box-large box-with-header">
								<div class="row">
									<div class="col-md-6">
										<strong>Nombre del Usuario: </strong>{{user.nombre}}<br>
										<strong>Correo Electrónico: </strong>{{user.correo}}<br>
										<strong>Fecha de Nacimiento: </strong>{{user.nacimiento}}<br>
										<strong>Telefono: </strong>{{user.telefono}}<br>
										<strong>País: </strong>{{user.pais}}<br>
										<strong>Ciudad: </strong>{{user.ciudad}}<br><br>

										<strong>Fecha de registro: </strong>{{user.creacion}}<br>
										<strong>Estado de la cuenta: </strong>{{user.descEstado}}<br>
										<strong>Rol de usuario: </strong>{{user.descRol}}<br>
									</div>
									<div class="col-md-6">
										<ul style="margin-top:3rem">
											<li><a href="../booking/bookAdmin.php?controller=pjAdminBookings&action=pjActionIndex&buscar={{user.correo}}">Ver Reservas</a></li>
											<li><a href="#">Ver Códigos Promocionales</a></li>
											<li><a href="#">Ver Comentarios</a></li>
										</ul>
									</div>
								</div>
							</div>
		  				</div>
		  			</div>

					<!--Grafico -->
					<div class="row">
		  				<div class="col-md-12">
		  					<div class="content-box">
								<div class="panel-heading">
									<div class="panel-title">Historico de Registros</div>
								</div>
								<div class="panel-body">
									<canvas id="line" class="chart chart-line" chart-data="data"
									chart-labels="labels" chart-legend="true" chart-series="series"
									chart-click="onClick" >
									</canvas>
								</div>
							</div>
		  				</div>
		  			</div>

		  		</div>



		  	</div>
		</div>
	  </div>
    </div>
<!-- se llama a endAdmin del layout general -->
<?php $_GET['section']='endAdmin'; require('../layout.php'); ?>
<script src="js/controller.userAdmin.js"></script>  <!-- Controlador para la vista -->

  </body>
</html>