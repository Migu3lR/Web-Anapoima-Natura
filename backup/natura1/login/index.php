<?php
session_start();
$rol = "";
if(isset($_SESSION['rol'])) $rol = $_SESSION['rol'];
if($rol == "0") header("Location: ../pruebas3/");
if($rol == "1") header("Location: ../pruebas3/");
?>
﻿<!doctype html>
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
	<script src="js/angular.min.js"></script>	
	<script src="js/angular-animate.js"></script>	
	<script src="js/angular-hmac-sha512.js"></script>
	<script src="js/control.js"></script>

</head>
<body ng-controller="control">

<div ng-init="form=true" class="form">
	<div class="row">
	<div class="callout small">
		<div class="row text-center">
			<div class="tabs">
				<div id="signup" class="tab active">
				<a ng-click="form=true" href="#signup">Registrarse</a>
				</div>
				<div id="signin" class="tab">
				<a ng-click="form=false" href="#signin">Iniciar Sesión</a>
				</div>
			</div>
		</div>
	</div>
	</div>
	<div ng-if="form" class="row sign">
		<div class="callout small">
			<div class="row text-center">
				<h1>Registrate</h1>
			</div>
			<div class="row">
			<div class="callout small">
				<form name="registro" accept-charset="UTF-8" ng-submit="signup(nombre, apellido, correo, correoCnf, clave, claveCnf, fecha, telefono, tipo, documento, nacionalidad, municipio)">
					<div class="row small-up-2 medium-up-2 large-up-2">
						<div class="column">
							<label ng-class="valid.nombre ? '' : 'error'">Nombre<span class="req">*</span>
							  <div ng-if="!valid.nombre" class="tooltip">
							  Ingrese solo caracteres alfabeticos. Minimo 3 letras, maximo 20.
							  </div>
							</label>
							<input ng-model="nombre" type="text" autocomplete="off" required />
						</div>
						<div class="column">
							<label ng-class="valid.apellido ? '' : 'error'">Apellido<span class="req">*</span>
							  <span ng-if="!valid.apellido" class="tooltip">
							  Ingrese solo caracteres alfabeticos. Minimo 3 letras, maximo 20.
							  </span>
							</label>
							<input ng-model="apellido" type="text" autocomplete="off" required />
						</div>
					</div>
					<div class="row small-up-2 medium-up-2 large-up-2">
						<div class="column">
							<label ng-class="valid.correo ? '' : 'error'">Correo<span class="req">*</span>
							  <span ng-if="!valid.correo" class="tooltip">
							  Debe ingresar un correo valido.
							  </span>
							</label>
							<input ng-model="correo" type="email" autocomplete="off"  required />
						</div>
						<div class="column">
							<label ng-class="valid.correoCnf ? '' : 'error'">Confirmación de correo<span class="req">*</span>
							  <span ng-if="!valid.correoCnf" class="tooltip">
							  Debe ingresar el mismo correo que en el campo anterior.
							  </span>
							</label>
							<input ng-model="correoCnf" type="email" autocomplete="off"  required />
						</div>
					</div>
					<div class="row small-up-2 medium-up-2 large-up-2">
						<div class="column">
							<label ng-class="valid.clave ? '' : 'error'">Contraseña<span class="req">*</span>
							  <span ng-if="!valid.clave" class="tooltip">
							  La contranseña debe ser de minimo 8 caracteres.
							  </span>
							</label>
							<input ng-model="clave" type="password" autocomplete="off"  required />
						</div>
						<div class="column">
							<label ng-class="valid.claveCnf ? '' : 'error'">Confirmación contraseña<span class="req">*</span>
							  <span ng-if="!valid.claveCnf" class="tooltip">
							  Debe ingresar la misma contraseña que en el campo anterior.
							  </span>
							</label>
							<input ng-model="claveCnf" type="password" autocomplete="off"  required />
						</div>
					</div>
					<div class="row small-up-2 medium-up-2 large-up-2">
						<div class="column">
							<label>Fecha de nacimiento<span class="req">*</span>
							</label>
							<input ng-model="fecha" type="date" autocomplete="off">
						</div>
						<div class="column">
							<label ng-class="valid.telefono ? '' : 'error'">Celular<span ng-if="!valid.telefono" class="tooltip">
							  Teléfono invalido, solo debe ingresar datos númericos.
							  </span>
							</label>
							<input ng-model="telefono" type="text" autocomplete="off" />
						</div>
					</div>
					<div class="row small-up-2 medium-up-2 large-up-2">
						<div class="column">
							<label>Tipo de documento<span class="req">*</span>
							</label>
							<select ng-model="tipo" >
								<option value="1">Cédula de Ciudadanía</option>
								<option value="2">Cédula de Extranjería</option>
								<option value="3">Tarjeta de Identidad</option>
							</select>
						</div>
						<div class="column">
							<label ng-class="valid.documento ? '' : 'error'">Número de documento<span class="req">*</span>
							<span ng-if="!valid.documento" class="tooltip">
							  Documento invalido, solo debe ingresar datos númericos.
							  </span>
							</label>
							<input ng-model="documento" type="text" autocomplete="off"  required />
						</div>
					</div>
					<div class="row small-up-2 medium-up-2 large-up-2">
						<div class="column">
							<label ng-class="valid.nacionalidad ? '' : 'error'">Nacionalidad<span class="req">*</span>
							<span ng-if="!valid.nacionalidad" class="tooltip">
							  Ha ingresado datos invalidos, solo se permiten caracteres alfabeticos. Minimo 3 caracteres, maximo 20.
							  </span>
							</label>
							<input ng-model="nacionalidad" type="text" autocomplete="off"  required />
						</div>
						<div class="column">
							<label ng-class="valid.municipio ? '' : 'error'">Municipio<span class="req">*</span>
							<span ng-if="!valid.municipio" class="tooltip">
							  Ha ingresado datos invalidos, solo se permiten caracteres alfabeticos. Minimo 3 caracteres, maximo 20.
							  </span>
							</label>
							<input ng-model="municipio" type="text" autocomplete="off"  required />
						</div>
					</div>
					
					<div class="row text-center">
						<button type="submit" class="promo_button button" />Unete a Natura</button>
					</div>
					<div ng-show="showError && eUp" class="row text-center" style="color:red">
					<p>{{ msg }}</p>
					</div>
				</form>
			</div>
			</div>			
		</div>
	</div>
	<div ng-if="!form" class="row sign">
		<div class="callout small">
			<div class="row text-center">
				<h1>¡Bienvenido!</h1>
			</div>
			<div class="row">
			<div class="callout small">
				<form name="inicio" accept-charset="UTF-8" ng-submit="signin(correoIn, claveIn)">
					<div class="row">
						<div class="column">
							<label ng-class="valid.correoIn ? '' : 'error'">Correo<span class="req">*</span>
							<span ng-if="!valid.correoIn" class="tooltip">
							  Debe ingresar un correo.
							  </span>
							</label>
							<input ng-model="correoIn" type="email" autocomplete="off" />
						</div>
					</div>
					<div class="row">
						<div class="column">
							<label ng-class="valid.claveIn ? '' : 'error'">Contraseña<span class="req">*</span>
							<span ng-if="!valid.claveIn" class="tooltip">
							  Debe ingresar una contraseña.
							  </span>
							</label>
							<input ng-model="claveIn" type="password" autocomplete="off" />
						</div>
					</div>
				      <div class="row text-center">
					<button type="submit" class="promo_button button" />Entrar</button>
                                      </div>
                                      <div ng-show="showError && eIn" class="row text-center" style="color:red">
					<p>{{ msg }}</p>
			              </div>
				</form>
			</div>
			</div>
		</div>
    </div>
</div>

	<script src="/js/vendor/jquery.min.js"></script>
	<script src="js/login.js"></script>
	<script src="js/foundation.min.js"></script>
	<script src="js/app.js"></script>
	
</body>
</html>