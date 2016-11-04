<!DOCTYPE html>
<html ng-app="app">
  <head>
  <!-- Se llama a initAdmin del layout general -->
	<?php $_GET['section']='initAdmin'; require('../layout.php'); ?>
	<script src="../js/angular-hmac-sha512.js"></script><!-- libreria para encriptacion sha512 -->

	<link href="css/structure.css" rel="stylesheet">
	<link href="css/design.css" rel="stylesheet">
  </head>
  <body ng-controller="control" ng-cloak >
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
								  <li>Aprobados <a href="#" ng-click="goto_filter('estado',1)">{{stats.aprobado}}</a></li>
								  <li>Por aprobar <a href="#" ng-click="goto_filter('estado',0)">{{stats.pendiente}}</a></li>
								  <li>Multiples <a href="#" ng-click="goto_filter('tipo','Multiple')">{{stats.multiple}}</a></li>
								  <li>Masivos <a href="#" ng-click="goto_filter('tipo','Masivo')">{{stats.masivo}}</a></li>
								  <li>Unicos <a href="#" ng-click="goto_filter('tipo','Unico')">{{stats.unico}}</a></li>
							</ul>
		  				</div>
		  			</div>
		  		</div>

		  		<div class="col-md-10">
		  			<div class="row">
		  				<div class="col-md-12">
		  					<div class="content-box-header">
			  					<div class="panel-title">Crear un nuevo código promocional:</div>
				  			</div>
				  			<div class="content-box-large box-with-header">
							  <!-- Se invoca funcion newCode al enviar formulario, definido dentro del controlador -->
				  				<form accept-charset="UTF-8" ng-submit="newCode();">
									<fieldset>
										<div class="form-group">
											<label>Descripción de la Promoción</label>
											<input ng-model="dscr" class="form-control" placeholder="Escriba aqui la descripcion de la promoción a crear" size="31" type="text" required>
										</div>
									</fieldset>
									<fieldset>
										<div class="form-group">
											<label>Tipo de Asignación</label>
											<table width="300px">
												<tr>
													<td><center><input type="radio" name="asgn" ng-model="asgn" value="Unico" required ng-change="change()"></center></td>
													<td><center><input type="radio" name="asgn" ng-model="asgn" value="Masivo" required ng-change="change()"></center></td>
													<td><center><input type="radio" name="asgn" ng-model="asgn" value="Multiple" required ng-change="change()"></center></td>
												</tr>
												<tr>
													<td><center>Unico</center></td>
													<td><center>Masivo</center></td>
													<td><center>Multiple</center></td>
												</tr>
											</table>
										</div>
									</fieldset>
									<div class="row" ng-if="!mostrar">
		  								<div class="col-md-6">
											<fieldset>
												<div class="form-group">
													<label>Busque los clientes a quienes les asignará el código (Nombre o Correo)</label>
													<input style="width: 100%;" type="text" ng-model="buscar" ng-change="searching(buscar)"><br>
													<select style="width: 100%; height:100px" multiple>
													<option ng-repeat="user in filtered" ng-dblclick="addUser(user)" value="{{ user }}">{{ user.nombre | capitalize }} ({{user.correo}})</option>
													</select>
												</div>
											</fieldset>
										</div>
										<div class="col-md-6">
											<fieldset>
												<div class="form-group">
													<label>Lista de clientes que podrán usar el código</label>
													<select style="width: 100%; height:120px"  multiple>
													<option ng-dblclick="list.splice($index,1)" ng-repeat="user in list" value="{{ user }}">{{ user.nombre | capitalize }} ({{user.correo}})</option>
													</select>
												</div>
											</fieldset>
										</div>
									</div>
									<div class="row" >
		  								<div class="col-md-6">
											<fieldset>
												<div class="form-group">
													<label>Fecha de Inicio de la Promoción</label>
													<input ng-model="fmin" type="date" name="fmin" id="fmin" min="2016-01-01" max="2016-12-31" required>
												</div>
											</fieldset>
										</div>
										<div class="col-md-6">
											<fieldset>
												<div class="form-group">
													<label>Fecha de Finalización de la Promoción</label>
													<input ng-model="fmax" type="date" name="fmax" id="fmax" min="2016-01-01" max="2016-12-31" required>
												</div>
											</fieldset>
										</div>
									</div>
									<fieldset>
										<div class="form-group">
											<label>Descuento a aplicar</label>
											<select name="dscn" id="dscn" ng-model="dscn" required>
												<option value="5">5%</option>
												<option value="10">10%</option>
												<option value="15">15%</option>
											</select>
										</div>
									</fieldset>
									<div>
										<input type="submit" value="Crear Código" name="solc">
									</div>
								</form>
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
<script src="js/controller.promosAdmin.js"></script> <!-- Controlador para la vista -->

  </body>
</html>