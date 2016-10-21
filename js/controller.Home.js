//Se inicializa controlador para los sitios index.php
app = angular.module("app",['angular-jwt', 'angular-storage','ngCookies']);
app.controller("control",function($scope,$window,$http,$interval,jwtHelper,store,$cookies,$location){

//Al acceder a este sitio se almacena url de retorno, en caso de salida retornable
var url = function (){ store.set('url', $location.absUrl());}

$scope.goLogin = function(){ url(); $window.location = 'login/'; } //Al llamar esta funcion nos envia a login
$scope.goLogout = function(){ url(); $window.location = 'login/logout.php'; } //Al llamar a esta funcion nos envia a logout

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
					$cookies.put("x",$scope.user.rol, {'path':'/'});
					
				}
				return true;
			}
		} else return false;
	}
	$scope.isAuth = auth();
	
	//Funcion sendMail para envio de correo electronico de contacto
	$scope.sendMail = function(nombre,email,body){
		
		var request = $http({
			method: "post",
			url: "../mail/sm.php",
			data: {
					nombre   : nombre,
					email : email,
					body   : body
				},
			headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
		});
		
		request.success(function (data) {	
			if(data == 1) {
				//Si se envió correo correctamente se recarga la página
				alert(nombre + ", gracias por contactarse con nosotros. Pronto contestaremos su mensaje.");
				$window.location.reload();
			}
			else alert("Ha ocurrido un error al enviar el mensaje, intentelo de nuevo por favor.");
		});

	}
	
});
app.filter('html', ['$sce', function($sce) {
	return function(text) { return $sce.trustAsHtml(text); };
}]);

