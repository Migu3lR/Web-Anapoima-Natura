<!DOCTYPE html>
<html ng-app="app">
  <head>
	<?php $_GET['section']='initAdmin'; require('../layout.php'); ?> <!-- Se invoca initAdmin del layout general -->
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
                    <li><a href="gestion.php"><i class="glyphicon glyphicon-calendar"></i> Gestion</a></li>
                    <li class="current"><a href="calidad.php"><i class="glyphicon glyphicon-stats"></i> Calidad</a></li>

                </ul>
             </div>
		  </div>

			 <!-- Este div contiene la seccion de calidad -->
			<div class="col-md-10">
			<div class="row">
			<div class="col-md-12">
			<div class="content-box">
			<div class="panel-heading">
				<div class="panel-title">Gestion de la Calidad</div>
			</div>
		  	<div class="panel-body">
				<!-- El grafico es embebido en la pagina por medio de este canvas -->
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

    <?php $_GET['section']='endAdmin'; require('../layout.php'); ?>  <!-- Se invoca endAdmin del layout general -->
	<script src="js/controller.comentAdmin.js"></script> <!-- Controlador para la vista -->

  </body>
</html>