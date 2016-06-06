<!doctype html>
<html class="no-js" lang="en" ng-app="app">
<head>
	<meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Natura Anapoima</title>
	<link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900' rel='stylesheet' type='text/css'>
	<!-- Frontend FrameWork CSS -->
    <link rel="stylesheet" href="css/foundation.css" /> 
	<link rel="stylesheet" href="css/structure.css">
	<link rel="stylesheet" href="css/design.css">
	
</head>
<body ng-controller="control">
<?php
session_start();
$rol = "";
if(isset($_SESSION['rol'])) $rol = $_SESSION['rol'];
if($rol != "1") header("Location: /pruebas3/");
?>


<div class="row">
	<div class="callout large">
		<div class="row text-center">
			<h1>ADMINISTRACIÓN NATURA</h1>
		</div>
	</div>
</div>
<div class="row">
	<div class="callout large">
		<div class="row small-up-1 medium-up-3 large-up-3">
			<div class="column text-center">
				<a href="#">
					<img src="img/usuarios.png" width="200px"/>
					<h4>Administración de Usuarios</h4>
				</a>
			</div>
			<div class="column text-center">
				<a href="../promocodesAPP/administrar.php">
					<img src="img/promos.png" width="200px"/>
					<h4>Administracion de Códigos Promocionales</h4>
				</a>
			</div>
			<div class="column text-center">
				<a href="../booking/">
					<img src="img/reservas.png" width="200px"/>
					<h4>Administración de Reservaciones</h4>
				</a>
			</div>
		</div>
	</div>
</div>


	<script src="js/foundation.min.js"></script>
	<script src="js/app.js"></script>
	
</body>
</html>