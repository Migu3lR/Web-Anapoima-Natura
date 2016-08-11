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
app.controller("control",function($scope,$rootScope,$window,$http,$interval,$cookies,ngDialog,jwtHelper,store,$location,$crypthmac){
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
	$window.location = '../login/'
}

var url = function (){ store.set('url', $location.absUrl());}

$scope.goLogin = function(){ url(); $window.location = '../login/'; }
$scope.goLogout = function(){ url(); $window.location = '../login/logout.php'; }

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



$scope.filtered = [];
$scope.error = "";
$scope.us = "";
$scope.buscar="";
$scope.list = [];
$scope.asgn = "";
$scope.mostrar = false;

var users=[];
var promos = [];
var dataPromos = [];

$scope.stats = {
	multiple: 	0,
	masivo: 	0,
	unico: 	0,
	aprobado: 0,
	pendiente: 0
}

var estados = [{estado: 1, descEstado: 'Aprobado'},
                {estado: 0, descEstado: 'Por aprobar'}];
$scope.estados = estados;

var descuentos = [{descuento: 5, descDescuento: '5%'},
                {descuento: 10, descDescuento: '10%'},
				{descuento: 15, descDescuento: '15%'}];
$scope.descuentos = descuentos;

var tipos = [{tipo: 'Multiple', descTipo: 'Multiple'},
           	 {tipo: 'Masivo', descTipo: 'Masivo'},
			 {tipo: 'Unico', descTipo: 'Unico'}];
$scope.tipos = tipos;
$scope.promos = [];
var inicio = 0

var updateTable = function(data){
	$scope.promos = data;
	return;
}

var filters={
	fecha : null,
	codigo : null,
	descrip: null,
	tipo: null,
	descuento: null,
	estado: null
};

var query = function (){
	
	var promos = new jinqJs()
	.from(dataPromos)
	.where( function(row) { 
	
	var fechaFilter = true;	
	var codigoFilter = true;
	var descripFilter = true;
	var tipoFilter = true;
	var descuentoFilter = true;
	var estadoFilter = true;
		
	///Filtros Gestion
	if (filters.fecha != null) fechaFilter = (row.fmin.indexOf(filters.fecha) !== -1 );
	if (filters.codigo != null) codigoFilter = (row.cdgo.indexOf(filters.codigo) !== -1 );
	if (filters.descrip != null) descripFilter = (row.dscr.indexOf(filters.descrip) !== -1);
	if (filters.tipo != null) tipoFilter = (row.tipo == filters.tipo);
	if (filters.descuento != null) descuentoFilter = (row.dscn.indexOf(filters.descuento) !== -1);
	if (filters.estado != null) estadoFilter = (row.estado == filters.estado); 
	
	return (fechaFilter && codigoFilter && descripFilter && tipoFilter && descuentoFilter && estadoFilter); 
	} )
	.leftJoin(estados).on('estado')
	.leftJoin(tipos).on('tipo')
	.select(
	);
	
	///Begin - Estadisticas
	$scope.stats = {
	multiple: 	0,
	masivo: 	0,
	unico: 	0,
	aprobado: 0,
	pendiente: 0
	}
	
	var stat = new jinqJs()
	.from(dataPromos).where( function(row){if (row.tipo == 'Multiple') $scope.stats.multiple += 1;}).select();
	var stat = new jinqJs()
	.from(dataPromos).where( function(row){if (row.tipo == 'Masivo') $scope.stats.masivo += 1;}).select();
	var stat = new jinqJs()
	.from(dataPromos).where( function(row){if (row.tipo == 'Unico') $scope.stats.unico += 1;}).select();
	var stat = new jinqJs()
	.from(dataPromos).where( function(row){if (row.estado == 0) $scope.stats.pendiente += 1;}).select();
	var stat = new jinqJs()
	.from(dataPromos).where( function(row){if (row.estado == 1) $scope.stats.aprobado += 1;}).select();
	
	
	///End - Estadisticas

	updateTable(promos);
	
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
			action	:	'getUsersPromos_a'
		}
	});
		
	requestUsers.success(function (res) {

	if(res.response.token !== undefined) store.set('token', res.response.token);
	switch (res.code) {
		case response_ok:
			users=res.response.users;
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


var getPromos = function(){
	var requestPromos = $http({
		method: "post",
		url: "../api/index.php",
		headers: {'Content-Type': 'application/x-www-form-urlencoded'},
		skipAuthorization: false,
		data: {
			action	:	'getPromos_a'
		}
	});
		
	requestPromos.success(function (res) {

	if(res.response.token !== undefined) store.set('token', res.response.token);
	switch (res.code) {
		case response_ok:
			dataPromos=res.response.promos;
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

var promo_userlist=  [];
var getPromo_Users = function(id){
	
	var requestPromo_Users = $http({
		method: "post",
		url: "../api/index.php",
		headers: {'Content-Type': 'application/x-www-form-urlencoded'},
		skipAuthorization: false,
		data: {
			action	:	'getPromo_Users_a',
			id		:	id
		}
	});
		
	requestPromo_Users.success(function (res) {

	if(res.response.token !== undefined) store.set('token', res.response.token);
	switch (res.code) {
		case response_ok:
			promo_userlist=res.response.users;
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

	
$scope.searching=function(txt){
	var searchText = txt.toLowerCase();
	$scope.filtered = [];
	if (searchText != ''){
		angular.forEach(users, function(user) {
			if( user.nombre.toLowerCase().indexOf(searchText) >= 0 || user.correo.toLowerCase().indexOf(searchText) >= 0 ) $scope.filtered.push(user);
		});
	}
}
$scope.change=function(){
	$scope.list = [];
	$scope.filtered = [];
	if ($scope.asgn == "Masivo") {
		$scope.mostrar = true;
	} else {
		$scope.mostrar = false;
	}
}
$scope.change_onEdit=function(val){
	$scope.list = [];
	$scope.filtered = [];
	$scope.asgn = val;
	if ($scope.asgn == "Masivo") {
		$scope.mostrar = true;
	} else {
		$scope.mostrar = false;
	}
}

$scope.addUser=function(user){
	if ( $scope.list.indexOf(user) == -1){
		if ($scope.asgn == "Unico" &&  $scope.list.length < 1)  $scope.list.push(user);
		if ($scope.asgn == "Multiple")  $scope.list.push(user);
	}
	
}	

$scope.updateScope=function(val){
	$scope.asgn = val;
	if ($scope.asgn == "Masivo") {
		$scope.mostrar = true;
	} else {
		$scope.mostrar = false;
	}
}

	
/////////////////////////////////////////////////////
/*var getUsers = function(){
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
getUsers();*/
//////////////////////////////////////////////



$scope.goto_filter = function(filter_name, filter_value){
	$cookies.put(filter_name, filter_value);
	$window.location = "gestion.php"
}

$scope.cookie = {
	correo: null,
	estado: null,
	
}

if ($cookies.get('estado') !== undefined){
	var filter_name = 'estado';
	var filter_value = $cookies.get('estado');
	$scope.cookie.estado = filter_value;
	$cookies.remove('estado');
	$scope.add_filter(filter_name, filter_value);
}
if ($cookies.get('tipo') !== undefined){
	var filter_name = 'tipo';
	var filter_value = $cookies.get('tipo');
	$scope.cookie.tipo = filter_value;
	$cookies.remove('tipo');
	$scope.add_filter(filter_name, filter_value);
}

$scope.editMode = false;
$scope.editModeData = {};

$scope.Cancel_EditMode = function(){
	$scope.editModeData = {};
	$scope.list = [];
	$scope.editMode = false;
	
}

$scope.editar = function(data){
	
	var requestPromo_Users = $http({
		method: "post",
		url: "../api/index.php",
		headers: {'Content-Type': 'application/x-www-form-urlencoded'},
		skipAuthorization: false,
		data: {
			action	:	'getPromo_Users_a',
			cdgo		:	data.cdgo
		}
	});
		
	requestPromo_Users.success(function (res) {
	if(res.response.token !== undefined) store.set('token', res.response.token);
	switch (res.code) {
		case response_ok:
			var users = res.response.users;
			$scope.list = $scope.list.concat(users); 
			$scope.editMode = true;
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

$scope.deletePromo = function(id_code){
var delCode = confirm('¿Estas seguro que deseas eliminar esta promoción?');

if (delCode){
	var request = $http({
		method: "post",
		url: "../api/index.php",
		headers: {'Content-Type': 'application/x-www-form-urlencoded'},
		skipAuthorization: false,
		data: {
			action	:	'delPromo_a',
			id_code  : id_code
		}
	});
	
	request.success(function (res) {

	if(res.response.token !== undefined) store.set('token', res.response.token);
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

$scope.newCode = function (){
	if ( $scope.list.length == 0 && $scope.asgn != 'Masivo') {
		alert("Debe seleccionar al menos a un cliente para la promoción");
		return false;
	}
	
	var request = $http({
		method: "post",
		url: "../api/index.php",
		headers: {'Content-Type': 'application/x-www-form-urlencoded'},
		skipAuthorization: false,
		data: {
			action	:	'newPromo_a',
			dscr: $scope.dscr, 
			asgn: $scope.asgn, 
			dscn: $scope.dscn, 
			fmin: $scope.fmin, 
			fmax: $scope.fmax,
			clnt:  $scope.list 
			}
	});
	
	request.success(function (res) {

	if(res.response.token !== undefined) store.set('token', res.response.token);
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


$scope.updatePromo = function (cdgo,fmin,fmax,descrip,tipo,estado,descuento,list){
	
	var request = $http({
		method: "post",
		url: "../api/index.php",
		headers: {'Content-Type': 'application/x-www-form-urlencoded'},
		skipAuthorization: false,
		data: {
			action	:	'updPromo_a',
			cdgo	:	cdgo,
			fmin	:	fmin,
			fmax	:	fmax,
			descrip	:	descrip,
			tipo	:	tipo,
			estado	:	estado,
			descuento:	descuento,
			lista	:	list
			}
	});
		
	request.success(function (res) {

	if(res.response.token !== undefined) store.set('token', res.response.token);
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
app.filter('html', ['$sce', function($sce) {
	return function(text) { return $sce.trustAsHtml(text); };
}]);
app.filter('capitalize', function() {
	return function(input, all) {
		var reg = (all) ? /([^\W_]+[^\s-]*) */g : /([^\W_]+[^\s-]*)/;
		return (!!input) ? input.replace(reg, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();}) : '';
	}
});
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
