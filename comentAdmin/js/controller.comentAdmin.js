/*  Angular Framework  */
app = angular.module("app",['angular-jwt', 'angular-storage','chart.js','ngCookies','angularMoment','ngDialog']);
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
app.controller("control",function($scope,$window,$http,$interval,$cookies,ngDialog,jwtHelper,store,$location){
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
$scope.labels = []; 
$scope.data = [];
$scope.series = ['Puntuación Visitantes'];
$scope.onClick = function (points, evt) {
	if (points[0] !== undefined) $scope.goto_filter('fecha', points[0].label);	
};

$scope.prom = 0;

var dataComents = [];

var filters={
	fecha : null,
	cliente: null,
	correo: null,
	rate: null,
	estado: null,
	publicar: null
};

$scope.stats = {
	pendiente: 	0,
	aprobado: 	0,
	rechazado: 	0,
	publicar:	0,
	nopublicar: 0,
	rate1:		0,
	rate2:		0,
	rate3:		0,
	rate4:		0,
	rate5:		0
}

var estados = [{estado: 'R', descEstado: 'Rechazado'},
                {estado: 'A', descEstado: 'Aprobado'},
                {estado: 'P', descEstado: 'Pendiente'}];
$scope.estados = estados;

var publico = [{publicar: 'S', descPublicar: 'Publicado'},
                {publicar: 'N', descPublicar: 'No publicar'}];
$scope.publico = publico;

$scope.comentarios = [];
var inicio = 0

var updateTable = function(data){
	$scope.comentarios = data;
	return;
}

var query = function (){
	var comentarios = new jinqJs()
	.from(dataComents)
	.where( function(row) { 
		
	var fechaFilter = true;
	var clienteFilter = true;
	var correoFilter = true;
	var rateFilter = true;
	var estadoFilter = true;
	var publicarFilter = true;
		
	if (filters.fecha != null) fechaFilter = (row.fecha.indexOf(filters.fecha) !== -1 );
	if (filters.cliente != null) clienteFilter = (row.nombre.indexOf(filters.cliente) !== -1 );
	if (filters.correo != null) correoFilter = (row.correo.indexOf(filters.correo) !== -1 );
	if (filters.rate != null) rateFilter = (row.rate == filters.rate);
	if (filters.estado != null) estadoFilter = (row.estado == filters.estado);
	if (filters.publicar != null) publicarFilter = (row.publicar == filters.publicar); 
	
	return (fechaFilter && clienteFilter && correoFilter && rateFilter && estadoFilter && publicarFilter); 
	} )
	.leftJoin(estados).on('estado')
	.leftJoin(publico).on('publicar')
	.select(
		'id',
		'fecha',
		'nombre',
		'correo',
		'mensaje',
		'rate',
		'estado',
		'descEstado',
		'publicar',
		'descPublicar'
	);
	
	///Grafico
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
		.from(dataComents)
		.where( function(row){
			return (row.estado == 'A' && row.fecha.indexOf(mes) == 0)	
		})
		.groupBy('estado').avg('rate')
		.select();
		if (graf[0] !== undefined) data.push(graf[0].rate);
		else data.push(null);
	});
	
	$scope.labels = [meses[0],meses[1],meses[2],meses[3],meses[4],meses[5],meses[6]];
	$scope.data.push(data);
		
	
	var stat = new jinqJs()
	.from(dataComents).where( function(row){if (row.estado == 'P') $scope.stats.pendiente += 1}).select();
	var stat = new jinqJs()
	.from(dataComents).where( function(row){if (row.estado == 'R') $scope.stats.rechazado += 1}).select();
	var stat = new jinqJs()
	.from(dataComents).where( function(row){if (row.estado == 'A') $scope.stats.aprobado += 1}).select();
	var stat = new jinqJs()
	.from(dataComents).where( function(row){if (row.publicar == 'S') $scope.stats.publicar += 1}).select();
	var stat = new jinqJs()
	.from(dataComents).where( function(row){if (row.publicar == 'N') $scope.stats.nopublicar += 1}).select();
	
	var stat = new jinqJs()
	.from(dataComents).where( function(row){if (row.rate == 1) $scope.stats.rate1 += 1}).select();
	var stat = new jinqJs()
	.from(dataComents).where( function(row){if (row.rate == 2) $scope.stats.rate2 += 1}).select();
	var stat = new jinqJs()
	.from(dataComents).where( function(row){if (row.rate == 3) $scope.stats.rate3 += 1}).select();
	var stat = new jinqJs()
	.from(dataComents).where( function(row){if (row.rate == 4) $scope.stats.rate4 += 1}).select();
	var stat = new jinqJs()
	.from(dataComents).where( function(row){if (row.rate == 5) $scope.stats.rate5 += 1}).select();
	
	
	
	updateTable(comentarios);
	return;
}

$scope.add_filter = function(filter_name, filter_value){
	if (filters[filter_name] !== undefined){
		if (filter_value === "") filter_value = null;
		filters[filter_name] = filter_value;
		query();
	} else alert('Filtro invalido, por favor intentelo nuevamente.');
	return;
}

var requestProm = $http({
	method: "post",
	url: "../api/index.php",
	headers: {'Content-Type': 'application/x-www-form-urlencoded'},
	skipAuthorization: false,
	data: {
		action	:	'getPromComments_a'
	}
});
	
requestProm.success(function (res) {

	if(res.response.token !== undefined) store.set('token', res.response.token);
	
	switch (res.code) {
		case response_ok:
			$scope.prom=res.response.prom;
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

var getComents = function(){
	var requestCmts = $http({
		method: "post",
		url: "../api/index.php",
		headers: {'Content-Type': 'application/x-www-form-urlencoded'},
		skipAuthorization: false,
		data: {
			action	:	'getComments_a'
		}
	});
		
	requestCmts.success(function (res) {

	if(res.response.token !== undefined) store.set('token', res.response.token);
	switch (res.code) {
		case response_ok:
			dataComents=res.response.comments;
			if (dataComents.length > 0) query(dataComents);			
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
getComents();
	
$scope.newToken = function(nombre,correo){
	
	var request = $http({
		method: "post",
		url: "../api/index.php",
		headers: {'Content-Type': 'application/x-www-form-urlencoded'},
		skipAuthorization: false,
		data: {
			action	:	'NewTokenforComment',
			nombre : nombre,
			correo : correo
		}
	});
	
	request.success(function (res) {	
		if(res.response.token !== undefined) store.set('token', res.response.token);
		switch (res.code) {
			case response_ok:
				alert("Hemos enviado la invitacion a comentar al correo " + correo);
				break;
			case error_send_mail:
				alert("Error al enviar correo. Por favor intentelo nuevamente");
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
	
}

$scope.goto_filter = function(filter_name, filter_value){
	$cookies.put(filter_name, filter_value);
	$window.location = "gestion.php"
}

$scope.cookie = {
	fecha : '',
	estado : '',
	publicar : '',
	rate: ''
}

if ($cookies.get('fecha') !== undefined){
	var filter_name = 'fecha';
	var filter_value = $cookies.get('fecha');
	$scope.cookie.fecha = filter_value;
	$cookies.remove('fecha');
	$scope.add_filter(filter_name, filter_value);
	$scope.add_filter('estado', 'A');
}
if ($cookies.get('estado') !== undefined){
	var filter_name = 'estado';
	var filter_value = $cookies.get('estado');
	$scope.cookie.estado = filter_value;
	$cookies.remove('estado');
	$scope.add_filter(filter_name, filter_value);
}
if ($cookies.get('publicar') !== undefined){
	var filter_name = 'publicar';
	var filter_value = $cookies.get('publicar');
	$scope.cookie.publicar = filter_value;
	$cookies.remove('publicar');
	$scope.add_filter(filter_name, filter_value);
}
if ($cookies.get('rate') !== undefined){
	var filter_name = 'rate';
	var filter_value = $cookies.get('rate');
	$scope.cookie.rate = filter_value;
	$cookies.remove('rate');
	$scope.add_filter(filter_name, filter_value);
}


$scope.editar = function(data){
	
	var html = '';
	html += '<form accept-charset="UTF-8" ng-init="estado='+"'"+data.estado+"'"+'; publicar=(('+"'"+data.publicar+"'"+'=='+"'S'"+') ? true : false )" ng-submit="updateComent('+data.id+',estado,publicar)">';
	html += 'Fecha de creacion: '+data.fecha;
	html += '<br><br>';
	html += 'Nombre del cliente: '+data.nombre;
	html += '<br>';
	html += 'Correo Electrónico: '+data.correo;
	html += '<br><br>';
	html += 'Comentario: '+data.mensaje;
	if (data.rate != null){
		html += '<br>';
		html += 'Puntaje asignado: '+data.rate;
	}
	html += '<br><br>';
	html += '<table width="100%" style="border-top: 1px dashed black;">';
	html += '<tr>';
	html += '<td width="33.3%" style="text-align: center;"><input autocomplete="nope" type="radio" name="estado" ng-model="estado" value="A" ng-checked="('+"'"+data.estado+"'"+'=='+"'A'"+' || '+"'"+data.estado+"'"+'=='+"'P'"+')" required>Aprobar</td>';
	html += '<td width="33.3%" style="text-align: center;"><input autocomplete="nope" type="radio" name="estado" ng-model="estado" value="R" ng-checked="('+"'"+data.estado+"'"+'=='+"'R'"+')">Rechazar</td>';
	html += '<td width="33.3%" style="text-align: center;"><input autocomplete="nope" type="checkbox" id="p" ng-model="publicar" value="true" ng-checked="('+"'"+data.publicar+"'"+'=='+"'S'"+')"> <label for="p">Publicar</label></td>';
	html += '</tr>';
	html += '<tr>';
	html += '<td colspan="3" style="text-align: center;">';
	html += '<input type="submit" class="ngdialog-button ngdialog-button-primary" value="Aceptar">';
	html += '</td>';
	html += '</tr>';
	html += '</form>';
	
	$scope.diag = ngDialog.open({
		template: html,
		plain: true,
		scope: $scope,
		controller: 'control',
		className: 'ngdialog-theme-default'
	});
}

$scope.updateComent = function (id,estado,publicar){
	
	if (estado == 'P') estado = 'A';
	if (publicar === undefined) publicar = false;
	var _publicar = ((publicar) ? 'S' : 'N');
	var _publicar = ((estado == 'R') ? 'N' : _publicar);
	var request = $http({
		method: "post",
		url: "../api/index.php",
		headers: {'Content-Type': 'application/x-www-form-urlencoded'},
		skipAuthorization: false,
		data: {
			action	:	'updateComent',
			id  : id,
			estado	: estado,
			publicar : _publicar
		}
	});
	
	request.success(function (res) {	
		if(res.response.token !== undefined) store.set('token', res.response.token);
		switch (res.code) {
			case response_ok:
				getComents();
				$scope.diag.close();
				alert("Comentario actualizado exitosamente!");
				$window.location.reload();
				break;
			case user_unauthorized:
				$scope.goLogin();
				break;
			case access_forbidden:
				access_forbidden();
				break;
			default:
				alert("Error al actualizar comentario, intentelo nuevamente.");
				break;
		}		
	});
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
