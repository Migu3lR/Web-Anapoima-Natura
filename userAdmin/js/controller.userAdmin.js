/*  Angular Framework  */
app = angular.module("app",['angular-jwt', 'angular-storage','chart.js','ngCookies','angularMoment','ngDialog','angular-hmac-sha512']);
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
app.controller("control",function($scope,$window,$http,$interval,$cookies,ngDialog,jwtHelper,store,$location,$crypthmac){
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

var access_forbidden = function (){
	var token = store.get("token") || null;
	if (token) store.remove("token");
	var url = store.get("url") || null;
	if (url) store.remove("url");
	$window.location = '/login/';
}

var url = function (){ store.set('url', $location.absUrl());}

$scope.goLogin = function(){ url(); $window.location = '/login/'; }
$scope.goLogout = function(){ url(); $window.location = '/login/logout.php'; }

//Usuario Autorizado?
	//obtenemos el token en localStorage
	//decodificamos para obtener los datos del user
	//los mandamos a la vista como user
	var auth = function(){
		var token = store.get("token") || null;
		if (token) {
			if (jwtHelper.isTokenExpired(token)){
				store.remove("token");
				return false;	
			} 
			else {
				$scope.user = jwtHelper.decodeToken(token);
				if($scope.user.rol == 1) return true;
				else return false;
			}
		} else return false;
	}
	$scope.isAuth = auth();

if (!$scope.isAuth) access_forbidden();
else{

$scope.labels = []; 
$scope.data = [];
$scope.series = ['Registros por Mes'];
$scope.onClick = function (points, evt) {
	if (points[0] !== undefined) $scope.goto_filter('fecha', points[0].label);	
};

var dataUsers = [];

$scope.stats = {
	registrado: 	0,
	noregistrado: 	0,
	frecuente: 	0,
	ocasional:	0
}

var estados = [{estado: 'A', descEstado: 'Activo'},
                {estado: 'I', descEstado: 'Inactivo'},
				{estado: 'P', descEstado: 'Pendiente'},];
$scope.estados = estados;

var roles = [{rol: 0, descRol: 'Cliente'},
           	 {rol: 1, descRol: 'Administrador'}];
$scope.roles = roles;

var frecuencias = [{frecuencia: 'Frecuente', cond: true},
           	 	   {frecuencia: 'Ocasional', cond: false}];
$scope.frecuencias = frecuencias;

var fuentes = [{fuente: 'R', descFuente: 'Registro'},
			   {fuente: 'C', descFuente: 'Comentarios'},
           	   {fuente: 'B', descFuente: 'Reservas'}];
$scope.fuentes = fuentes;

$scope.usuarios = [];
var inicio = 0

var updateTable = function(data){
	$scope.usuarios = data;
	
	return;
}

var filters={
	nombre_correo : null,
	nombre : null,
	correo: null,
	estado: null,
	fecha: null,
	rol: null,
	frecuencia: null,
	fuente: null
};

$scope.encontrados = 0 ///Contar registros encontrados con la busqueda
$scope.filtro_busqueda = false; ///Flag para mostrar info referente a las busquedas.

var query = function (){
	
	var frecVar = (moment().subtract(3,'months').format("YYYY[-]MM") + '-01');
	
	var usuarios = new jinqJs()
	.from(dataUsers)
	.where( function(row) { 
	
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
				
		nombre_correoFilter = (row.nombre.indexOf(filters.nombre_correo) !== -1 || row.correo.indexOf(filters.nombre_correo) !== -1 );
		if (nombre_correoFilter) $scope.encontrados += 1; ///Incrementar contador de encontrados si hay coincidencia	
	}
	///Filtros Gestion
	if (filters.nombre != null) nombreFilter = (row.nombre.indexOf(filters.nombre) !== -1 );
	if (filters.correo != null) correoFilter = (row.correo.indexOf(filters.correo) !== -1 );
	if (filters.estado != null) estadoFilter = (row.estado == filters.estado);
	if (filters.fecha != null) fechaFilter = (row.creacion.indexOf(filters.fecha) !== -1 );
	if (filters.rol != null) rolFilter = (row.rol == filters.rol);
	if (filters.fuente != null) fuenteFilter = (row.fuente == filters.fuente); 
	
	return (nombre_correoFilter && nombreFilter && correoFilter && estadoFilter && fechaFilter && rolFilter && fuenteFilter); 
	} )
	.leftJoin(estados).on('estado')
	.leftJoin(roles).on('rol')
	.leftJoin(fuentes).on('fuente')
	.join(frecuencias).on( 
		function( left, right ) {
			var cond = false;
			if (left.ultimaReserva >= frecVar) cond = true;
			if (right.cond == cond)	{
				var frecuenciaFilter = true;
				if (filters.frecuencia != null) frecuenciaFilter = (right.frecuencia == filters.frecuencia);
				return (frecuenciaFilter);
			}
		}
	)
	.select();
	///Begin - Grafico
	var meses = {
		6 : moment().format("YYYY[-]MM"),	
		5 : moment().subtract(1,'months').format("YYYY[-]MM"),
		4 : moment().subtract(2,'months').format("YYYY[-]MM"),
		3 : moment().subtract(3,'months').format("YYYY[-]MM"),
		2 : moment().subtract(4,'months').format("YYYY[-]MM"),
		1 : moment().subtract(5,'months').format("YYYY[-]MM"),
		0 : moment().subtract(6,'months').format("YYYY[-]MM")
	}
	
	var data = [];	
	
	angular.forEach(meses, function(mes, i) {
  		var graf = new jinqJs()
		.from(dataUsers)
		.where( function(row){
			return (row.fuente == 'R' && row.creacion.indexOf(mes) == 0)	
		})
		.groupBy('fuente').count('id_cln')
		.select();
		
		if (graf[0] !== undefined) data.push(graf[0].id_cln);
		else data.push(null);
	});
	
	$scope.labels = [meses[0],meses[1],meses[2],meses[3],meses[4],meses[5],meses[6]];
	$scope.data.push(data);
	///End - Grafico
	
	///Begin - Estadisticas
	$scope.stats = {
	registrado: 	0,
	noregistrado: 	0,
	frecuente: 	0,
	ocasional:	0
	}
	
	var stat = new jinqJs()
	.from(dataUsers).where( function(row){if (row.fuente == 'R') $scope.stats.registrado += 1;}).select();
	var stat = new jinqJs()
	.from(dataUsers).where( function(row){if (row.fuente != 'R') $scope.stats.noregistrado += 1;}).select();
	var stat = new jinqJs()
	.from(dataUsers).where( function(row){if (row.ultimaReserva >= frecVar ) $scope.stats.frecuente += 1; else $scope.stats.ocasional += 1;}).select();
	
	///End - Estadisticas

	updateTable(usuarios);
	
	return;
}

$scope.add_filter = function(filter_name, filter_value){
	if (filters[filter_name] !== undefined){
		if (filter_value === "") filter_value = null;
		filters[filter_name] = filter_value;
		query();
	} else {
		alert('Filtro invalido, por favor intentelo nuevamente.');
		$window.location.reload();
	}
	return;
}


var getUsers = function(){
	var requestUsers = $http({
		method: "post",
		url: "../api/index.php",
		headers: {'Content-Type': 'application/x-www-form-urlencoded'},
		skipAuthorization: false,
		data: {
			action	:	'getUsers_a'
		}
	});
		
	requestUsers.success(function (res) {

	if(res.response.token !== undefined) store.set('token', res.response.token);
	switch (res.code) {
		case response_ok:
			dataUsers=res.response.users;
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
	
$scope.goto_filter = function(filter_name, filter_value){
	$cookies.put(filter_name, filter_value);
	$window.location = "gestion.php"
}

$scope.cookie = {
	nombre : '',
	correo: '',
	estado: '',
	fecha: '',
	rol: '',
	frecuencia: '',
	fuente: ''
}

if ($cookies.get('fecha') !== undefined){
	var filter_name = 'fecha';
	var filter_value = $cookies.get('fecha');
	$scope.cookie.fecha = filter_value;
	$cookies.remove('fecha');
	$scope.add_filter(filter_name, filter_value);
	$scope.add_filter('fuente', 'R');
}
if ($cookies.get('estado') !== undefined){
	var filter_name = 'estado';
	var filter_value = $cookies.get('estado');
	$scope.cookie.estado = filter_value;
	$cookies.remove('estado');
	$scope.add_filter(filter_name, filter_value);
}
if ($cookies.get('correo') !== undefined){
	var filter_name = 'correo';
	var filter_value = $cookies.get('correo');
	$scope.cookie.correo = filter_value;
	$cookies.remove('correo');
	$scope.add_filter(filter_name, filter_value);
}
if ($cookies.get('rol') !== undefined){
	var filter_name = 'rol';
	var filter_value = $cookies.get('rol');
	$scope.cookie.rol = filter_value;
	$cookies.remove('rol');
	$scope.add_filter(filter_name, filter_value);
}
if ($cookies.get('frecuencia') !== undefined){
	var filter_name = 'frecuencia';
	var filter_value = $cookies.get('frecuencia');
	$scope.cookie.frecuencia = filter_value;
	$cookies.remove('frecuencia');
	$scope.add_filter(filter_name, filter_value);
}
if ($cookies.get('fuente') !== undefined){
	var filter_name = 'fuente';
	var filter_value = $cookies.get('fuente');
	$scope.cookie.fuente = filter_value;
	$cookies.remove('fuente');
	$scope.add_filter(filter_name, filter_value);
}

$scope.editar = function(data){
	var html = '';
	html += '<script>  $(function() {$( "#datepicker" ).datepicker({dateFormat: "yyyy-mm-dd", defaultDate: "'+data.nacimiento+'"});});</script>';
	html += '<form accept-charset="UTF-8" ng-init="';
	html += "initial.nombre='"+data.nombre+"'; ";
	html += "initial.nacimiento='"+data.nacimiento+"'; ";
	html += "initial.telefono='"+data.telefono+"'; ";
	html += "initial.pais='"+data.pais+"'; ";
	html += "initial.ciudad='"+data.ciudad+"'; ";
	html += "initial.rol='"+data.rol+"'; ";
	html += "initial.estado='"+data.estado+"'; ";
	html += "initial.fuente='"+data.fuente+"'; ";
	html += '" ng-submit="updateUser('+data.id_cln+','+"'"+data.correo+"'"+',initial.nombre,initial.nacimiento,initial.telefono,initial.pais,initial.ciudad,initial.rol,initial.estado,initial.fuente)">';
	
	html += 'Fecha de registro: '+data.creacion;
	html += '<br>';
	html += 'Correo Electrónico: '+data.correo;
	html += '<br><br>';
	
	html += 'Nombre del usuario: <input type="text" max-length="50" ng-model="initial.nombre" required>';
	html += '<a href="#" ng-click="initial.nombre='+"'"+data.nombre+"'"+'"><img src="/adminResources/rollback.png" style="margin-left:1rem" title="Restablecer"></a><br>';
	html += 'Fecha de Nacimiento: <input type="text" ng-model="initial.nacimiento">';
	html += '<a href="#" ng-click="initial.nacimiento='+"'"+data.nacimiento+"'"+'"><img src="/adminResources/rollback.png" style="margin-left:1rem" title="Restablecer"></a><br>';
	html += 'Teléfono: <input type="text" max-length="10" ng-model="initial.telefono">';
	html += '<a href="#" ng-click="initial.telefono='+"'"+data.telefono+"'"+'"><img src="/adminResources/rollback.png" style="margin-left:1rem" title="Restablecer"></a><br>';
	html += 'País: <input type="text" max-length="20" ng-model="initial.pais" >';
	html += '<a href="#" ng-click="initial.pais='+"'"+data.pais+"'"+'"><img src="/adminResources/rollback.png" style="margin-left:1rem" title="Restablecer"></a><br>';
	html += 'Ciudad: <input type="text" max-length="20" ng-model="initial.ciudad" >';
	html += '<a href="#" ng-click="initial.ciudad='+"'"+data.ciudad+"'"+'"><img src="/adminResources/rollback.png" style="margin-left:1rem" title="Restablecer"></a><br><br>';
	
	html += 'Rol: <select ng-model="initial.rol" autocomplete="off" required>';
	html += '<option ng-repeat="rol in roles" value="{{rol.rol}}" ng-if="initial.rol != rol.rol" >{{rol.descRol}}</option>';
	html += '<option ng-repeat="rol in roles" value="{{rol.rol}}" ng-if="initial.rol == rol.rol" selected="selected">{{rol.descRol}}</option>';
	html += '</select><br>';	
	
	if (data.fuente=='R'){
		html += 'Estado: <select ng-model="initial.estado" autocomplete="off" required>';
		if (data.estado == 'P') {
			html += '<option value="I" >Inactivo</option>';
			html += '<option value="P" selected="selected">Pendiente</option>';	
		} else if (data.estado=='A'){
			html += '<option value="I" >Inactivo</option>';
			html += '<option value="A" selected="selected">Activo</option>';
		} else if (data.estado=='I'){
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
	
	html += '<form accept-charset="UTF-8" ng-submit="deleteUser('+data.id_cln+')">';
	html += '<table style="width: 68%;"><tr><td><input type="submit" class="ngdialog-button ngdialog-button-secondary" value="Eliminar Usuario"></td></tr></table>';
	html += '</form>';
	html += '<div style="clear:both"></div>';
	
	$scope.diag = ngDialog.open({
		template: html,
		plain: true,
		scope: $scope,
		controller: 'control',
		className: 'ngdialog-theme-default'
	});
}

$scope.nuevo = function(data){
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
	
		$scope.diag = ngDialog.open({
		template: html,
		plain: true,
		scope: $scope,
		controller: 'control',
		className: 'ngdialog-theme-default'
	});
}


$scope.deleteUser = function(id_cln){
var delUser = confirm('¿Estas seguro que deseas eliminar este usuario?');

if (delUser){
	var request = $http({
		method: "post",
		url: "../api/index.php",
		headers: {'Content-Type': 'application/x-www-form-urlencoded'},
		skipAuthorization: false,
		data: {
			action	:	'delUser_a',
			id_cln  : id_cln
		}
	});
	
	request.success(function (res) {

	if(res.response.token !== undefined) store.set('token', res.response.token);
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

$scope.newUser = function (correo,nombre,nacimiento,telefono,pais,ciudad,rol){
	if(nacimiento === undefined) nacimiento = '';
	if(telefono === undefined) telefono = '';
	if(pais === undefined) pais = '';
	if(ciudad === undefined) ciudad = '';
	
	var estado = 'P';
	var fuente = 'R';
	
	var c1 = $crypthmac.encrypt(correo,"NtraSfe");
	c1 = c1.substring(0, 8);
	var c2 =  $crypthmac.encrypt(c1,"NtraSfe");
	// console.log(c1);
	var request = $http({
		method: "post",
		url: "../api/index.php",
		headers: {'Content-Type': 'application/x-www-form-urlencoded'},
		skipAuthorization: false,
		data: {
			action	:	'newUser_a',
			correo : correo,
			nombre : nombre, 
			nacimiento : nacimiento, 
			telefono : telefono, 
			pais : pais, 
			ciudad : ciudad, 
			rol : rol, 
			estado : estado,
			fuente : fuente,
			c1: c1,
			c2: c2 
			}
	});
	
	request.success(function (res) {

	if(res.response.token !== undefined) store.set('token', res.response.token);
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


$scope.updateUser = function (id_cln,correo,nombre,nacimiento,telefono,pais,ciudad,rol,estado,fuente){
	if(nacimiento === undefined) nacimiento = '';
	if(telefono === undefined) telefono = '';
	if(pais === undefined) pais = '';
	if(ciudad === undefined) ciudad = '';
	
	var c1 = $crypthmac.encrypt(correo,"NtraSfe");
	c1 = c1.substring(0, 8);
	var c2 =  $crypthmac.encrypt(c1,"NtraSfe");
	//console.log(c1);
	var request = $http({
		method: "post",
		url: "../api/index.php",
		headers: {'Content-Type': 'application/x-www-form-urlencoded'},
		skipAuthorization: false,
		data: {
			action	:	'updUser_a',
			id_cln  : id_cln,
			nombre : nombre, 
			nacimiento : nacimiento, 
			telefono : telefono, 
			pais : pais, 
			ciudad : ciudad, 
			rol : rol, 
			estado : estado,
			fuente : fuente,
			correo: correo,
			c1:c1,
			c2:c2
			}
	});
		
	request.success(function (res) {

	if(res.response.token !== undefined) store.set('token', res.response.token);
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

$scope.listClnts = function(sel,id_cln){
	if(sel){
		if (listado.indexOf(id_cln) == -1) listado.push(id_cln);		
	} else {
		if (listado.indexOf(id_cln) >= 0) listado.splice(listado.indexOf(id_cln), 1);
	}
	
	if (listado.length > 0) $scope.selAll = false;
	else $scope.selAll = true;
	 
	//console.log(listado);
}

$scope.multi_modif = function(sel,act){
	var estado = 'A';
	if (!act) estado = 'I';
	
	if (sel){
		listado = [];
		angular.forEach($scope.usuarios, function(user, i) {
			listado[i] = user.id_cln;
		});
	}
	
	multi_request(estado);
}

var multi_request =function(estado){
	c1 = [];
	c2 = [];
	angular.forEach(listado, function(id, i) {
		c = $crypthmac.encrypt(id,"NtraSfe");
		c1[i] = c.substring(0, 8);
		c2[i] = $crypthmac.encrypt(c1[i],"NtraSfe");
	});
	
	var request = $http({
		method: "post",
		url: "../api/index.php",
		headers: {'Content-Type': 'application/x-www-form-urlencoded'},
		skipAuthorization: false,
		data: {
			action	: 'modifClntes_a',
			id_cln  : listado,
			c1 : c1,
			c2 : c2,
			estado : estado
		}
	});
	
	request.success(function (res) {

	if(res.response.token !== undefined) store.set('token', res.response.token);
	switch (res.code) {
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

$scope.multi_del =function(){
	
	var delUser = confirm('¿Estas seguro que deseas eliminar los usuarios seleccionados?');

	if (delUser){
		var request = $http({
			method: "post",
			url: "../api/index.php",
			headers: {'Content-Type': 'application/x-www-form-urlencoded'},
			skipAuthorization: false,
			data: {
				action	: 'delClntes_a',
				id_cln  : listado
			}
		});
		
		request.success(function (res) {

		if(res.response.token !== undefined) store.set('token', res.response.token);
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
app.filter('html', ['$sce', function($sce) {
	return function(text) { return $sce.trustAsHtml(text); };
}]);
// Para enviar token al servidor en cada peticion:
app.config(["$httpProvider", "jwtInterceptorProvider",  function ($httpProvider, jwtInterceptorProvider) 
{
    $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
    
    //en cada petición enviamos el token a través de los headers con el nombre Authorization
    jwtInterceptorProvider.tokenGetter = function() {
        return localStorage.getItem('token');
    };
    $httpProvider.interceptors.push('jwtInterceptor');
}]);
