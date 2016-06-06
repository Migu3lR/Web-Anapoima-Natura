/*  Angular Framework  */
app = angular.module("app",[]);

app.controller("control",function($scope,$window,$location){
	
	$scope.book = function(adultos,ninos){
		console.log($scope.checkin);
		console.log($scope.checkout);
		var fecha1 = $scope.checkin.split('-');
		var date1 = new Date(parseInt(fecha1[2]),parseInt(fecha1[1])-1,parseInt(fecha1[0]));
		var fecha2 = $scope.checkout.split('-');
		var date2 = new Date(parseInt(fecha2[2]),parseInt(fecha2[1])-1,parseInt(fecha2[0]));
		if (date1 >= date2){
			alert("Para buscar tu reserva, la fecha de Checkout debe ser posterior a la fecha de Checkin.");
		}else{
			$window.location.href = 'http://' + $location.host() + '/booking/book.html#!/Rooms/date_from:' + $scope.checkin + '/date_to:' + $scope.checkout + '/adults:' + adultos + '/children:' + ninos;
		}
	}
	
});
app.directive("dpin", function () {
  return {
    restrict: "A",
    require: "ngModel",
    link: function (scope, element, attrs, ngModelCtrl) {
		element.datepicker({
			changeMonth: true,  
			changeYear:true, 
			dateFormat: 'dd-mm-yy',
			minDate: 0,
			onSelect:function (date) {
				scope.$apply(function () {
					ngModelCtrl.$setViewValue(date);
					scope.checkin = date;
				});
			}
		});
    }
  }
});
app.directive("dpout", function () {
  return {
    restrict: "A",
    require: "ngModel",
    link: function (scope, element, attrs, ngModelCtrl) {
		element.datepicker({
			changeMonth: true,  
			changeYear:true, 
			dateFormat: 'dd-mm-yy',
			minDate: 1,
			onSelect:function (date) {
				scope.$apply(function () {
					ngModelCtrl.$setViewValue(date);
					scope.checkout = date;
				});
			}
		});
    }
  }
});

app.filter('html', ['$sce', function($sce) {
	return function(text) { return $sce.trustAsHtml(text); };
}]);

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

var contact = document.getElementById('info');
var contact2 = document.getElementById('contactForm');
var contact3 = document.getElementById('social');
var cls = 'active';

function activate(){
	alterClass(contact,cls);
	alterClass(contact2,cls);
	alterClass(contact3,cls);
}
