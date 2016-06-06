angular.module("app",['ngSanitize'])
.controller("control",function($scope,$window,$http){

$scope.fmin=new Date();
$scope.fmax = new Date();

$scope.codes = [];
$scope.cod = "";
$scope.codeEdit = false;
$scope.edit={};
$scope.d5 = false;
$scope.d10 = false;
$scope.d15 = false;
$scope.a1 = "";
$scope.a2 = "";
$scope.a3 = "";
$scope.buscar="";
$scope.descuentos = "";
$scope.list = [];
$scope.filtered = [];
$scope.asgn = "";
$scope.mostrar = false;
var cant = 0;
var cant2 = 0;
var apr = [];
$http.get("getCodes.php?e=1")
.then(function (response) {
$scope.codes = response.data.records;
});
var users = [];
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

$scope.changeDscr=function(a){ $scope.dscr = a; }
$scope.changeFmin=function(a){ $scope.fmin = a; }
$scope.changeFmax=function(a){ $scope.fmax = a; }
$scope.changeDscn=function(a){ $scope.dscn = a; }

$scope.changeA=function(a){
$scope.asgn = a;
console.log($scope.asgn);
$scope.list = [];
$scope.filtered = [];
if ($scope.asgn == "Masivo") {
$scope.mostrar = true;
} else {
$scope.mostrar = false;
}
}
$scope.addUser=function(user){
cant=0;
cant2=0;
angular.forEach($scope.list, function(list) {
cant++;
if(list.ID != user.ID){
cant2++;
}
});

if (cant == cant2){
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

request.success(function (data) {	
var resp = angular.fromJson(data);
if (resp.error != 0) 
$scope.error = "Ha ocurrido un error, intentelo nuevamente.";
else $window.location.href = 'administrar.php';
});
}
$scope.change=function(id){
$scope.cod = id;
}

$scope.select=function(){
$scope.codeEdit=true;
angular.forEach($scope.codes, function(code) {
if (code.ID == $scope.cod){
$scope.edit = {
code: code.cdgo,
dscr: code.dscr, 
asgn: code.asgn, 
dscn: parseInt(code.dscn), 
fmin: code.fmin, 
fmax: code.fmax
};
if (code.dscn == 5) $scope.d5 = true;
if (code.dscn == 10) $scope.d10 = true;
if (code.dscn == 15) $scope.d15 = true;
if (code.asgn == "Unico") $scope.a1 = "checked";
if (code.asgn == "Masivo") $scope.a2 = "checked";
if (code.asgn == "Multiple") $scope.a3 = "checked";
$scope.asgn = code.asgn;
if ($scope.asgn == "Masivo") {
$scope.mostrar = true;
} else {
$scope.mostrar = false;
}
$scope.code = code.cdgo;
$scope.dscr = $scope.edit.dscr;
$scope.dscn = parseInt(code.dscn);
var min = new Date(code.fmin);
$scope.fmin = new Date(min.getUTCFullYear(),min.getUTCMonth(),min.getUTCDate());
var max = new Date(code.fmax);
$scope.fmax = new Date(max.getUTCFullYear(),max.getUTCMonth(),max.getUTCDate());

$http.get("getAsgn.php?c=" + code.cdgo)
.then(function (response) {
$scope.list = response.data.records;
});
}
});
}
$scope.editar=function(min,max){
dataCode = { 
ID : $scope.cod,
code: $scope.code,
dscr: $scope.dscr, 
asgn: $scope.asgn, 
dscn: $scope.dscn, 
fmin: $scope.fmin, 
fmax: $scope.fmax,
clnt: $scope.list
};

sql(dataCode,"updCode");
}

})
.filter('capitalize', function() {
return function(input, all) {
var reg = (all) ? /([^\W_]+[^\s-]*) */g : /([^\W_]+[^\s-]*)/;
return (!!input) ? input.replace(reg, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();}) : '';
}
}).filter('html', ['$sce', function($sce) {
return function(text) {
return $sce.trustAsHtml(text);
};
}]);