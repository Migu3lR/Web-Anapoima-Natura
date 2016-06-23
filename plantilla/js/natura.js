/*  Angular Framework  */
app = angular.module("app",['angular-jwt', 'angular-storage','ngCookies']);
app.controller("control",function($scope,$window,$http,$interval,jwtHelper,store,$cookieStore){

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
				store.set("r",$scope.user.rol);
				return true;
			}
		} else return false;
	}
	$scope.isAuth = auth();
	console.log($scope.isAuth);
	console.log($scope.user);
	
});
