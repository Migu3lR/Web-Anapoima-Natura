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

	<link rel="stylesheet" href="css/ngDialog.css"></script>
    <link rel="stylesheet" href="css/ngDialog-theme-default.css"></script>
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
                    <li><a href="index.php"><i class="glyphicon glyphicon-home"></i> Escritorio</a></li>
                    <li class="current"><a href="gestion.php"><i class="glyphicon glyphicon-calendar"></i> Gestion</a></li>
                    <li><a href="calidad.php"><i class="glyphicon glyphicon-stats"></i> Calidad</a></li>
                    
                </ul>
             </div>
		  </div>
		  <div class="col-md-10">
		  	<div class="row">
		  		<div class="col-md-12">
		  			<div class="content-box">
		  				<div class="panel-heading">
							<div class="panel-title">Gestion de Comentarios</div>
						</div>
		  				<div class="panel-body">

						<div class="tabla">
						  <div class="thead">
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
						  <div class="tbody">							
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
