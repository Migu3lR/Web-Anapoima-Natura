//Controlador para la vista index.php y gestion.php
app = angular.module("app", ['angular-jwt', 'angular-storage', 'chart.js', 'ngCookies', 'angularMoment', 'ngDialog', 'angular-hmac-sha512']);
app.config(['ChartJsProvider', function (ChartJsProvider) {
	// Configure all charts
	ChartJsProvider.setOptions({
		colours: ['#FF5252', '#FF8A80'],
		responsive: true
	});
	// Configure all line charts
	ChartJsProvider.setOptions('Area', {
		datasetFill: false
	});
}]);
app.controller("control", function ($scope, $window, $http, $interval, $cookies, ngDialog, jwtHelper, store, $location, $crypthmac) {
	//Variables de codigos de error en Back-End(Ver /api/index.php)
	var db_isdown = 521;
	var db_unknown_error = 520;
	var access_forbidden = 500;
	var error_send_mail = 501;
	var user_conflict = 409;
	var bad_insert_request = 400;
	var user_not_found = 404;
	var invalid_password = 402
	var user_created = 201;
	var user_accepted = 202;
	var pass_changed = 203;
	var user_unauthorized = 401;
	var response_ok = 0;

	//Funcion para definir accion ante acceso denegado
	var access_forbidden = function () {
		var token = store.get("token") || null;
		if (token) store.remove("token"); //Si el usuario que intenta acceder se encuentra logeado con un token en el WebStorage, se elimina el token
		var url = store.get("url") || null;
		if (url) store.remove("url"); //Tambien se elmina url de retorno si se encuentra almacenada
		$window.location = '../login/'; //Se envia al usuario a login
	}

	//Al acceder a este sitio se almacena url de retorno, en caso de salida retornable
	var url = function () { store.set('url', $location.absUrl()); }

	$scope.goLogin = function () { url(); $window.location = '../login/'; } //Al llamar esta funcion nos envia a login
	$scope.goLogout = function () { url(); $window.location = '../login/logout.php'; } //Al llamar a esta funcion nos envia a logout

	//Usuario Autorizado?
	//obtenemos el token en localStorage
	//decodificamos para obtener los datos del user
	//los mandamos a la vista como user
	var auth = function () {
		var token = store.get("token") || null;
		if (token) {
			if (jwtHelper.isTokenExpired(token)) {
				store.remove("token");
				return false;
			}
			else {
				$scope.user = jwtHelper.decodeToken(token);
				if ($scope.user.rol == 1) return true; //Se consula si el usuario tiene permisos de Administrador para poder continuar
				else return false;
			}
		} else return false;
	}
	$scope.isAuth = auth();

	if (!$scope.isAuth) access_forbidden(); // Si el usuario no esta autorizado correctamente se llama a Acceso Denegado.
	else {

		//Se inicializan variables de Grafico mostrado en index.php
		$scope.labels = [];
		$scope.data = [];
		$scope.series = ['Registros por Mes']; //Label del eje X del grafico
		$scope.onClick = function (points, evt) {
			//Al hacer clic en alguno de los puntos graficados, esto nos envia a gestion.php con el filtro de la fecha seleccionada
			if (points[0] !== undefined) $scope.goto_filter('fecha', points[0].label);
		};

		var dataUsers = []; //Se inicializa variable que contendra la informacion de los usuarios en base de datos

		$scope.stats = { //Se inicializa variable JSON que contendra los datos de los KPI a mostrar en index.php
			registrado: 0,
			noregistrado: 0,
			frecuente: 0,
			ocasional: 0
		}

		//variable con la descripcion de los posibles estados de comentarios en Base de datos para mostrar en gestion.php
		var estados = [{ estado: 'A', descEstado: 'Activo' },
		{ estado: 'I', descEstado: 'Inactivo' },
		{ estado: 'P', descEstado: 'Pendiente' },];
		$scope.estados = estados;

		//variable con la descripcion de los posibles roles de usuario en Base de datos para mostrar en gestion.php
		var roles = [{ rol: 0, descRol: 'Cliente' },
		{ rol: 1, descRol: 'Administrador' }];
		$scope.roles = roles;

		//variable con los valores de los posibles tipos de frecuencia de los clientes en Base de datos para mostrar en gestion.php
		var frecuencias = [{ frecuencia: 'Frecuente', cond: true },
		{ frecuencia: 'Ocasional', cond: false }];
		$scope.frecuencias = frecuencias;

		//variable con la descripcion de los posibles fuentes de registro de usuarios en la en Base de datos para mostrar en gestion.php
		var fuentes = [{ fuente: 'R', descFuente: 'Registro' },
		{ fuente: 'C', descFuente: 'Comentarios' },
		{ fuente: 'B', descFuente: 'Reservas' }];
		$scope.fuentes = fuentes;

		$scope.usuarios = []; //Variable para enviar los datos de los usuarios a la vista en gestion.php
		var inicio = 0;

		var updateTable = function (data) { //Al llamar a updateTable se cargan datos en variable usuarios para actualizar la vista.
			$scope.usuarios = data;

			return;
		}

		//Se inicializan filtros
		var filters = {
			nombre_correo: null,
			nombre: null,
			correo: null,
			estado: null,
			fecha: null,
			rol: null,
			frecuencia: null,
			fuente: null
		};

		$scope.encontrados = 0 ///Contar registros encontrados con la busqueda
		$scope.filtro_busqueda = false; ///Flag para mostrar info referente a las busquedas.
		//En la funcion query se realizan todos los filtros para mostrar en gestion.php y tambien se cargan los datos para los KPI
		var query = function () {

			var frecVar = (moment().subtract(3, 'months').format("YYYY[-]MM") + '-01');
			//Se inicializa varible con objeto de la libreria jinqJS
			var usuarios = new jinqJs()
				.from(dataUsers)
				.where(function (row) {
					//Se inicializan variables internas para control de los filtros
					var nombre_correoFilter = true;
					var nombreFilter = true;
					var correoFilter = true;
					var estadoFilter = true;
					var fechaFilter = true;
					var rolFilter = true;
					var fuenteFilter = true;

					///Filtro Busqueda por donde o correo
					if (filters.nombre_correo != null) {
						$scope.filtro_busqueda = true;

						nombre_correoFilter = (row.nombre.indexOf(filters.nombre_correo) !== -1 || row.correo.indexOf(filters.nombre_correo) !== -1);
						if (nombre_correoFilter) $scope.encontrados += 1; ///Incrementar contador de encontrados si hay coincidencia
					}
					//Se realiza filtro de informacion, dependiendo de los valores seleccionados en la vista o por filtros externos
					if (filters.nombre != null) nombreFilter = (row.nombre.indexOf(filters.nombre) !== -1);
					if (filters.correo != null) correoFilter = (row.correo.indexOf(filters.correo) !== -1);
					if (filters.estado != null) estadoFilter = (row.estado == filters.estado);
					if (filters.fecha != null) fechaFilter = (row.creacion.indexOf(filters.fecha) !== -1);
					if (filters.rol != null) rolFilter = (row.rol == filters.rol);
					if (filters.fuente != null) fuenteFilter = (row.fuente == filters.fuente);
					//Se valida que todos los filtro se cumplan para sacar la data
					return (nombre_correoFilter && nombreFilter && correoFilter && estadoFilter && fechaFilter && rolFilter && fuenteFilter);
				})
				.leftJoin(estados).on('estado') //Enlazamos las descripciones de estados
				.leftJoin(roles).on('rol') //Enlazamos las descripciones de roles
				.leftJoin(fuentes).on('fuente') //Enlazamos las descripciones de fuentes
				.join(frecuencias).on( //Enlazamos la variable frecuencias (Se calcula el tipo de frecuencia con la fecha de ultima reservacion)
				function (left, right) {
					var cond = false;
					if (left.ultimaReserva >= frecVar) cond = true;
					if (right.cond == cond) {
						var frecuenciaFilter = true;
						if (filters.frecuencia != null) frecuenciaFilter = (right.frecuencia == filters.frecuencia);
						return (frecuenciaFilter);
					}
				}
				)
				.select();

			///Las siguientes lineas es para darle la estructura al grafico de index.php
			//Se definen los valores a mostrar en el eje X
			var meses = {
				6: moment().format("YYYY[-]MM"),
				5: moment().subtract(1, 'months').format("YYYY[-]MM"),
				4: moment().subtract(2, 'months').format("YYYY[-]MM"),
				3: moment().subtract(3, 'months').format("YYYY[-]MM"),
				2: moment().subtract(4, 'months').format("YYYY[-]MM"),
				1: moment().subtract(5, 'months').format("YYYY[-]MM"),
				0: moment().subtract(6, 'months').format("YYYY[-]MM")
			}

			//Se definen los valores a mostrar en el eje Y
			var data = [];

			angular.forEach(meses, function (mes, i) {
				var graf = new jinqJs()
					.from(dataUsers)
					.where(function (row) {
						return (row.fuente == 'R' && row.creacion.indexOf(mes) == 0)
					})
					.groupBy('fuente').count('id_cln')
					.select();

				if (graf[0] !== undefined) data.push(graf[0].id_cln);
				else data.push(null);
			});

			$scope.labels = [meses[0], meses[1], meses[2], meses[3], meses[4], meses[5], meses[6]];
			$scope.data.push(data);
			///End - Grafico

			//Definicion de los KPI a mostrar en la vista index.php
			//Panel izquierdo
			$scope.stats = {
				registrado: 0,
				noregistrado: 0,
				frecuente: 0,
				ocasional: 0
			}

			var stat = new jinqJs()
				.from(dataUsers).where(function (row) { if (row.fuente == 'R') $scope.stats.registrado += 1; }).select();
			var stat = new jinqJs()
				.from(dataUsers).where(function (row) { if (row.fuente != 'R') $scope.stats.noregistrado += 1; }).select();
			var stat = new jinqJs()
				.from(dataUsers).where(function (row) { if (row.ultimaReserva >= frecVar) $scope.stats.frecuente += 1; else $scope.stats.ocasional += 1; }).select();

			//Se llama a updateTable para actualizar la tabla de datos en la vista
			updateTable(usuarios);

			return;
		}

		//Funcion add_filter genera filtros en la informacion mostrada, realizados desde la misma vista o desde un link externo
		//Se recibe el nombre del filtro y el valor a aplicar al filtro, esto llama nuevamente a la funcion query() para actualizar el filtrado
		$scope.add_filter = function (filter_name, filter_value) {
			if (filters[filter_name] !== undefined) {
				if (filter_value === "") filter_value = null;
				filters[filter_name] = filter_value;
				query();
			} else {
				alert('Filtro invalido, por favor intentelo nuevamente.');
				$window.location.reload();
			}
			return;
		}

		//Al iniciar el controlador, se invoca el metodo getUsers_a del API en Back-End
		var getUsers = function () {
			var requestUsers = $http({
				method: "post",
				url: "../api/index.php",
				headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				skipAuthorization: false,
				data: {
					action: 'getUsers_a'
				}
			});

			requestUsers.success(function (res) {
				//Si el request se realizo correctamente, se captura el token de seguridad del usuario
				if (res.response.token !== undefined) store.set('token', res.response.token);
				//Se ejecuta sentencia dependiendo de codigo de respuesta
				switch (res.code) {
					case response_ok:
						dataUsers = res.response.users;
						if (dataUsers.length > 0) query(dataUsers);
						break;
					case user_unauthorized:
						$scope.goLogin();
						break;
					case access_forbidden:
						access_forbidden();
						break;
					default:
						alert("Ha ocurrido un error inesperado, por favor comunicate con el administrador");
						break;
				}
			});
			return;

		}
		getUsers();

		//Funcion goto_filter genera un filtro a partir de algun enlace de las vistas de este controlador
		//El filtro solicitado es almacenado en un Cookie para ser capturado al cambiar de vista
		$scope.goto_filter = function (filter_name, filter_value) {
			$cookies.put(filter_name, filter_value);
			$window.location = "gestion.php"
		}

		$scope.cookie = {
			nombre: '',
			correo: '',
			estado: '',
			fecha: '',
			rol: '',
			frecuencia: '',
			fuente: ''
		}

		//Se capturan los filtros realizados de desde las otras vistas del controlador asi como los filtros externos
		if ($cookies.get('fecha') !== undefined) {
			var filter_name = 'fecha';
			var filter_value = $cookies.get('fecha');
			$scope.cookie.fecha = filter_value;
			$cookies.remove('fecha');
			$scope.add_filter(filter_name, filter_value);
			$scope.add_filter('fuente', 'R');
		}
		if ($cookies.get('estado') !== undefined) {
			var filter_name = 'estado';
			var filter_value = $cookies.get('estado');
			$scope.cookie.estado = filter_value;
			$cookies.remove('estado');
			$scope.add_filter(filter_name, filter_value);
		}
		if ($cookies.get('correo') !== undefined) {
			var filter_name = 'correo';
			var filter_value = $cookies.get('correo');
			$scope.cookie.correo = filter_value;
			$cookies.remove('correo');
			$scope.add_filter(filter_name, filter_value);
		}
		if ($cookies.get('rol') !== undefined) {
			var filter_name = 'rol';
			var filter_value = $cookies.get('rol');
			$scope.cookie.rol = filter_value;
			$cookies.remove('rol');
			$scope.add_filter(filter_name, filter_value);
		}
		if ($cookies.get('frecuencia') !== undefined) {
			var filter_name = 'frecuencia';
			var filter_value = $cookies.get('frecuencia');
			$scope.cookie.frecuencia = filter_value;
			$cookies.remove('frecuencia');
			$scope.add_filter(filter_name, filter_value);
		}
		if ($cookies.get('fuente') !== undefined) {
			var filter_name = 'fuente';
			var filter_value = $cookies.get('fuente');
			$scope.cookie.fuente = filter_value;
			$cookies.remove('fuente');
			$scope.add_filter(filter_name, filter_value);
		}

		//Funcion editar llamada para editar los datos de algun usuario, llamado desde la vista gestion.php
		$scope.editar = function (data) {
			var html = '';
			html += '<script>  $(function() {$( "#datepicker" ).datepicker({dateFormat: "yyyy-mm-dd", defaultDate: "' + data.nacimiento + '"});});</script>';
			html += '<form accept-charset="UTF-8" ng-init="';
			html += "initial.nombre='" + data.nombre + "'; ";
			html += "initial.nacimiento='" + data.nacimiento + "'; ";
			html += "initial.telefono='" + data.telefono + "'; ";
			html += "initial.pais='" + data.pais + "'; ";
			html += "initial.ciudad='" + data.ciudad + "'; ";
			html += "initial.rol='" + data.rol + "'; ";
			html += "initial.estado='" + data.estado + "'; ";
			html += "initial.fuente='" + data.fuente + "'; ";
			html += '" ng-submit="updateUser(' + data.id_cln + ',' + "'" + data.correo + "'" + ',initial.nombre,initial.nacimiento,initial.telefono,initial.pais,initial.ciudad,initial.rol,initial.estado,initial.fuente)">';

			html += 'Fecha de registro: ' + data.creacion;
			html += '<br>';
			html += 'Correo Electrónico: ' + data.correo;
			html += '<br><br>';

			html += 'Nombre del usuario: <input type="text" max-length="50" ng-model="initial.nombre" required>';
			html += '<a href="#" ng-click="initial.nombre=' + "'" + data.nombre + "'" + '"><img src="../adminResources/rollback.png" style="margin-left:1rem" title="Restablecer"></a><br>';
			html += 'Fecha de Nacimiento: <input type="text" ng-model="initial.nacimiento">';
			html += '<a href="#" ng-click="initial.nacimiento=' + "'" + data.nacimiento + "'" + '"><img src="../adminResources/rollback.png" style="margin-left:1rem" title="Restablecer"></a><br>';
			html += 'Teléfono: <input type="text" max-length="10" ng-model="initial.telefono">';
			html += '<a href="#" ng-click="initial.telefono=' + "'" + data.telefono + "'" + '"><img src="../adminResources/rollback.png" style="margin-left:1rem" title="Restablecer"></a><br>';
			html += 'País: <input type="text" max-length="20" ng-model="initial.pais" >';
			html += '<a href="#" ng-click="initial.pais=' + "'" + data.pais + "'" + '"><img src="../adminResources/rollback.png" style="margin-left:1rem" title="Restablecer"></a><br>';
			html += 'Ciudad: <input type="text" max-length="20" ng-model="initial.ciudad" >';
			html += '<a href="#" ng-click="initial.ciudad=' + "'" + data.ciudad + "'" + '"><img src="../adminResources/rollback.png" style="margin-left:1rem" title="Restablecer"></a><br><br>';

			html += 'Rol: <select ng-model="initial.rol" autocomplete="off" required>';
			html += '<option ng-repeat="rol in roles" value="{{rol.rol}}" ng-if="initial.rol != rol.rol" >{{rol.descRol}}</option>';
			html += '<option ng-repeat="rol in roles" value="{{rol.rol}}" ng-if="initial.rol == rol.rol" selected="selected">{{rol.descRol}}</option>';
			html += '</select><br>';

			if (data.fuente == 'R') {
				html += 'Estado: <select ng-model="initial.estado" autocomplete="off" required>';
				if (data.estado == 'P') {
					html += '<option value="I" >Inactivo</option>';
					html += '<option value="P" selected="selected">Pendiente</option>';
				} else if (data.estado == 'A') {
					html += '<option value="I" >Inactivo</option>';
					html += '<option value="A" selected="selected">Activo</option>';
				} else if (data.estado == 'I') {
					html += '<option value="A" >Activo</option>';
					html += '<option value="I" selected="selected">Inactivo</option>';
				}
				html += '</select><br><br>';
			} else {

				html += 'Fuente: <select ng-model="initial.fuente" autocomplete="off" required>';
				html += '<option ng-repeat="fuente in fuentes" value="{{fuente.fuente}}" ng-if="initial.fuente != fuente.fuente" >{{fuente.descFuente}}</option>';
				html += '<option ng-repeat="fuente in fuentes" value="{{fuente.fuente}}" ng-if="initial.fuente == fuente.fuente" selected="selected">{{fuente.descFuente}}</option>';
				html += '</select><br><br>';
			}
			html += '<input type="submit" class="ngdialog-button ngdialog-button-primary" value="Aceptar">';
			html += '</form>';
			html += '<div style="clear:both"></div>';

			html += '<form accept-charset="UTF-8" ng-submit="deleteUser(' + data.id_cln + ')">';
			html += '<table style="width: 68%;"><tr><td><input type="submit" class="ngdialog-button ngdialog-button-secondary" value="Eliminar Usuario"></td></tr></table>';
			html += '</form>';
			html += '<div style="clear:both"></div>';

			//Al llamar a la funcion editar se abre un cuadro de dialogo con la libreria ngDialog
			$scope.diag = ngDialog.open({
				template: html,
				plain: true,
				scope: $scope,
				controller: 'control',
				className: 'ngdialog-theme-default'
			});
		}

		//Funcion nuevo llamada para crear nuevo usuario, llamado desde la vista gestion.php
		$scope.nuevo = function (data) {
			var html = '';

			html += '<form accept-charset="UTF-8" ng-init="';
			html += "initial.rol='0'; ";
			html += "initial.estado='A'; ";
			html += "initial.fuente='R'; ";
			html += '" ng-submit="newUser(initial.correo,initial.nombre,initial.nacimiento,initial.telefono,initial.pais,initial.ciudad,initial.rol)">';

			html += 'Fecha de registro: En proceso...';
			html += '<br>';
			html += 'Correo Electrónico: <input type="email" max-length="50" ng-model="initial.correo" required>';
			html += '<br><br>';

			html += 'Nombre del usuario: <input type="text" max-length="50" ng-model="initial.nombre" required><br>';
			html += 'Fecha de Nacimiento: <input type="text" max-length="10" ng-model="initial.nacimiento"><br>';
			html += 'Teléfono: <input type="text" max-length="10" ng-model="initial.telefono"><br>';
			html += 'País: <input type="text" max-length="20" ng-model="initial.pais" ><br>';
			html += 'Ciudad: <input type="text" max-length="20" ng-model="initial.ciudad" ><br><br>';

			html += 'Rol: <select ng-model="initial.rol" autocomplete="off" required>';
			html += '<option ng-repeat="rol in roles" value="{{rol.rol}}" ng-if="initial.rol != rol.rol" >{{rol.descRol}}</option>';
			html += '<option ng-repeat="rol in roles" value="{{rol.rol}}" ng-if="initial.rol == rol.rol" selected="selected">{{rol.descRol}}</option>';
			html += '</select><br><br>';

			html += '<input type="submit" class="ngdialog-button ngdialog-button-primary" value="Registrar Usuario">';
			html += '</form>';
			html += '<div style="clear:both"></div>';

			//Al llamar a la funcion editar se abre un cuadro de dialogo con la libreria ngDialog
			$scope.diag = ngDialog.open({
				template: html,
				plain: true,
				scope: $scope,
				controller: 'control',
				className: 'ngdialog-theme-default'
			});
		}

		//Funcion deleteUser llamada para eliminar un usuario de la base de datos
		$scope.deleteUser = function (id_cln) {
			//Se consulta confirmacion al usuario
			var delUser = confirm('¿Estas seguro que deseas eliminar este usuario?');
			//Si el usuario confirma su respuesta
			if (delUser) {
				//Se envia solicitud de eliminar usuario a backend con el metodo delUser_a
				var request = $http({
					method: "post",
					url: "../api/index.php",
					headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
					skipAuthorization: false,
					data: {
						action: 'delUser_a',
						id_cln: id_cln
					}
				});

				request.success(function (res) {
					//Se valida recibido de token de seguridad
					if (res.response.token !== undefined) store.set('token', res.response.token);
					switch (res.code) {
						case response_ok:
							getUsers();
							$scope.diag.close();
							alert("Usuario eliminado exitosamente!");
							$window.location.reload();
							break;
						case user_unauthorized:
							$scope.goLogin();
							break;
						case access_forbidden:
							access_forbidden();
							break;
						default:
							alert("Error al eliminar usuario, intentelo nuevamente.");
							break;
					}
				});
			}// else $scope.diag.close();
		}

		//Funcion newUser llamada para crear un usuario en la base de datos
		$scope.newUser = function (correo, nombre, nacimiento, telefono, pais, ciudad, rol) {
			//Se validan los datos del formulario
			//Si no se definen estos campos se definen como nulos
			if (nacimiento === undefined) nacimiento = '';
			if (telefono === undefined) telefono = '';
			if (pais === undefined) pais = '';
			if (ciudad === undefined) ciudad = '';

			//Se coloca directamente el estado de usuario como Pendiente y la fuente como Registro
			var estado = 'P';
			var fuente = 'R';

			var c1 = $crypthmac.encrypt(correo, "NtraSfe");
			c1 = c1.substring(0, 8);
			var c2 = $crypthmac.encrypt(c1, "NtraSfe");

			//Se invoca el metodo newUser_a en backend con los datos para la creacion del usuario
			var request = $http({
				method: "post",
				url: "../api/index.php",
				headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				skipAuthorization: false,
				data: {
					action: 'newUser_a',
					correo: correo,
					nombre: nombre,
					nacimiento: nacimiento,
					telefono: telefono,
					pais: pais,
					ciudad: ciudad,
					rol: rol,
					estado: estado,
					fuente: fuente,
					c1: c1,
					c2: c2
				}
			});

			request.success(function (res) {
				// Se valida que se reciba token de seguridad en la respuesta del backend
				if (res.response.token !== undefined) store.set('token', res.response.token);
				//se ejecuta accion dependiendo del codigo de respuesta recibido
				switch (res.code) {
					case user_created:
						getUsers();
						$scope.diag.close();
						alert("Usuario registrado exitosamente!");
						$window.location.reload();
						break;
					case user_conflict:
						$scope.diag.close();
						alert("Ya existe un usuario registrado con ese correo electrónico");
						break;
					case user_unauthorized:
						$scope.goLogin();
						break;
					case access_forbidden:
						access_forbidden();
						break;
					default:
						alert("Error al registrar nuevo usuario, intentelo nuevamente.");
						break;
				}
			});

		}

		//Funcion updateUser llamada desde frontend por la vista gestion.php para actualizacion de datos de usuario
		$scope.updateUser = function (id_cln, correo, nombre, nacimiento, telefono, pais, ciudad, rol, estado, fuente) {
			//Se validan campos recibidos
			if (nacimiento === undefined) nacimiento = '';
			if (telefono === undefined) telefono = '';
			if (pais === undefined) pais = '';
			if (ciudad === undefined) ciudad = '';

			var c1 = $crypthmac.encrypt(correo, "NtraSfe");
			c1 = c1.substring(0, 8);
			var c2 = $crypthmac.encrypt(c1, "NtraSfe");
			//Se invoca updUser_a de backend para actualizar datos de usuario
			var request = $http({
				method: "post",
				url: "../api/index.php",
				headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				skipAuthorization: false,
				data: {
					action: 'updUser_a',
					id_cln: id_cln,
					nombre: nombre,
					nacimiento: nacimiento,
					telefono: telefono,
					pais: pais,
					ciudad: ciudad,
					rol: rol,
					estado: estado,
					fuente: fuente,
					correo: correo,
					c1: c1,
					c2: c2
				}
			});

			request.success(function (res) {
				//Se valida recibir token en la respuesta de backend
				if (res.response.token !== undefined) store.set('token', res.response.token);
				//Se ejecuta accion dependiendo del codigo de respuest
				switch (res.code) {
					case response_ok:
						getUsers();
						$scope.diag.close();
						alert("Usuario actualizado exitosamente!");
						$window.location.reload();
						break;
					case user_unauthorized:
						$scope.goLogin();
						break;
					case access_forbidden:
						access_forbidden();
						break;
					default:
						alert("Error al actualizar usuario, intentelo nuevamente.");
						break;
				}
			});

		}

		var listado = [];

		$scope.selAll = true;
		//variable listClnts para control de usuarios seleccionados en la vista
		$scope.listClnts = function (sel, id_cln) {
			if (sel) {
				if (listado.indexOf(id_cln) == -1) listado.push(id_cln);
			} else {
				if (listado.indexOf(id_cln) >= 0) listado.splice(listado.indexOf(id_cln), 1);
			}

			if (listado.length > 0) $scope.selAll = false;
			else $scope.selAll = true;

		}
		//Funcion multi_modif se llama para modificar los datos de varios usuarios
		$scope.multi_modif = function (sel, act) {
			var estado = 'A';
			if (!act) estado = 'I';

			if (sel) {
				listado = [];
				angular.forEach($scope.usuarios, function (user, i) {
					listado[i] = user.id_cln;
				});
			}

			multi_request(estado); //llama a la funcion multi_request para el envio de las solicitudes
		}

		//Funcion multi_request es llamada por multi_modif
		var multi_request = function (estado) {
			c1 = [];
			c2 = [];
			angular.forEach(listado, function (id, i) {
				c = $crypthmac.encrypt(id, "NtraSfe");
				c1[i] = c.substring(0, 8);
				c2[i] = $crypthmac.encrypt(c1[i], "NtraSfe");
			});

			//Se invoca metodo modifClntes_a de backend
			var request = $http({
				method: "post",
				url: "../api/index.php",
				headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				skipAuthorization: false,
				data: {
					action: 'modifClntes_a',
					id_cln: listado,
					c1: c1,
					c2: c2,
					estado: estado
				}
			});

			request.success(function (res) {
				//se valida recibir el token de seguridad en la respuesta
				if (res.response.token !== undefined) store.set('token', res.response.token);
				switch (res.code) {
					//se ejecuta accion dependiendo del codigo de respuesta recibido
					case response_ok:
						getUsers();
						alert("Usuarios actualizados exitosamente!");
						$window.location.reload();
						break;
					case user_unauthorized:
						$scope.goLogin();
						break;
					case access_forbidden:
						access_forbidden();
						break;
					default:
						alert("Error al actualizar los usuarios, intentelo nuevamente.");
						break;
				}
			});
		}
		//funcion multi_del llamada desde la vista gestion.php cuando el administrador decide borrar un listado de usuarios seleccionados
		$scope.multi_del = function () {
			//Se confirma la eliminacion de los datos
			var delUser = confirm('¿Estas seguro que deseas eliminar los usuarios seleccionados?');
			//si el usuario confirma se procede a invocar el metodo delClntes_a del backend
			if (delUser) {
				var request = $http({
					method: "post",
					url: "../api/index.php",
					headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
					skipAuthorization: false,
					data: {
						action: 'delClntes_a',
						id_cln: listado
					}
				});

				request.success(function (res) {
					//se valida recibir el token de seguridad en la respuesta del servidor
					if (res.response.token !== undefined) store.set('token', res.response.token);
					//Se ejecuta accion dependiendo del codigo de respuesta recibido
					switch (res.code) {
						case response_ok:
							getUsers();
							alert("Usuario eliminado exitosamente!");
							$window.location.reload();
							break;
						case user_unauthorized:
							$scope.goLogin();
							break;
						case access_forbidden:
							access_forbidden();
							break;
						default:
							alert("Error al eliminar usuario, intentelo nuevamente.");
							break;
					}
				});
			}
		}

	}
});
app.filter('html', ['$sce', function ($sce) {
	return function (text) { return $sce.trustAsHtml(text); };
}]);
// Para enviar token al servidor en cada peticion:
app.config(["$httpProvider", "jwtInterceptorProvider", function ($httpProvider, jwtInterceptorProvider) {
	$httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';

	//en cada petición enviamos el token a través de los headers con el nombre Authorization
	jwtInterceptorProvider.tokenGetter = function () {
		return localStorage.getItem('token');
	};
	$httpProvider.interceptors.push('jwtInterceptor');
}]);
