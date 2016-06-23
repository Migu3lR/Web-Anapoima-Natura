app = angular.module("app",['angular-hmac-sha512','ngAnimate','angular-jwt', 'angular-storage']);
app.controller("control",function($scope,$crypthmac,$window,$http,jwtHelper,store){

//Usuario Autorizado?
	//obtenemos el token en localStorage
	//decodificamos para obtener los datos del user
	//los mandamos a la vista como user
	$scope.isAuth = function(){
		var token = store.get("token") || null;
		if (token) {
		if (jwtHelper.isTokenExpired(token)) store.remove("token");
			else {
				$scope.user = jwtHelper.decodeToken(token);
				return true;
			}
		}return false;
	}
var db_isdown = 521;
var db_unknown_error = 520;
var user_conflict = 409;
var bad_insert_request = 400;
var user_not_found = 404;
var user_created = 201;
var user_accepted = 202;
var user_unauthorized = 401;
$scope.form = true;

$scope.showError = false;
$scope.eIn = false;
$scope.eUp = false;


$scope.valid = {
	nombre : true, 
	correo : true, 
	correoCnf : true, 
	clave : true, 
	claveCnf : true, 
	fecha : true, 
	telefono : true, 
	tipo : true, 
	documento : true,
	nacionalidad : true, 
	municipio : true,
	correoIn : true,
	claveIn : true
};
	
var dir = "";			
$scope.resp = 0;
$scope.msg = "";
	
	var sql = function(dataCode,dir){
                $scope.showError = false;
		var request = $http({
			method: "post",
			url: "../api/index.php",
			headers: {'Content-Type': 'application/x-www-form-urlencoded'},
			skipAuthorization: true,
			/*transformRequest: function(obj) {
				var str = [];
				for(var p in obj)
				str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
				return str.join("&");
			},*/
			data: dataCode
		});

		/* Check whether the HTTP Request is successful or not. */
		request.success(function (res) {
			
			if(res && res.code == user_accepted) store.set('token', res.response.token);
			
			switch (res.code) {
				case db_isdown:
					$scope.msg = "Ha ocurrido un error inesperado, por favor vuelve a intentarlo";
					$scope.error
					break;
				case db_unknown_error:
					$scope.msg = "Ha ocurrido un error inesperado, por favor vuelve a intentarlo";
					break;
				case user_conflict:
					$scope.msg = "Ya tenemos a un cliente con esos datos. Si ya te has inscrito, por favor inicia sesión";
					break;
				case bad_insert_request:
					$scope.msg = "Ha ocurrido un error inesperado, por favor vuelve a intentarlo";
					break;
				case user_not_found:
					$scope.msg = "Usuario o Contraseña invalidos, intentalo nuevamente";
					break;
				case user_created:
					$scope.msg = "!Gracias por unirte a Natura! Por favor inicia sesión y disfruta de todos nuestros beneficios para ti.";
					$scope.form = false;
					break;
				case user_accepted:
					$scope.msg = "";
					$window.location = "/";
					break;
				case user_unauthorized:
					$scope.msg = "Usuario o Contraseña invalidos, intentalo nuevamente";
					break;
			}	
			if (res.code > user_accepted)
				$scope.showError = true;
			else $scope.showError = false;
			
		});
	}
	
	$scope.signup = function (nombre, apellido, correo, correoCnf, clave, claveCnf, fecha, telefono, tipo, documento,nacionalidad,municipio){
                $scope.eUp = false;
		var mas5menos20 = new RegExp("^[a-zA-Z \-]{5,20}$");
		var mas3menos20 = new RegExp("^[a-zA-Z \-]{3,20}$");
		var num = new RegExp("^[0-9]+$");
		var mail = new RegExp("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$");
		
		if (nombre == undefined || nombre.length == 0) $scope.valid.nombre = false;
		else $scope.valid.nombre = mas5menos20.test(nombre);
		$scope.valid.correo = mail.test(correo);
		if (correo != correoCnf) $scope.valid.correoCnf = false;
		if (correo == correoCnf) $scope.valid.correoCnf =  true;
		if (clave == undefined || clave.lenght < 8) $scope.valid.clave = false;
		else $scope.valid.clave = true;		
		if (clave != claveCnf) $scope.valid.claveCnf = false;
		if (clave == claveCnf) $scope.valid.claveCnf = true;
		if (telefono == undefined || telefono.length == 0){ 
			$scope.valid.telefono = true;
			telefono = 'NULL';
		}
		else $scope.valid.telefono = num.test(telefono);
		$scope.valid.documento = num.test(documento);
		if (nacionalidad == undefined || nacionalidad.length == 0) $scope.valid.nacionalidad = false;
		else $scope.valid.nacionalidad = mas3menos20.test(nacionalidad);
		if (municipio == undefined || municipio.length == 0) $scope.valid.municipio = false;
		else $scope.valid.municipio = mas3menos20.test(municipio);
		
		if ($scope.valid.nombre && $scope.valid.correo && $scope.valid.correoCnf && $scope.valid.clave && $scope.valid.claveCnf && $scope.valid.telefono && $scope.valid.documento && $scope.valid.nacionalidad && $scope.valid.municipio){
			var data = {
				nombre   : nombre,
				correo   : correo,
				clave    : clave,
				fecha	 : fecha,
				telefono : telefono,
				tipo	 : tipo,
				documento: documento,
				nacionalidad:nacionalidad,
				municipio: municipio
			};
			
			data.clave = $crypthmac.encrypt(data.clave,"NtraSfe")
			sql(data,"newUser");
                        $scope.eUp = true;
		}
	}
	$scope.signin = function (correoIn, claveIn){
        $scope.eIn = false;
		if ( correoIn == undefined || correoIn.length == 0) $scope.valid.correoIn = false;
		else $scope.valid.correoIn = true;
		if ( claveIn == undefined || claveIn.length == 0) $scope.valid.claveIn = false;
		else $scope.valid.claveIn = true;

		if($scope.valid.correoIn && $scope.valid.claveIn){
			
			var data = {
				action	: 'login',
				correo   : correoIn,
				clave    : claveIn
			};
			data.clave = $crypthmac.encrypt(data.clave,"NtraSfe")
			sql(data,"loginUser");
            $scope.eIn = true;
		}
	}
	
});

app.controller("logout",function($scope,$crypthmac,$window,$http,jwtHelper,store){
	
	//obtenemos el token en localStorage
		var token = store.get("token") || null;
		if (token) {
			store.remove("token");
			store.remove("r");
		}
		$window.location = "/";
});

app.config(["$httpProvider", "jwtInterceptorProvider",  function ($httpProvider, jwtInterceptorProvider) 
{
    $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
    
    //en cada petición enviamos el token a través de los headers con el nombre Authorization
    jwtInterceptorProvider.tokenGetter = function() {
        return localStorage.getItem('token');
    };
    $httpProvider.interceptors.push('jwtInterceptor');
}]);