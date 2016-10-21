//Se inicializa controlador para los sitios index.php, editProfile.php
app = angular.module("app",['angular-hmac-sha512','angular-jwt', 'angular-storage','ngCookies','ngFileUpload', 'ngImgCrop']);
app.controller("control",function($scope,$crypthmac,$window,$http,$interval,jwtHelper,store,$cookies,$location,Upload, $timeout){

//Variables de codigos de error en Back-End(Ver /api/index.php)
var db_isdown = 521;
var db_unknown_error = 520;
var access_forbidden = 500;
var user_conflict = 409;
var bad_insert_request = 400;
var user_not_found = 404;
var invalid_password = 402
var user_created = 201;
var user_accepted = 202;
var pass_changed = 203;
var user_unauthorized = 401;
var FileNotImage = 1001;
var FileTooLarge = 1002;
var FileErrorFormat = 1003;
var ErrorOnUpload = 1004;
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
				
				if($cookies.get("x")===undefined){
					// Find tomorrow's date.
					var expireDate = new Date();
					expireDate.setTime(expireDate.getTime() + (60*1000*2) - (0*60*60*1000));
					// Setting a cookie
					$cookies.put("x",$scope.user.rol, {'expires': expireDate});
						
				}return true;
			}
		} else return false;
	}
	$scope.isAuth = auth();

if (!$scope.isAuth) access_forbidden(); // Si el usuario no esta autorizado correctamente se llama a Acceso Denegado.
else{

var roles = [{rol: 0, descRol: 'Cliente'},
           	 {rol: 1, descRol: 'Administrador'}];
$scope.roles = roles;

$scope.book_status ={confirmed: 'Confirmada',
                	 cancelled: 'Cancelada',
					 pending: 'Pendiente',
					 not_confirmed: 'Sin Confirmar'};

////Consultar datos cliente
	var request = $http({
		method: "post",
		url: "../api/index.php",
		headers: {'Content-Type': 'application/x-www-form-urlencoded'},
		skipAuthorization: false,
		data: {
			action	:	'getUserInfo'
		}
	});

	/* Check whether the HTTP Request is successful or not. */
	request.success(function (res) {

	if(res.response.token !== undefined) store.set('token', res.response.token);
	
	switch (res.code) {
		case response_ok:
			$scope.userinfo=res.response.userInfo[0];
			$scope.userbookings=res.response.userBookings;
			$scope.usercomments=res.response.userComments;
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
	

var opciones = [{opcion: 0, descOpcion: 'Panel Principal'}
                ,{opcion: 1, descOpcion: 'Ver mis Reservas'}
				,{opcion: 2, descOpcion: 'Ver mis Comentarios'}
				//,{opcion: 3, descOpcion: 'Ver mis Promociones'}
			   ];
$scope.opciones = opciones;

var sql = function(data){
//Funcion para envio de distintas solicitudes a Back-End
	var request = $http({
		method: "post",
		url: "../api/index.php",
		headers: {'Content-Type': 'application/x-www-form-urlencoded'},
		skipAuthorization: false,
		data: data
	});

	/* Check whether the HTTP Request is successful or not. */
	request.success(function (res) {
	if(res.response.token !== undefined) store.set('token', res.response.token);
	
	switch (res.code) {
		case response_ok:
			$window.location.reload();
			break;
		case user_unauthorized:
			$scope.goLogin();
			break;
		case access_forbidden:
			access_forbidden();
			break;
		case invalid_password:
			alert("La contraseña actual ingresada no es correcta, intentalo nuevamete.")
			break;
		case pass_changed:
			alert("Contraseña cambiada exitosamente");
			$window.location.reload();
			break;
		default:
			alert("Ha ocurrido un error inesperado, por favor comunicate con el administrador");
			break;
	}	
	});
}

//Funcion para editar info personal de usuario desde formulario
$scope.editPersonal = function (nombre,telefono,pais,ciudad,nacimiento){
	if (telefono==undefined) telefono = $scope.userinfo.tlfno;
	if (telefono==null) telefono = 0;
	if (nombre==undefined) nombre = $scope.userinfo.nmbre;
	if (pais==undefined) pais = $scope.userinfo.ncnldad;
	if (ciudad==undefined) ciudad = $scope.userinfo.cdad;
	if (nacimiento==undefined) nacimiento = $scope.userinfo.fcha_ncmnto;
	datos = {
		id_cln: $scope.userinfo.id_cln,
		nombre: nombre,
		telefono: telefono,
		pais: pais,
		ciudad: ciudad,
		nacimiento: nacimiento,
		action:'editUser_personal'
	};
	sql(datos);	//Se envía solicitud a Back-End llamando a la funcion sql()
}

//Funcion para carga de foto de perfil de usuario	

$scope.upload = function (dataUrl, name) {
	$scope.errorMsg = undefined;
	Upload.upload({
		url: '../api/index.php',
		data: {
			file: Upload.dataUrltoBlob(dataUrl, name)
		},
	}).then(function (response) {
		$timeout(function () {
			var res = response.data;
			if(res.response.token !== undefined) store.set('token', res.response.token);
			
			switch (res.code) {
				case response_ok:
					alert("Su imagen de perfil se ha actualizado exitosamente!");
					$window.location.reload();
					$scope.errorMsg = "";
					break;
				case user_unauthorized:
					$scope.goLogin();
					break;
				case access_forbidden:
					access_forbidden();
					break;
				case FileNotImage:
					$scope.errorMsg = "El archivo seleccionado no es una imagen";
					alert($scope.errorMsg);
					break;
				case FileTooLarge:
					$scope.errorMsg = "El archivo seleccionado no es demasiado pesado";
					alert($scope.errorMsg);
					break;
				case FileErrorFormat:
					$scope.errorMsg = "Solo puede cargar imagenes de formato .JPG, .JPEG y .PNG";
					alert($scope.errorMsg);
					break;
				case ErrorOnUpload:
					$scope.errorMsg = "La imagen seleccionada no se pudo cargar, intentelo mas tarde.";
					alert($scope.errorMsg);
					break;
			}	
			if ($scope.errorMsg == undefined) alert("Debe seleccionar una imagen para subir.");
		});
	}, function (response) {
		if (response.status != 200) {
			$scope.errorMsg = "Ha ocurrido un error, vuelva a intentarlo mas tarde.";
			alert($scope.errorMsg);
		}
	}, function (evt) {
		$scope.progress = parseInt(100.0 * evt.loaded / evt.total);
	});
}

//Parametros para validacion de formulario
$scope.valid = {
	nueva : true, 
	confirmacion : true, 
	anterior : true
};
//Funcion para editar contraseña de usuario
$scope.editPwd = function(anterior,confirmacion,nueva){
	///Validacion de campos
	if (anterior == undefined || anterior ==null) $scope.valid.anterior = false;
	if (nueva == undefined || nueva.length < 8) $scope.valid.nueva = false;
	else $scope.valid.nueva = true;		
	if (nueva != confirmacion) $scope.valid.confirmacion = false;
	if (nueva == confirmacion) $scope.valid.confirmacion = true;
	if ($scope.valid.anterior && $scope.valid.nueva && $scope.valid.confirmacion ){
		datos = {
			id_cln: $scope.userinfo.id_cln,
			nueva: nueva,
			anterior: anterior,
			action:'changePass'
		};
	
		datos.nueva = $crypthmac.encrypt(datos.nueva,"NtraSfe");
		datos.anterior = $crypthmac.encrypt(datos.anterior,"NtraSfe");
		sql(datos);	
	}
}

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
