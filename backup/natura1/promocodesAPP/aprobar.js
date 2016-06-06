angular.module("app",[])
.controller("control",function($scope,$window,$http){
	$scope.codes = [];
	var apr = [];
	var cant = 0;
	$http.get("getCodes.php?e=0")
    .then(function (response) {
		$scope.codes = response.data.records;
		angular.forEach($scope.codes, function(code) {
			cant++;
			apr = apr.concat({ID : parseInt(code.ID), ap : false});
		});		
		if (cant == 0) $window.location.href = 'administrar.php';
	});
	
	$scope.change=function(id){
		for (var i =0; i < apr.length; i++){
			if(apr[i].ID == id) apr[i].ap = !apr[i].ap;
		}
	}
	
	
	var sql = function(dataCode,dir){
		var request = $http({
			method: "post",
			url: "http://localhost/" + dir + ".php",
			data: dataCode,
			headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
		});

		request.success(function (data) {	
			var resp = angular.fromJson(data);
			console.log(resp.error);
			if (resp.error != 0) 
				$scope.error = "Ha ocurrido un error, intentelo nuevamente.";
			else $window.location.href = 'aprobar.php';
		});
	}
	
	$scope.aprobar=function(){
		sql({codes : apr},"aprCode");	
	}
})
.filter('capitalize', function() {
	return function(input, all) {
		var reg = (all) ? /([^\W_]+[^\s-]*) */g : /([^\W_]+[^\s-]*)/;
		return (!!input) ? input.replace(reg, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();}) : '';
	}
});