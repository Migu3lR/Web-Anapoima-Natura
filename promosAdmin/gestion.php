<!DOCTYPE html>
<html ng-app="app">
  <head>
  <!-- Se llama a initAdmin del layout general -->
	<?php $_GET['section']='initAdmin'; require('../layout.php'); ?>
	<script src="../js/angular-hmac-sha512.js"></script> <!-- libreria para encriptacion sha512 -->

	<link href="css/structure.css" rel="stylesheet">
	<link href="css/design.css" rel="stylesheet">
  </head>
  <body ng-controller="control" ng-cloak ng-show="user.rol == 1"> <!-- Se invoca controlador y se valida que el usuario sea administrador -->
  <!-- Seccion del encabezado -->
  	<div class="header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-5">
	              <!-- Logo -->
	              <div class="logo">
	                 <h1><a href="index.html">Sistema de Promociones</a></h1>
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
								<div class="panel-title">Gestion de Códigos Promocionales</div>
							</div>
					<div class="panel-body" ng-if="!editMode">
					<!-- En este div contenemos la grilla de los datos de usuario -->
						<!-- Se invocan funciones add_filter y editar, definidas dentro del controlador -->
						<table class="listado">
								<thead><!-- Aqui se contienen los filtros superiores -->
									<tr>
								<th id="fecha">Fecha de Inicio<br>
									<input type="text" ng-model="filtro_fecha" ng-change="add_filter('fecha',filtro_fecha)" >
								</th>
								<th id="codigo">Código<br>
									<input type="text" ng-model="filtro_codigo" ng-change="add_filter('codigo',filtro_codigo)">
								</th>
								<th id="descrip">Descripción<br>
									<input type="text" ng-model="filtro_descrip" ng-change="add_filter('descrip',filtro_descrip)">
								</th>
								<th id="tipo">Tipo de Promoción<br>
									<select ng-model="filtro_tipo" ng-change="add_filter('tipo',filtro_tipo)" autocomplete="off">
										<option value="">Sin filtro</option>
										<option ng-repeat="tipo in tipos" ng-if="cookie.tipo !== tipo.tipo" value="{{tipo.tipo}}">
											{{tipo.descTipo}}
										</option>
										<option ng-repeat="tipo in tipos" ng-if="cookie.tipo === tipo.tipo" value="{{tipo.tipo}}" selected="selected">
											{{tipo.descTipo}}
										</option>
									</select>
								</th>
								<th id="descuento">Descuento (%)<br>
										<input type="text" ng-model="filtro_descuento" ng-change="add_filter('descuento',filtro_descuento)">
								</th>
								<th id="estado">Estado<br>
									<select ng-model="filtro_estado" ng-change="add_filter('estado',filtro_estado)" autocomplete="off" >
										<option value="">Sin filtro</option>
										<option ng-repeat="estado in estados" ng-if="cookie.estado != estado.estado" value="{{estado.estado}}">
											{{estado.descEstado}}
										</option>
										<option ng-repeat="estado in estados" ng-if="cookie.estado == estado.estado" value="{{estado.estado}}" selected="selected">
											{{estado.descEstado}}
										</option>
									</select>
								</th>
								<th id="fecha">Fecha de Cierre<br></th>
								<th id="accion">Acción<br></th>
								</tr>
								</thead>
								<tbody>	<!-- Aqui se contiene la tabla de datos -->
								<tr ng-repeat="promo in promos track by $index">
									<td id="fecha" >{{promo.fmin}}</td>
									<td id="codigo">{{promo.cdgo}}</td>
									<td id="descrip">{{promo.dscr}}</td>
									<td id="tipo">{{promo.descTipo}}</td>
									<td id="descuento" >{{promo.dscn}}</td>
									<td id="estado" >{{promo.descEstado}}</td>
									<td id="fecha" >{{promo.fmax}}</td>
									<td id="accion">
										<span><a class="registro" href="#" ng-click="editar(promo)">
										<img src="../adminResources/editar.png" alt="Editar información de Promoción">
										</a></span>
										<span><a class="registro" href="#" ng-click="deletePromo(promo.cdgo)">
										<img src="../adminResources/borrar.png" alt="Eliminar promoción">
										</a></span>
									</td>
								</tr>
							</tbody>
						</table>
					</div>

					<!-- Cuando se encuentra en modo de edicion se muestra este div -->
					<div class="panel-body" ng-if="editMode">
						<!-- se inicializan los campos del formulario-->
						<!-- al enviar el formulario se llama a la funcion updatePromo -->
						<form accept-charset='UTF-8' ng-init='
							initial.fmin=editModeData.fmin;
							initial.fmax=editModeData.fmax;
							initial.codigo=editModeData.cdgo;
							initial.descrip=editModeData.dscr;
							initial.tipo=editModeData.tipo;
							initial.estado=editModeData.estado;
							initial.descuento=editModeData.dscn;
							updateScope(initial.tipo);
						' ng-submit='updatePromo(editModeData.cdgo,initial.fmin,initial.fmax,initial.descrip,initial.tipo,initial.estado,initial.descuento,list)'>

						<label>Código Promocional:</label> {{editModeData.cdgo}}
						<br>
						<label>Descripción:</label> <input type="text" max-length="50" ng-model="initial.descrip" required>
						<a href="#" ng-click="initial.descrip=editModeData.dscr"><img src="../adminResources/rollback.png" style="margin-left:1rem" title="Restablecer"></a>
						<br>
						<label>Inicio de la Promoción:</label> <input type="text" ng-model="initial.fmin"  required>
						<a href="#" ng-click="initial.fmin=editModeData.fmin"><img src="../adminResources/rollback.png" style="margin-left:1rem" title="Restablecer"></a>
						<br>
						<label>Fin de la Promoción:</label> <input type="text" ng-model="initial.fmax"  required>
						<a href="#" ng-click="initial.fmax=editModeData.fmax"><img src="../adminResources/rollback.png" style="margin-left:1rem" title="Restablecer"></a>
						<br><br>
						<label>Tipo de Asignación:</label>
						<table width="300px">
							<tr>
								<td><center>
									<input ng-if="initial.tipo == 'Unico'" type="radio" name="asgn" ng-model="initial.tipo" value="Unico" required ng-change="change_onEdit(initial.tipo)" checked=checked>
									<input ng-if="initial.tipo != 'Unico'" type="radio" name="asgn" ng-model="initial.tipo" value="Unico" required ng-change="change_onEdit(initial.tipo)">
								</center></td>
								<td><center>
									<input ng-if="initial.tipo == 'Masivo'" type="radio" name="asgn" ng-model="initial.tipo" value="Masivo" required ng-change="change_onEdit(initial.tipo)" checked=checked>
									<input ng-if="initial.tipo != 'Masivo'" type="radio" name="asgn" ng-model="initial.tipo" value="Masivo" required ng-change="change_onEdit(initial.tipo)">
								</center></td>
								<td><center>
									<input ng-if="initial.tipo == 'Multiple'" type="radio" name="asgn" ng-model="initial.tipo" value="Multiple" required ng-change="change_onEdit(initial.tipo)" checked=checked>
									<input ng-if="initial.tipo != 'Multiple'" type="radio" name="asgn" ng-model="initial.tipo" value="Multiple" required ng-change="change_onEdit(initial.tipo)">
								</center></td>
							</tr>
							<tr>
								<td><center>Unico</center></td>
								<td><center>Masivo</center></td>
								<td><center>Multiple</center></td>
							</tr>
						</table>
						<br><br>
						<label>Descuento a aplicar</label>
						<select ng-model="initial.descuento" autocomplete="off" required>
							<option ng-repeat="descuento in descuentos" value="{{descuento.descuento}}" ng-if="initial.descuento != descuento.descuento" >{{descuento.descDescuento}}</option>
							<option ng-repeat="descuento in descuentos" value="{{descuento.descuento}}" ng-if="initial.descuento == descuento.descuento" selected="selected">{{descuento.descDescuento}}</option>
						</select><br>

						<div class="row" ng-if="!mostrar">
						<div class="col-md-6"><fieldset><div class="form-group">
						<label>Busque los clientes a quienes les asignará el código (Nombre o Correo)</label>
						<input style="width: 100%;" type="text" ng-model="buscar" ng-change="searching(buscar)"><br>
						<select style="width: 100%; height:100px" multiple>
						<option ng-repeat="user in filtered" ng-dblclick="addUser(user)" value="{{ user }}">{{ user.nombre | capitalize }} ({{user.correo}})</option>
						</select>
						</div></fieldset></div>
						<div class="col-md-6"><fieldset><div class="form-group">
						<label>Lista de clientes que podrán usar el código</label>
						<select style="width: 100%; height:120px"  multiple>
						<option ng-dblclick="list.splice($index,1)" ng-repeat="user in list" value="{{ user }}">{{ user.nombre | capitalize }} ({{user.correo}})</option>
						</select>
						</div></fieldset></div>
						</div>
						<br>

						<label>Estado de la Promoción</label>
						<select ng-model="initial.estado" autocomplete="off" required>
							<option ng-repeat="estado in estados" value="{{estado.estado}}" ng-if="initial.estado != estado.estado" >{{estado.descEstado}}</option>
							<option ng-repeat="estado in estados" value="{{estado.estado}}" ng-if="initial.estado == estado.estado" selected="selected">{{estado.descEstado}}</option>
						</select>
						<br> <br>

						<input type="submit" value="Guardar cambios">
						<input type="button" ng-click="Cancel_EditMode()" value="Cancelar">
						</form>


						<div style="clear:both"></div>

					</div>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- Se llama a endAdmin del layout general -->
<?php $_GET['section']='endAdmin'; require('../layout.php'); ?>
<script src="js/controller.promosAdmin.js"></script> <!-- Controlador para la vista -->
  </body>
</html>
