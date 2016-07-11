<!doctype html>
<html class="no-js" lang="en" ng-app="app">
<head>
	<?php $_GET['section']='initSite'; require('../layout.php'); ?> 
	
	<link rel="stylesheet" href="css/structure.css">
	<link rel="stylesheet" href="css/design.css">
	
	<script src="/js/angular-animate.js"></script>	
	
</head>
<body ng-controller="control">

<div ng-init="form=false" class="form">
	<div class="row">
	<div class="callout small">
		<div class="row text-center">
			<div class="tabs">
				<div id="signup" class="tab">
				<a ng-click="form=true" href="#signup">Registrarse</a>
				</div>
				<div id="signin" class="tab active">
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
				<form name="registro" accept-charset="UTF-8" ng-submit="signup(nombre, correo, correoCnf, clave, claveCnf, fecha, telefono, nacionalidad, municipio)">
					<div class="row">
						<div class="column">
							<label ng-class="valid.nombre ? '' : 'error'">Nombre<span class="req">*</span>
							  <div ng-if="!valid.nombre" class="tooltip">
							  Ingrese solo caracteres alfabeticos. Minimo 5 letras, maximo 50.
							  </div>
							</label>
							<input ng-model="nombre" type="text" autocomplete="off" required />
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
	<script src="/js/Foundation.js"></script>
	
	<script src="js/controller.Login.js"></script>
		
</body>
</html>