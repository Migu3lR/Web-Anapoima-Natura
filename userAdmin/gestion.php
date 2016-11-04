<!DOCTYPE html>
<html ng-app="app">
<head>
<!-- Se llama a initAdmin del layout general -->
	<?php $_GET['section']='initAdmin'; require('../layout.php'); ?>
	<script src="../js/angular-hmac-sha512.js"></script><!-- libreria para encriptacion sha512 -->
	<link href="css/structure.css" rel="stylesheet">
	<link href="css/design.css" rel="stylesheet">
</head>
<body ng-controller="control" ng-cloak ng-show="user.rol == 1"><!-- Se invoca controlador y se valida que el usuario sea administrador -->
<!-- Seccion del encabezado -->
  	<div class="header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-5">
	              <!-- Logo -->
	              <div class="logo">
	                 <h1><a href="index.html">Sistema de Usuarios</a></h1>
	              </div>
	           </div>
			   <!-- menu superior -->
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

	<!-- Menu navegacion izquierda -->
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
			<!-- Este div contiene la seccion de gestion -->
			<div class="col-md-10">
				<div class="row">
					<div class="col-md-12">
						<div class="content-box">
							<div class="panel-heading">
								<div class="panel-title">Gestion de Usuarios</div>
							</div>
							<div class="panel-body">
							<!-- Se presentan botones con acciones rapidas usando las funciones multi_modif y multi_del definidas en el controlador -->
								<div style="float:right">
								<input type="button" ng-disabled="selAll" ng-click="multi_modif(false,true)" value="Activar seleccionados">
								<input type="button" ng-click="multi_modif(true,true)" value="Activar todos">
								<input type="button" ng-disabled="selAll" ng-click="multi_modif(false,false)" value="Inactivar seleccionados">
								<input type="button" ng-click="multi_modif(true,false)" value="Inactivar todos">
								<span> | </span>
								<input type="button" ng-disabled="selAll" ng-click="multi_del()" value="Eliminar seleccionados">
								</div>
								<br><br>
							<!-- En este div contenemos la grilla de los datos de usuario -->
							<!-- Se invocan funciones add_filter y editar, definidas dentro del controlador -->
							<table>
								<thead><!-- Aqui se contienen los filtros superiores -->
									<tr>
										<th></th>
										<th id="fecha">Fecha de registro<br>
											<input type="text" ng-model="filtro_fecha" ng-change="add_filter('fecha',filtro_fecha)" ng-value="cookie.fecha">
										</th>
										<th id="cliente">Nombre<br>
											<input type="text" ng-model="filtro_cliente" ng-change="add_filter('nombre',filtro_cliente)">
										</th>
										<th id="correo">Correo electrónico<br>
											<input type="text" ng-model="filtro_correo" ng-change="add_filter('correo',filtro_correo)"  ng-value="cookie.correo">
										</th>
										<th id="rate">Rol<br>
											<select ng-model="filtro_rol" ng-change="add_filter('rol',filtro_rol)" autocomplete="off">
												<option value="">Sin filtro</option>
												<option ng-repeat="rol in roles" ng-if="cookie.rol !== rol.rol" value="{{rol.rol}}">
													{{rol.descRol}}
												</option>
												<option ng-repeat="rol in roles" ng-if="cookie.rol === rol.rol" value="{{rol.rol}}" selected="selected">
													{{rol.descRol}}
												</option>
											</select>
										</th>
										<th id="estado">
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
										</th>
										<th id="frecuencia">
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
										</th>
										<th id="fuente">
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
										</th>
										<th id="accion">Acción<br></th>
									</tr>
								</thead>
								<tbody> <!-- Aqui se contiene la tabla de datos -->
									<tr ng-repeat="user in usuarios track by $index" >
										<td><input type="checkbox" ng-model="sel" ng-change="listClnts(sel,'{{user.id_cln}}')"></td>
										<td id="fecha">{{user.creacion}}</td>
										<td id="cliente">{{user.nombre == NULL ? '&nbsp;' : user.nombre}}</td>
										<td id="correo">{{user.correo}}</td>
										<td id="rate">{{user.descRol}}</td>
										<td id="estado">{{user.descEstado}}</td>
										<td id="frecuencia">{{user.frecuencia}}</td>
										<td id="fuente">{{user.descFuente}}</td>
										<td id="accion">
											<span><a class="registro" href="#" ng-click="editar(user)">
											<img src="../adminResources/editar.png" alt="Editar información de usuario">
											</a></span>
											<span><a class="registro" href="#" ng-click="deleteUser(user.id_cln)">
											<img src="../adminResources/borrar.png" alt="Eliminar usuario">
											</a></span>
										</td>
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
<!-- Se llama a endAdmin del layout general -->
	<?php $_GET['section']='endAdmin'; require('../layout.php'); ?>
	<script src="js/controller.userAdmin.js"></script> <!-- Controlador para la vista -->

</body>
</html>
