/*  Angular Framework  */
app = angular.module("app",['angular-jwt', 'angular-storage','ngCookies']);
app.controller("control",function($scope,$window,$http,$interval,jwtHelper,store,$cookies,$location){

var db_isdown = 521;
var db_unknown_error = 520;
var access_forbidden = 500;
var token_invalid = 502;
var user_conflict = 409;
var bad_insert_request = 400;
var user_not_found = 404;
var invalid_password = 402
var user_created = 201;
var user_accepted = 202;
var pass_changed = 203;
var user_unauthorized = 401;
var response_ok = 0;
	
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

var access_forbidden = function (){
	var token = store.get("token") || null;
	if (token) store.remove("token");
	$scope.goLogin();
}
	
	
	$scope.Math = window.Math;
	$scope.paginacion = 10;
	$scope.paginas = 0;
	$scope.pag = 1;
	
	var request = $http({
		method: "post",
		url: "../api/index.php",
		headers: {'Content-Type': 'application/x-www-form-urlencoded'},
		skipAuthorization: !$scope.isAuth,
		data: {
			action	:	'getComents',
			
		}
	});
		
	request.success(function (res) {	
		if(res.response.token !== undefined) store.set('token', res.response.token);
	
		switch (res.code) {
			case response_ok:
				$scope.posts=res.response.comments;
				if ($scope.posts.length > 0){
					$scope.paginas = 1;
					if ($scope.posts.length > $scope.paginacion){
						$scope.paginas = $scope.posts.length/$scope.paginacion;
					}
				}
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
	
	$scope.changePag = function(i){
		$scope.pag = i;
		//console.log($scope.pag);
	}
	
	$scope.newPost = function(nombre,email,mensaje,rate,token){
		
		if(rate == undefined) rate = 0;
			
		var request = $http({
			method: "post",
			url: "../api/index.php",
			headers: {'Content-Type': 'application/x-www-form-urlencoded'},
			skipAuthorization: !$scope.isAuth,
			data: {
				action	:	'newComent',
				nombre  : nombre,
				email   : email,
				mensaje : mensaje,
				rate    : rate,
				token	: token
			}
		});
		
		
		request.success(function (res) {

			if(res.response.token !== undefined) store.set('token', res.response.token);
			
			switch (res.code) {
				case response_ok:
					alert("¡Gracias por tu comentario!");
					$window.location="../comentarios/";
					break;
				case token_invalid:
					alert("Ha utilizado un token invalido para comentar, comuniquese con el Servicio de Natura.");
					//$window.location="../";
					break;
				case user_unauthorized:
					$scope.goLogin();
					break;
				case access_forbidden:
					access_forbidden();
					break;
				default:
					alert("Ha ocurrido un error inesperado, por favor comunicate con el administrador");
					//$window.location="../";
					break;
			}	
		});
	}
});
app.filter('html', ['$sce', function($sce) {
	return function(text) { return $sce.trustAsHtml(text); };
}]);
app.filter('range', function(){
    return function(n) {
      var res = [];
      for (var i = 0; i < n; i++) {
        res.push(i+1);
      }
      return res;
    };
  });

