/*  Angular Framework  */
app = angular.module("app",[]);
app.controller("control",function($scope,$window,$http,$interval){

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

