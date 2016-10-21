// Se cargan en ambiente librerias necesarias para Angular
app = angular.module("app",['angular-jwt', 'angular-storage','chart.js','ngCookies','angularMoment','ngDialog']);
//Configuracion del Grafico mostrado en Calidad.php
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
  //Se inicializa controlador para los sitios index.php, gestion.php y calidad.php
app.controller("control",function($scope,$window,$http,$interval,$cookies,ngDialog,jwtHelper,store,$location){
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
var access_forbidden = function (){ 
	var token = store.get("token") || null; 
	if (token) store.remove("token"); //Si el usuario que intenta acceder se encuentra logeado con un token en el WebStorage, se elimina el token
	var url = store.get("url") || null;
	if (url) store.remove("url"); //Tambien se elmina url de retorno si se encuentra almacenada
	$window.location = '../login/'; //Se envia al usuario a login
}

//Al acceder a este sitio se almacena url de retorno, en caso de salida retornable
var url = function (){ store.set('url', $location.absUrl());}

$scope.goLogin = function(){ url(); $window.location = '../login/'; } //Al llamar esta funcion nos envia a login
$scope.goLogout = function(){ url(); $window.location = '../login/logout.php'; } //Al llamar a esta funcion nos envia a logout

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
				
				if($scope.user.rol == 1) return true; //Se consula si el usuario tiene permisos de Administrador para poder continuar
				else return false;
			}
		} else return false;
	}
	$scope.isAuth = auth();
	

if (!$scope.isAuth) access_forbidden(); // Si el usuario no esta autorizado correctamente se llama a Acceso Denegado.
else{

//Se inicializan variables de Grafico mostrado en calidad.php
$scope.labels = []; 
$scope.data = [];
$scope.series = ['Puntuación Visitantes']; //Label del eje X del grafico
$scope.onClick = function (points, evt) {
	//Al hacer clic en alguno de los puntos graficados, esto nos envia a gestion.php con el filtro de la fecha seleccionada
	if (points[0] !== undefined) $scope.goto_filter('fecha', points[0].label); 	
};

$scope.prom = 0;

var dataComents = []; //Se inicializa variable que contendra la informacion de los comentarios en base de datos 
var filters={ //Se inicializa variable JSON que contendra los filtros a visualizar desde gestion.php
	fecha : null,
	cliente: null,
	correo: null,
	rate: null,
	estado: null,
	publicar: null
};

$scope.stats = { //Se inicializa variable JSON que contendra los datos de los KPI a mostrar en index.php
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

//variable con la descripcion de los posibles estados de comentarios en Base de datos para mostrar en gestion.php
var estados = [{estado: 'R', descEstado: 'Rechazado'},
                {estado: 'A', descEstado: 'Aprobado'},
                {estado: 'P', descEstado: 'Pendiente'}];
$scope.estados = estados;

//variable con la descripcion de los posibles estados de publicacion de comentarios en Base de datos para mostrar en gestion.php
var publico = [{publicar: 'S', descPublicar: 'Publicado'},
                {publicar: 'N', descPublicar: 'No publicar'}];
$scope.publico = publico;

$scope.comentarios = []; //Variable para enviar los datos de los comentarios a la vista en gestion.php
var inicio = 0

var updateTable = function(data){ //Al llamar a updateTable se cargan datos en variable comentarios para actualizar la vista.
	$scope.comentarios = data;
	return;
}

//En la funcion query se realizan todos los filtros para mostrar en gestion.php y tambien se cargan los datos para los KPI
var query = function (){
	var comentarios = new jinqJs() //Se inicializa varible con objeto de la libreria jinqJS
	.from(dataComents)
	.where( function(row) { 
		//Se inicializan variables internas para control de los filtros
	var fechaFilter = true;
	var clienteFilter = true;
	var correoFilter = true;
	var rateFilter = true;
	var estadoFilter = true;
	var publicarFilter = true;
		
		//Se realiza filtro de informacion, dependiendo de los valores seleccionados en la vista o por filtros externos
	if (filters.fecha != null) fechaFilter = (row.fecha.indexOf(filters.fecha) !== -1 ); //Filtro 'contiene'
	if (filters.cliente != null) clienteFilter = (row.nombre.indexOf(filters.cliente) !== -1 ); //Filtro 'contiene'
	if (filters.correo != null) correoFilter = (row.correo.indexOf(filters.correo) !== -1 ); //Filtro 'contiene'
	if (filters.rate != null) rateFilter = (row.rate == filters.rate); //Filtro 'igual'
	if (filters.estado != null) estadoFilter = (row.estado == filters.estado); //Filtro 'igual'
	if (filters.publicar != null) publicarFilter = (row.publicar == filters.publicar); //Filtro 'igual'
	//Se valida que todos los filtro se cumplan para sacar la data
	return (fechaFilter && clienteFilter && correoFilter && rateFilter && estadoFilter && publicarFilter); 
	} )
	.leftJoin(estados).on('estado') //Enlazamos las descripciones de estados
	.leftJoin(publico).on('publicar') //Enlazamos las descripciones de publicar
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
	
	///Las siguientes lineas es para darle la estructura al grafico de calidad.php

	//Se definen los valores a mostrar en el eje X
	var meses = {
		6 : moment().format("YYYY[-]MM"),	
		5 : moment().subtract(1,'months').format("YYYY[-]MM"),
		4 : moment().subtract(2,'months').format("YYYY[-]MM"),
		3 : moment().subtract(3,'months').format("YYYY[-]MM"),
		2 : moment().subtract(4,'months').format("YYYY[-]MM"),
		1 : moment().subtract(5,'months').format("YYYY[-]MM"),
		0 : moment().subtract(6,'months').format("YYYY[-]MM")
	}
	$scope.labels = [meses[0],meses[1],meses[2],meses[3],meses[4],meses[5],meses[6]];

	//Se definen los valores a mostrar en el eje Y
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
	$scope.data.push(data);
		
	//Definicion de los KPI a mostrar en la vista index.php
	//Panel izquierdo
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
	
	//Panel derecho
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

	//Se llama a updateTable para actualizar la tabla de datos en la vista	
	updateTable(comentarios);
	return;
}

//Funcion add_filter genera filtros en la informacion mostrada, realizados desde la misma vista o desde un link externo
//Se recibe el nombre del filtro y el valor a aplicar al filtro, esto llama nuevamente a la funcion query() para actualizar el filtrado
$scope.add_filter = function(filter_name, filter_value){
	if (filters[filter_name] !== undefined){
		if (filter_value === "") filter_value = null;
		filters[filter_name] = filter_value;
		query();
	} else alert('Filtro invalido, por favor intentelo nuevamente.');
	return;
}

//Al iniciar el controlador, se invoca el metodo getPromComments_a del API en Back-End
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
//Si el request se realizo correctamente, se captura el token de seguridad del usuario
	if(res.response.token !== undefined) store.set('token', res.response.token);
	
	//Se ejecuta sentencia dependiendo de codigo de respuesta
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

//Al iniciar el controlador se invoca el metodo getComments_a del API en Back-End
//Para obtener listado de comentarios
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
		//Si la consulta resulto sin error, se captura resultado
			dataComents=res.response.comments;
			if (dataComents.length > 0) query(dataComents);		//Se genera informacion para la tabla en la vista 	
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
	
//Funcion newToken creada para invocar metodo NewTokenforComment que envia un token de seguridad al correo de cliente para realizar un comentario
//Se llama en la vista index.php
$scope.newToken = function(nombre,correo){
	
	var request = $http({
		method: "post",
		url: "../api/index.php",
		headers: {'Content-Type': 'application/x-www-form-urlencoded'},
		skipAuthorization: false,
		data: {
			action	:	'NewTokenforComment',
			nombre : nombre, //Se requiere el dato de nombre y correo del cliente
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

//Funcion goto_filter genera un filtro a partir de algun enlace de las vistas de este controlador
//El filtro solicitado es almacenado en un Cookie para ser capturado al cambiar de vista
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

//Se capturan los filtros realizados de desde las otras vistas del controlador asi como los filtros externos
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

//Funcion editar llamada para editar los datos de algun comentario, llamado desde la vista gestion.php
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
	
	//Al llamar a la funcion editar se abre un cuadro de dialogo con la libreria ngDialog
	$scope.diag = ngDialog.open({
		template: html,
		plain: true,
		scope: $scope,
		controller: 'control',
		className: 'ngdialog-theme-default'
	});
}

//Funcion updateComent llamada para actualizar los comentarios
$scope.updateComent = function (id,estado,publicar){
	
	//Si el estado recibido es Pendiente, se cambia a Activo
	if (estado == 'P') estado = 'A';
	//Si no se selecciona un estado de publicacion se deja en False
	if (publicar === undefined) publicar = false;
	//Los valores de estado de publicacion se cambian a S y N 
	var _publicar = ((publicar) ? 'S' : 'N');
	//si el comentario esta en estado Rechazado se cambia estado publicacion a N o se deja el mismo valor
	var _publicar = ((estado == 'R') ? 'N' : _publicar);
	
	//Se envia solicitud a la API en Back-End
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
