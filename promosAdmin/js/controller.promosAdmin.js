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
app.controller("control", function ($scope, $rootScope, $window, $http, $interval, $cookies, ngDialog, jwtHelper, store, $location, $crypthmac) {
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

	$scope.goLogin = function () {
		url();
		$window.location = '../login/';
	} //Al llamar esta funcion nos envia a login
	$scope.goLogout = function () {
		url();
		$window.location = '../login/logout.php';
	} //Al llamar a esta funcion nos envia a logout

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
			} else {
				$scope.user = jwtHelper.decodeToken(token);
				if ($scope.user.rol == 1) return true; //Se consula si el usuario tiene permisos de Administrador para poder continuar
				else return false;
			}
		} else return false;
	}
	$scope.isAuth = auth();

	if (!$scope.isAuth) access_forbidden(); // Si el usuario no esta autorizado correctamente se llama a Acceso Denegado.
	else {


		//Inicializacion de variables
		$scope.filtered = [];
		$scope.error = "";
		$scope.us = "";
		$scope.buscar = "";
		$scope.list = [];
		$scope.asgn = "";
		$scope.mostrar = false;

		//Se inicializa variable que contendra la informacion en base de datos
		var users = [];
		var promos = [];
		var dataPromos = [];

		//Se inicializa variable JSON que contendra los datos de los KPI a mostrar en index.php
		$scope.stats = {
			multiple: 0,
			masivo: 0,
			unico: 0,
			aprobado: 0,
			pendiente: 0
		}

		//variable con la descripcion de los posibles estados de promociones en Base de datos para mostrar en gestion.php
		var estados = [{ estado: 1, descEstado: 'Aprobado' },
		{ estado: 0, descEstado: 'Por aprobar' }
		];
		$scope.estados = estados;

		//variable con la descripcion de los posibles descuentos en Base de datos para mostrar en gestion.php
		var descuentos = [{ descuento: 5, descDescuento: '5%' },
		{ descuento: 10, descDescuento: '10%' },
		{ descuento: 15, descDescuento: '15%' }
		];
		$scope.descuentos = descuentos;

		//variable con la descripcion de los posibles tipos de promociones en Base de datos para mostrar en gestion.php
		var tipos = [{ tipo: 'Multiple', descTipo: 'Multiple' },
		{ tipo: 'Masivo', descTipo: 'Masivo' },
		{ tipo: 'Unico', descTipo: 'Unico' }
		];
		$scope.tipos = tipos;
		$scope.promos = []; //Variable para enviar los datos de los promociones a la vista en gestion.php
		var inicio = 0

		var updateTable = function (data) { //Al llamar a updateTable se cargan datos en variable promos para actualizar la vista.
			$scope.promos = data;
			return;
		}

		//Se inicializan valores para el filtrado de datos en gestion.php
		var filters = {
			fecha: null,
			codigo: null,
			descrip: null,
			tipo: null,
			descuento: null,
			estado: null
		};

		//En la funcion query se realizan todos los filtros para mostrar en gestion.php y tambien se cargan los datos para los KPI
		var query = function () {

			var promos = new jinqJs() //Se inicializa varible con objeto de la libreria jinqJS
				.from(dataPromos)
				.where(function (row) {
					//Se inicializan variables internas para control de los filtros
					var fechaFilter = true;
					var codigoFilter = true;
					var descripFilter = true;
					var tipoFilter = true;
					var descuentoFilter = true;
					var estadoFilter = true;

					//Se realiza filtro de informacion, dependiendo de los valores seleccionados en la vista o por filtros externos
					if (filters.fecha != null) fechaFilter = (row.fmin.indexOf(filters.fecha) !== -1); //Filtro 'contiene'
					if (filters.codigo != null) codigoFilter = (row.cdgo.indexOf(filters.codigo) !== -1); //Filtro 'contiene'
					if (filters.descrip != null) descripFilter = (row.dscr.indexOf(filters.descrip) !== -1); //Filtro 'contiene'
					if (filters.tipo != null) tipoFilter = (row.tipo == filters.tipo); //Filtro 'igual'
					if (filters.descuento != null) descuentoFilter = (row.dscn.indexOf(filters.descuento) !== -1); //Filtro 'contiene'
					if (filters.estado != null) estadoFilter = (row.estado == filters.estado); //Filtro 'igual'

					return (fechaFilter && codigoFilter && descripFilter && tipoFilter && descuentoFilter && estadoFilter);
				})
				.leftJoin(estados).on('estado') //Enlazamos las descripciones de estados
				.leftJoin(tipos).on('tipo') //Enlazamos las descripciones de tipos
				.select();

			//Se inicializan valores de los KPI
			$scope.stats = {
				multiple: 0,
				masivo: 0,
				unico: 0,
				aprobado: 0,
				pendiente: 0
			}
			//Calculo de los KPI
			var stat = new jinqJs()
				.from(dataPromos).where(function (row) { if (row.tipo == 'Multiple') $scope.stats.multiple += 1; }).select();
			var stat = new jinqJs()
				.from(dataPromos).where(function (row) { if (row.tipo == 'Masivo') $scope.stats.masivo += 1; }).select();
			var stat = new jinqJs()
				.from(dataPromos).where(function (row) { if (row.tipo == 'Unico') $scope.stats.unico += 1; }).select();
			var stat = new jinqJs()
				.from(dataPromos).where(function (row) { if (row.estado == 0) $scope.stats.pendiente += 1; }).select();
			var stat = new jinqJs()
				.from(dataPromos).where(function (row) { if (row.estado == 1) $scope.stats.aprobado += 1; }).select();


			//Se llama a updateTable para actualizar la tabla de datos en la vista
			updateTable(promos);

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

		//Al iniciar el controlador, se invoca el metodo getUsersPromos_a del API en Back-End
		var getUsers = function () {
			var requestUsers = $http({
				method: "post",
				url: "../api/index.php",
				headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				skipAuthorization: false,
				data: {
					action: 'getUsersPromos_a'
				}
			});

			requestUsers.success(function (res) {
				//Si el request se realizo correctamente, se captura el token de seguridad del usuario
				if (res.response.token !== undefined) store.set('token', res.response.token);
				//Se ejecuta sentencia dependiendo de codigo de respuesta
				switch (res.code) {
					case response_ok:
						users = res.response.users;
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

		//Al iniciar el controlador se invoca el metodo getPromos_a del API en Back-End
		var getPromos = function () {
			var requestPromos = $http({
				method: "post",
				url: "../api/index.php",
				headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				skipAuthorization: false,
				data: {
					action: 'getPromos_a'
				}
			});

			requestPromos.success(function (res) {

				if (res.response.token !== undefined) store.set('token', res.response.token);
				switch (res.code) {
					case response_ok:
						//Si la consulta resulto sin error, se captura resultado
						dataPromos = res.response.promos;
						if (dataPromos.length > 0) query(dataPromos);
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
		getPromos();

		var promo_userlist = [];
		//Funcion getPromo_Users creada para invocar metodo getPromo_Users_a que consulta listado de promociones por usuario
		var getPromo_Users = function (id) {

			var requestPromo_Users = $http({
				method: "post",
				url: "../api/index.php",
				headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				skipAuthorization: false,
				data: {
					action: 'getPromo_Users_a',
					id: id
				}
			});

			requestPromo_Users.success(function (res) {

				if (res.response.token !== undefined) store.set('token', res.response.token);
				switch (res.code) {
					case response_ok:
						//Si la consulta resulto sin error, se captura resultado
						promo_userlist = res.response.users;
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

		//Funcion searching creada para realizar busqueda por nombre de cliente
		$scope.searching = function (txt) {
			var searchText = txt.toLowerCase();
			$scope.filtered = [];
			if (searchText != '') {
				angular.forEach(users, function (user) {
					if (user.nombre.toLowerCase().indexOf(searchText) >= 0 || user.correo.toLowerCase().indexOf(searchText) >= 0) $scope.filtered.push(user);
				});
			}
		}

		//Funcion change para realizar cambio en la vista index.php segun seleccion del formulario
		$scope.change = function () {
			$scope.list = [];
			$scope.filtered = [];
			if ($scope.asgn == "Masivo") {
				$scope.mostrar = true;
			} else {
				$scope.mostrar = false;
			}
		}
		//Funcion change para realizar cambio en la vista gestion.php segun seleccion del formulario
		$scope.change_onEdit = function (val) {
			$scope.list = [];
			$scope.filtered = [];
			$scope.asgn = val;
			if ($scope.asgn == "Masivo") {
				$scope.mostrar = true;
			} else {
				$scope.mostrar = false;
			}
		}
		//Funcion addUser llamada para agregar usuarios a una promocion
		$scope.addUser = function (user) {
			if ($scope.list.indexOf(user) == -1) {
				if ($scope.asgn == "Unico" && $scope.list.length < 1) $scope.list.push(user);
				if ($scope.asgn == "Multiple") $scope.list.push(user);
			}

		}
		//Funcion updateScope se llama desde la vista index.php cuando cambia opcion en formulario
		$scope.updateScope = function (val) {
			$scope.asgn = val;
			if ($scope.asgn == "Masivo") {
				$scope.mostrar = true;
			} else {
				$scope.mostrar = false;
			}
		}
		//Funcion goto_filter genera un filtro a partir de algun enlace de las vistas de este controlador
		//El filtro solicitado es almacenado en un Cookie para ser capturado al cambiar de vista
		$scope.goto_filter = function (filter_name, filter_value) {
			$cookies.put(filter_name, filter_value);
			$window.location = "gestion.php"
		}

		$scope.cookie = {
			correo: null,
			estado: null,

		}
		//Se capturan los filtros realizados de desde las otras vistas del controlador asi como los filtros externos
		if ($cookies.get('estado') !== undefined) {
			var filter_name = 'estado';
			var filter_value = $cookies.get('estado');
			$scope.cookie.estado = filter_value;
			$cookies.remove('estado');
			$scope.add_filter(filter_name, filter_value);
		}
		if ($cookies.get('tipo') !== undefined) {
			var filter_name = 'tipo';
			var filter_value = $cookies.get('tipo');
			$scope.cookie.tipo = filter_value;
			$cookies.remove('tipo');
			$scope.add_filter(filter_name, filter_value);
		}

		$scope.editMode = false;
		$scope.editModeData = {};

		//funcion Cancel_EditMode para cancelar los cambios hechos en modo edicion de promociones
		$scope.Cancel_EditMode = function () {
			$scope.editModeData = {};
			$scope.list = [];
			$scope.editMode = false;

		}

		//la Funcion editar es llamada en la vista Gestion.php cuando se inicia el modo de edicion
		$scope.editar = function (data) {
			//esta funcion invoca el metodo getPromo_Users_a en backend
			var requestPromo_Users = $http({
				method: "post",
				url: "../api/index.php",
				headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				skipAuthorization: false,
				data: {
					action: 'getPromo_Users_a',
					cdgo: data.cdgo
				}
			});

			requestPromo_Users.success(function (res) {
				if (res.response.token !== undefined) store.set('token', res.response.token);
				switch (res.code) {
					case response_ok:
						//Si no hubo error en la consulta se captura listado de promociones
						var users = res.response.users;
						$scope.list = $scope.list.concat(users);
						$scope.editMode = true; //Se activa modo de edicion
						$scope.editModeData = data;
						break;
					case user_unauthorized:
						$scope.goLogin();
						break;
					case access_forbidden:
						access_forbidden();
						break;
					default:
						$scope.editMode = false;
						alert("Ha ocurrido un error inesperado, por favor comunicate con el administrador");
						break;
				}
			});


		}

		//Funcion deletePromo se llama al seleccionar accion Eliminar Promocio desde la vista gestion.php
		$scope.deletePromo = function (id_code) {
			//Se solicita confirmacion para eliminar
			var delCode = confirm('¿Estas seguro que deseas eliminar esta promoción?');

			if (delCode) { //Si se confirma eliminacion
				//Se invoca metodo delPromo_a en backend
				var request = $http({
					method: "post",
					url: "../api/index.php",
					headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
					skipAuthorization: false,
					data: {
						action: 'delPromo_a',
						id_code: id_code
					}
				});

				request.success(function (res) {

					if (res.response.token !== undefined) store.set('token', res.response.token);
					//Se ejecuta sentencia dependiendo de codigo de respuesta
					switch (res.code) {
						case response_ok:
							alert("Promoción eliminada exitosamente!");
							$window.location.reload();
							break;
						case user_unauthorized:
							$scope.goLogin();
							break;
						case access_forbidden:
							access_forbidden();
							break;
						default:
							alert("Error al eliminar promoción, intentelo nuevamente.");
							break;
					}
				});
			}

		}

		//Funcion newCode llamada desde la vista Index.php
		$scope.newCode = function () {
			if ($scope.list.length == 0 && $scope.asgn != 'Masivo') {
				alert("Debe seleccionar al menos a un cliente para la promoción");
				return false;
			}
			//Se invoca newPromo_a en backend para crear nueva promocion
			var request = $http({
				method: "post",
				url: "../api/index.php",
				headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				skipAuthorization: false,
				data: {
					action: 'newPromo_a',
					dscr: $scope.dscr,
					asgn: $scope.asgn,
					dscn: $scope.dscn,
					fmin: $scope.fmin,
					fmax: $scope.fmax,
					clnt: $scope.list
				}
			});

			request.success(function (res) {
				//Se valida recibir token en la respuesta
				if (res.response.token !== undefined) store.set('token', res.response.token);
				//Se ejecuta sentencia dependiendo de codigo de respuesta
				switch (res.code) {
					case response_ok:
						alert("Promoción creada exitosamente!");
						$window.location.reload();
						break;
					case user_unauthorized:
						$scope.goLogin();
						break;
					case access_forbidden:
						access_forbidden();
						break;
					default:
						alert("Error al crear nueva promoción, intentelo nuevamente.");
						break;
				}
			});

		}

		//Funcion updatePromo llamada desde la vista gestion.php
		$scope.updatePromo = function (cdgo, fmin, fmax, descrip, tipo, estado, descuento, list) {
			//Se invoca updPromo_a en backend para modificar una promocion
			var request = $http({
				method: "post",
				url: "../api/index.php",
				headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				skipAuthorization: false,
				data: {
					action: 'updPromo_a',
					cdgo: cdgo,
					fmin: fmin,
					fmax: fmax,
					descrip: descrip,
					tipo: tipo,
					estado: estado,
					descuento: descuento,
					lista: list
				}
			});

			request.success(function (res) {
				// Se valida recibir el token  en la respuesta de backend
				if (res.response.token !== undefined) store.set('token', res.response.token);
				//se ejecuta accion dependiendo del codigo de respuesta recibido
				switch (res.code) {
					case response_ok:
						$scope.editMode = false;
						alert("Promoción actualizada exitosamente!");
						$window.location.reload();
						break;
					case user_unauthorized:
						$scope.goLogin();
						break;
					case access_forbidden:
						access_forbidden();
						break;
					default:
						alert("Error al actualizar Promoción, intentelo nuevamente.");
						break;
				}
			});

		}


	}
});
app.filter('html', ['$sce', function ($sce) {
	return function (text) { return $sce.trustAsHtml(text); };
}]);
app.filter('capitalize', function () {
	return function (input, all) {
		var reg = (all) ? /([^\W_]+[^\s-]*) */g : /([^\W_]+[^\s-]*)/;
		return (!!input) ? input.replace(reg, function (txt) { return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase(); }) : '';
	}
});
// Para enviar token al servidor en cada peticion:
app.config(["$httpProvider", "jwtInterceptorProvider", function ($httpProvider, jwtInterceptorProvider) {
	$httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';

	//en cada petición enviamos el token a través de los headers con el nombre Authorization
	jwtInterceptorProvider.tokenGetter = function () {
		return localStorage.getItem('token');
	};
	$httpProvider.interceptors.push('jwtInterceptor');
}]);