<!DOCTYPE html>
<html ng-app="app">
  <head>
	<?php $_GET['section']='initAdmin'; require('../layout.php'); ?>
	<script src="/js/angular-hmac-sha512.js"></script>
	<link href="css/structure.css" rel="stylesheet">
	<link href="css/design.css" rel="stylesheet">
  </head>
  <body ng-controller="control" ng-cloak ng-show="user.rol == 1">
  	<div class="header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-5">
	              <!-- Logo -->
	              <div class="logo">
	                 <h1><a href="index.html">Sistema de Usuarios</a></h1>
	              </div>
	           </div>
	           <div class="col-md-5"><div class="row"><div class="col-lg-12"></div></div></div>
	           <div class="col-md-2">
	              <div class="navbar navbar-inverse" role="banner">
	                  <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
	                    <ul class="nav navbar-nav">
	                      <li class="dropdown">
	                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Opciones<b class="caret"></b></a>
	                        <ul class="dropdown-menu animated fadeInUp">
	                          <li><a href="/index.php">Salir</a></li>
	                        </ul>
	                      </li>
	                    </ul>
	                  </nav>
	              </div>
	           </div>
	        </div>
	     </div>
	</div>

    <div class="page-content">
    	<div class="row">
		  <div class="col-md-2">
		  	<div class="sidebar content-box" style="display: block;">
                <ul class="nav">
                    <!-- Main menu -->
                    <li><a href="index.php"><i class="glyphicon glyphicon-home"></i> Escritorio</a></li>
                    <li class="current"><a href="gestion.php"><i class="glyphicon glyphicon-calendar"></i> Gestion</a></li>
                     
                    
                </ul>
             </div>
		  </div>
		  <div class="col-md-10">
		  	<div class="row">
		  		<div class="col-md-12">
		  			<div class="content-box">
		  				<div class="panel-heading">
							<div class="panel-title">Gestion de Usuarios</div>
						</div>
		  				<div class="panel-body">

						<div class="tabla">
						  <div class="thead">
							<div class="registro">
								<div id="fecha" class="celda">Fecha de registro<br>
									<input type="text" ng-model="filtro_fecha" ng-change="add_filter('fecha',filtro_fecha)" ng-value="cookie.fecha">
								</div>
								<div id="cliente" class="celda">Nombre<br>
									<input type="text" ng-model="filtro_cliente" ng-change="add_filter('nombre',filtro_cliente)">
								</div>
								<div id="correo" class="celda">Correo electrónico<br>
									<input type="text" ng-model="filtro_correo" ng-change="add_filter('correo',filtro_correo)"  ng-value="cookie.correo">
								</div>
								<div id="rate" class="celda">Rol<br>
									<select ng-model="filtro_rol" ng-change="add_filter('rol',filtro_rol)" autocomplete="off">
										<option value="">Sin filtro</option>
										<option ng-repeat="rol in roles" ng-if="cookie.rol !== rol.rol" value="{{rol.rol}}">
											{{rol.descRol}}
										</option>
										<option ng-repeat="rol in roles" ng-if="cookie.rol === rol.rol" value="{{rol.rol}}" selected="selected">
											{{rol.descRol}}
										</option>
									</select>
								</div>
								<div id="estado" class="celda">
									Estado de Cuenta<br>
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
								<div id="frecuencia" class="celda">
									Frecuencia<br>
									<select ng-model="filtro_frecuencia" ng-change="add_filter('frecuencia',filtro_frecuencia)" autocomplete="off">
										<option value="">Sin filtro</option>
										<option ng-repeat="frecuencia in frecuencias" ng-if="cookie.frecuencia != frecuencia.frecuencia" value="{{frecuencia.frecuencia}}">
											{{frecuencia.frecuencia}}
										</option>
										<option ng-repeat="frecuencia in frecuencias" ng-if="cookie.frecuencia == frecuencia.frecuencia" value="{{frecuencia.frecuencia}}" selected="selected">
											{{frecuencia.frecuencia}}
										</option>
									</select>
								</div>
								<div id="fuente" class="celda">
									Fuente<br>
									<select ng-model="filtro_fuente" ng-change="add_filter('fuente',filtro_fuente)" autocomplete="off">
										<option value="">Sin filtro</option>
										<option ng-repeat="fuente in fuentes" ng-if="cookie.fuente != fuente.fuente" value="{{fuente.fuente}}">
											{{fuente.descFuente}}
										</option>
										<option ng-repeat="fuente in fuentes" ng-if="cookie.fuente == fuente.fuente" value="{{fuente.fuente}}" selected="selected">
											{{fuente.descFuente}}
										</option>
									</select>
								</div>
								
			                </div>
						  </div>
						  <div class="tbody">							
			                <a ng-repeat="user in usuarios track by $index" class="registro" href="#" ng-click="editar(user)">
								<div id="fecha" class="celda">{{user.creacion}}</div>
								<div id="cliente" class="celda">{{user.nombre == NULL ? '&nbsp;' : user.nombre}}</div>
								<div id="correo" class="celda">{{user.correo}}</div>
								<div id="rate" class="celda">{{user.descRol}}</div>
								<div id="estado" class="celda">{{user.descEstado}}</div>
								<div id="frecuencia" class="celda">{{user.frecuencia}}</div>
								<div id="fuente" class="celda">{{user.descFuente}}</div>
			                </a>
							<a class="registro" href="#" ng-click="nuevo()">
								<div id="fecha" class="celda">[ Agregar Usuario + ]</div>
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

<?php $_GET['section']='endAdmin'; require('../layout.php'); ?>    
<script src="js/controller.userAdmin.js"></script>
  </body>
</html>
