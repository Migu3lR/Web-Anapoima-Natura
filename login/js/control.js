angular.module("app",['angular-hmac-sha512','ngAnimate'])
.controller("control",function($scope,$crypthmac,$window,$http){
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
	apellido : true, 
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
			url: "../login/" + dir + ".php",
			data: dataCode,
			headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
		});

		/* Check whether the HTTP Request is successful or not. */
		request.success(function (data) {	
			$scope.resp = angular.fromJson(data).resp;
			console.log($scope.resp);
			switch ($scope.resp) {
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
					$window.location.reload();
					break;
				case user_unauthorized:
					$scope.msg = "Usuario o Contraseña invalidos, intentalo nuevamente";
					break;
			}	
			if ($scope.resp > user_accepted)
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
		else $scope.valid.nombre = mas3menos20.test(nombre);
		if (apellido == undefined || apellido.length == 0) $scope.valid.apellido = false;
		else $scope.valid.apellido = mas3menos20.test(apellido);
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
		
		if ($scope.valid.nombre && $scope.valid.apellido && $scope.valid.correo && $scope.valid.correoCnf && $scope.valid.clave && $scope.valid.claveCnf && $scope.valid.telefono && $scope.valid.documento && $scope.valid.nacionalidad && $scope.valid.municipio){
			var data = {
				nombre   : nombre,
				apellido : apellido,
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
				correo   : correoIn,
				clave    : claveIn
			};
			data.clave = $crypthmac.encrypt(data.clave,"NtraSfe")
			sql(data,"loginUser");
                        $scope.eIn = true;
		}
	}
	
})
.filter('html', ['$sce', function($sce) {
	return function(text) { return $sce.trustAsHtml(text); };
}]);