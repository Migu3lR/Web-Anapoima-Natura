angular.module("app",[])
.controller("control",function($scope,$window,$http){
	var users = [];
	$scope.filtered = [];
	$scope.error = "";
	$scope.us = "";
	$scope.buscar="";
	$scope.list = [];
	$scope.asgn = "";
	$scope.mostrar = false;
	$http.get("getUsers.php")
    .then(function (response) {
		users = response.data.records;
		});
	
	$scope.searching=function(txt){
		var searchText = txt.toLowerCase();
		$scope.filtered = [];
		if (searchText != ''){
			angular.forEach(users, function(user) {
				if( user.nmbre.toLowerCase().indexOf(searchText) >= 0 ) $scope.filtered.push(user);
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
	$scope.addUser=function(user){
		if ($scope.list.indexOf(user) == -1){
			if ($scope.asgn == "Unico" && $scope.list.length < 1) $scope.list.push(user);
			if ($scope.asgn == "Multiple") $scope.list.push(user);
		}
	}	
	
	var sql = function(dataCode,dir){
		var request = $http({
			method: "post",
			url: "http://localhost/" + dir + ".php",
			data: dataCode,
			headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
		});

		/* Check whether the HTTP Request is successful or not. */
		request.success(function (data) {	
			var resp = angular.fromJson(data);
			if (resp.error != 0) 
				$scope.error = "Ha ocurrido un error, intentelo nuevamente.";
			else $window.location.href = 'administrar.php';
		});
	}
	
	$scope.newCode=function(){
		dataCode = { 
			code: $scope.code,
			dscr: $scope.dscr, 
			asgn: $scope.asgn, 
			dscn: $scope.dscn, 
			fmin: $scope.fmin, 
			fmax: $scope.fmax,
			clnt: $scope.list
		};
		sql(dataCode,"addCode");	
	}
})
.filter('capitalize', function() {
	return function(input, all) {
		var reg = (all) ? /([^\W_]+[^\s-]*) */g : /([^\W_]+[^\s-]*)/;
		return (!!input) ? input.replace(reg, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();}) : '';
	}
});