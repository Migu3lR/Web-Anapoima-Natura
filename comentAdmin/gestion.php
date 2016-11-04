<!DOCTYPE html>
<html ng-app="app">
  <head>
	<!-- Se llama a initAdmin del layout general -->
	<?php $_GET['section']='initAdmin'; require('../layout.php'); ?> <!-- Se invoca initAdmin del layout general -->
	<link href="css/structure.css" rel="stylesheet">
	<link href="css/design.css" rel="stylesheet">
  </head>
  <body ng-controller="control" ng-cloak ng-show="user.rol == 1">

	<!-- Seccion del encabezado -->
  	<div class="header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-5">
	              <!-- Logo -->
	              <div class="logo">
	                 <h1><a href="index.html">Sistema de Comentarios</a></h1>
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
                    <li><a href="index.php"><i class="glyphicon glyphicon-home"></i> Escritorio</a></li>
                    <li class="current"><a href="gestion.php"><i class="glyphicon glyphicon-calendar"></i> Gestion</a></li>
                    <li><a href="calidad.php"><i class="glyphicon glyphicon-stats"></i> Calidad</a></li>

                </ul>
             </div>
		  </div>

			<!-- Este div contiene la seccion de gestion -->
		  <div class="col-md-10">
		  	<div class="row">
		  		<div class="col-md-12">
		  			<div class="content-box">
		  				<div class="panel-heading">
							<div class="panel-title">Gestion de Comentarios</div>
						</div>
		  				<div class="panel-body">
						<!-- En este div contenemos la grilla de los datos de usuario -->
						<!-- Se invocan funciones add_filter y editar, definidas dentro del controlador -->
						<div class="tabla">
						  <div class="thead"><!-- Aqui se contienen los filtros superiores -->
							<div class="registro">
								<div id="fecha" class="celda">Fecha<br>
									<input type="text" ng-model="filtro_fecha" ng-change="add_filter('fecha',filtro_fecha)" ng-value="cookie.fecha">
								</div>
								<div id="cliente" class="celda">Cliente<br>
									<input type="text" ng-model="filtro_cliente" ng-change="add_filter('cliente',filtro_cliente)">
								</div>
								<div id="correo" class="celda">Correo electrónico<br>
									<input type="text" ng-model="filtro_correo" ng-change="add_filter('correo',filtro_correo)">
								</div>
								<div id="rate" class="celda">Puntaje<br>
									<select ng-model="filtro_rate" ng-change="add_filter('rate',filtro_rate)" autocomplete="off">
										<option value="">Sin filtro</option>
										<option ng-repeat="rate in [1,2,3,4,5]" ng-if="cookie.rate != rate" value="{{rate}}">
											{{rate}}
										</option>
										<option ng-repeat="rate in [1,2,3,4,5]" ng-if="cookie.rate == rate" value="{{rate}}" selected="selected">
											{{rate}}
										</option>
									</select>
								</div>
								<div id="estado" class="celda">
									Estado<br>
									<select ng-model="filtro_estado" ng-change="add_filter('estado',filtro_estado)" autocomplete="off">
										<option value="">Sin filtro</option>
										<option ng-repeat="estado in estados" ng-if="cookie.estado != estado.estado" value="{{estado.estado}}">
											{{estado.descEstado}}
										</option>
										<option ng-repeat="estado in estados" ng-if="cookie.estado == estado.estado" value="{{estado.estado}}" selected="selected">
											{{estado.descEstado}}
										</option>
									</select>
								</div>
								<div id="publicar" class="celda">
									Publicación<br>
									<select ng-model="filtro_publicar" ng-change="add_filter('publicar',filtro_publicar)" autocomplete="nope" >
										<option value="">Sin filtro</option>
										<option ng-repeat="public in publico" ng-if="cookie.publicar != public.publicar" value="{{public.publicar}}">
											{{public.descPublicar}}
										</option>
										<option ng-repeat="public in publico" ng-if="cookie.publicar == public.publicar" value="{{public.publicar}}" selected="selected">
											{{public.descPublicar}}
										</option>
									</select>
								</div>
			                </div>
						  </div>
						  <div class="tbody">	<!-- Aqui se contiene la tabla de datos -->
			                <a ng-repeat="coment in comentarios track by $index" class="registro" href="#" ng-click="editar(coment)">
								<div id="fecha" class="celda">{{coment.fecha}}</div>
								<div id="cliente" class="celda">{{coment.nombre == NULL ? '&nbsp;' : coment.nombre}}</div>
								<div id="correo" class="celda">{{coment.correo == NULL ? '&nbsp;' : coment.correo}}</div>
								<div id="rate" class="celda">{{coment.rate == NULL ? '&nbsp;' : coment.rate}}</div>
								<div id="estado" class="celda">{{coment.descEstado}}</div>
								<div id="publicar" class="celda">{{coment.descPublicar}}</div>
			                </a>
						  </div>
			            </div>

		  				</div>
		  			</div>
		  		</div>
		  	</div>
		</div>
	  </div>
    </div>

	<div>

	<div>

    <?php $_GET['section']='endAdmin'; require('../layout.php'); ?>    <!-- Se invoca endAdmin del layout general -->
	<script src="js/controller.comentAdmin.js"></script> <!-- Controlador para la vista -->

  </body>
</html>