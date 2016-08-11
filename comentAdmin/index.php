<!DOCTYPE html>
<html ng-app="app">
  <head>
	<?php $_GET['section']='initAdmin'; require('../layout.php'); ?>
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
	                 <h1><a href="index.html">Sistema de Comentarios</a></h1>
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

    <div class="page-content">
    	<div class="row">
		  <div class="col-md-2">
		  	<div class="sidebar content-box" style="display: block;">
                <ul class="nav">
                    <!-- Main menu -->
                    <li class="current"><a href="index.php"><i class="glyphicon glyphicon-home"></i> Escritorio</a></li>
                    <li><a href="gestion.php"><i class="glyphicon glyphicon-calendar"></i> Gestion</a></li>
                    <li><a href="calidad.php"><i class="glyphicon glyphicon-stats"></i> Calidad</a></li>
                    
                </ul>
             </div>
		  </div>
		  <div class="col-md-10">
		  	<div class="row">
		  		<div class="col-md-2">
		  			<div class="content-box">
		  				<div class="panel-heading">
							<div class="panel-title">Generales</div>
						</div>
		  				<div class="panel-body">
		  					<ul class="general_stats">
								  <li>Pendientes <a href="#" ng-click="goto_filter('estado','P')">{{stats.pendiente}}</a></li>
								  <li>Aprobados <a href="#" ng-click="goto_filter('estado','A')">{{stats.aprobado}}</a></li>
								  <li>Rechazados <a href="#" ng-click="goto_filter('estado','R')">{{stats.rechazado}}</a></li>
								  <li>Publicados <a href="#" ng-click="goto_filter('publicar','S')">{{stats.publicar}}</a></li>
								  <li>No Publicados <a href="#" ng-click="goto_filter('publicar','N')">{{stats.nopublicar}}</a></li>
							</ul>
							
		  				</div>
		  			</div>
		  		</div>

		  		<div class="col-md-7">
		  			<div class="row">
		  				<div class="col-md-12">
		  					<div class="content-box-header">
			  					<div class="panel-title">Enviar Solicitud para Comentar</div>
				  			</div>
				  			<div class="content-box-large box-with-header">
				  				<form accept-charset="UTF-8" ng-submit="newToken(nombre,correo)">
									<fieldset>
										<div class="form-group">
											<label>Nombre</label>
											<input ng-model="nombre" class="form-control" placeholder="Nombre y apellidos del cliente" type="text">
										</div>
										<div class="form-group">
											<label>Correo Electronico</label>
											<input ng-model="correo" class="form-control" placeholder="Correo electronico del cliente" type="text">
										</div>
									</fieldset>
									<div>
										<input type="submit" value="Enviar solicitud" name="solc">
									</div>
								</form>
							</div>
		  				</div>
		  			</div>
		  		</div>
				  
				  
				<div class="col-md-3">
		  			<div class="row">
		  				<div class="col-md-12">
		  					<div class="content-box-header">
			  					<div class="panel-title">Calificacion Visitantes</div>
			  				</div>
				  			<div class="content-box-large box-with-header">
				  				<h1 class="calificacion">{{ prom | currency:'' }}</h1>
							</div>
		  				</div>
		  			</div>
					  
					<div class="row">
		  				<div class="col-md-12">
		  					<div class="content-box-header">
			  					<div class="panel-title">Calificacion Visitantes</div>
				  			</div>
				  			<div class="content-box-large box-with-header">
				  				<ul class="general_stats">
								  <li><img src="../images/comentarios/star5.png">
								  <a class="star" href="#" ng-click="goto_filter('rate',5)">{{stats.rate5}}</a></li>
								  <li><img src="../images/comentarios/star4.png">
								  <a class="star" href="#" ng-click="goto_filter('rate',4)">{{stats.rate4}}</a></li>
								  <li><img src="../images/comentarios/star3.png">
								  <a class="star" href="#" ng-click="goto_filter('rate',3)">{{stats.rate3}}</a></li>
								  <li><img src="../images/comentarios/star2.png">
								  <a class="star" href="#" ng-click="goto_filter('rate',2)">{{stats.rate2}}</a></li>
								  <li><img src="../images/comentarios/star1.png">
								  <a class="star" href="#" ng-click="goto_filter('rate',1)">{{stats.rate1}}</a></li>
								</ul>
							</div>
		  				</div>
		  			</div>
		  		</div>
		  	</div>	  
		</div>
	  </div>
    </div>

	<?php $_GET['section']='endAdmin'; require('../layout.php'); ?>    
	<script src="js/controller.comentAdmin.js"></script>
	
  </body>
</html>