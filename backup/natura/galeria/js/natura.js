/*  Angular Framework  */
app = angular.module("app",[]);
app.controller("control",function($scope,$window,$http,$interval){
	$scope.Math = window.Math;
	$scope.paginacion = 10;
	$scope.paginas = 0;
	$scope.pag = 1;
	var request = $http({
		method: "post",
		url: "../comentarios/getPost.php",
		data: {},
		headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
	});
		
	request.success(function (data) {	
		$scope.posts = angular.fromJson(data).records;
		if ($scope.posts.length > 0){
			$scope.paginas = 1;
			if ($scope.posts.length > $scope.paginacion){
				$scope.paginas = $scope.posts.length/$scope.paginacion;
			}
		}
		console.log(Math.ceil($scope.paginas));
	});
	
	$scope.changePag = function(i){
		$scope.pag = i;
		console.log($scope.pag);
	}
	
	$scope.newPost = function(nombre,email,mensaje){
		var request = $http({
			method: "post",
			url: "../comentarios/newPost.php",
			data: {
					nombre  : nombre,
					email   : email,
					mensaje : mensaje
				},
			headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
		});
		
		request.success(function (data) {	
			$scope.resp = angular.fromJson(data).resp;
			if ($scope.resp == 0){
				$window.location.reload();
			}
			console.log("Error al agregar comentario.");	
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

function existeClase(obj,cls)
  {
	return obj.className.match(new RegExp('(\\s|^)'+cls+'(\\s|$)'));
  }

function alterClass(obj,cls)
  {
   if(!existeClase(obj,cls)) {
    obj.className+=" "+cls;
   }
   else{
	   var exp =new RegExp('(\\s|^)'+cls+'(\\s|$)');
		obj.className=obj.className.replace(exp,"");
   }
  }

var contact = document.getElementById('contactForm');
var cls = 'active';

function activate(){
	alterClass(contact,cls);
}
