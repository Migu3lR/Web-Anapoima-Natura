<?php
session_start();
$rol = "";
if(isset($_SESSION['rol'])) $rol = $_SESSION['rol'];
if ($rol!="1") {
	header("HTTP/1.1 403 Unauthorized");
	echo "¡ACCESO DENEGADO!";
	exit;	
}
?>

<!DOCTYPE html>
<html ng-app="app">
  <head>
    <title>ADMINISTRACION NATURA</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- jQuery UI -->
    <link href="https://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css" rel="stylesheet" media="screen">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">
	
	 <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link href="vendors/form-helpers/css/bootstrap-formhelpers.min.css" rel="stylesheet">
    <link href="vendors/select/bootstrap-select.min.css" rel="stylesheet">
    <link href="vendors/tags/css/bootstrap-tags.css" rel="stylesheet">

	<link href="css/structure.css" rel="stylesheet">
	<link href="css/design.css" rel="stylesheet">
	
	
	<!-- Natura System -->
	<script src="../js/jinqjs.js"></script>
	<script src="../js/moment.js"></script>
	<script src="../js/angular.min.js"></script>
	<script type="text/javascript" src="../js/ngDialog.js"></script>     
	<script src="../js/Chart.js"></script>
	<script src="../js/angular-moment.js"></script>
	<script src="../js/angular-chart.js"></script>
	<script src="../js/cookies.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body ng-controller="control" ng-cloak>

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
	                          <li><a href="/login/logout.php">Logout</a></li>
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
								  <li><img src="images/star5.png">
								  <a class="star" href="#" ng-click="goto_filter('rate',5)">{{stats.rate5}}</a></li>
								  <li><img src="images/star4.png">
								  <a class="star" href="#" ng-click="goto_filter('rate',4)">{{stats.rate4}}</a></li>
								  <li><img src="images/star3.png">
								  <a class="star" href="#" ng-click="goto_filter('rate',3)">{{stats.rate3}}</a></li>
								  <li><img src="images/star2.png">
								  <a class="star" href="#" ng-click="goto_filter('rate',2)">{{stats.rate2}}</a></li>
								  <li><img src="images/star1.png">
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

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
	<!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <script src="vendors/form-helpers/js/bootstrap-formhelpers.min.js"></script>
    <script src="vendors/select/bootstrap-select.min.js"></script>
    <script src="vendors/tags/js/bootstrap-tags.min.js"></script>
    <script src="vendors/mask/jquery.maskedinput.min.js"></script>
    <script src="vendors/wizard/jquery.bootstrap.wizard.min.js"></script>
     <!-- bootstrap-datetimepicker -->
     <link href="vendors/bootstrap-datetimepicker/datetimepicker.css" rel="stylesheet">
     <script src="vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.js"></script> 


    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
	<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
	
	<script src="js/natura.js"></script>
	
  </body>
</html>