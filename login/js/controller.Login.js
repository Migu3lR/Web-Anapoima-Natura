//Se inicializa controlador para los sitios index.php
app = angular.module("app",['angular-hmac-sha512','ngAnimate','angular-jwt', 'angular-storage','ngCookies']);
app.controller("control",function($scope,$crypthmac,$window,$http,jwtHelper,store,$cookies){

//Al acceder a este sitio se almacena url de retorno, en caso de salida retornable
var url = store.get("url") || null;
if (!url) url = "/desarrollo/";

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
				//console.log($scope.user);
				if($cookies.get("x")===undefined){
					// Find tomorrow's date.
					var expireDate = new Date();
					expireDate.setTime(expireDate.getTime() + (60*1000*2));
					// Setting a cookie
					
					$cookies.put("x",$scope.user.rol, {'path':'/', 'expire':expireDate});
					
					store.remove("url");
					$window.location = url;
				}
				return true;
			}
		} else return false;
	}
	$scope.isAuth = auth();

//Variables de codigos de error en Back-End(Ver /api/index.php)	
var db_isdown = 521;
var db_unknown_error = 520;
var access_forbidden = 500;
var token_invalid = 502;
var user_conflict = 409;
var bad_insert_request = 400;
var user_already_active = 405;
var user_not_found = 404;
var invalid_password = 402
var user_wait_activate = 403;
var user_created = 201;
var user_accepted = 202;
var pass_changed = 203;
var user_unauthorized = 401;
var response_ok = 0;
$scope.form = true;

//Variable flag para mostrar mensaje de error
$scope.showError = false;
$scope.eIn = false;
$scope.eUp = false;

//Variable para validacion de campos de registro
$scope.valid = {
	nombre : true, 
	correo : true, 
	correoCnf : true, 
	clave : true, 
	claveCnf : true, 
	fecha : true, 
	telefono : true, 
	nacionalidad : true, 
	municipio : true,
	correoIn : true,
	claveIn : true
};
	
var dir = "";			
$scope.resp = 0;
$scope.msg = "";
	
	//Esta funcion recibe las solicitudes para el backend 
	//para los registros de usuario e inicio de sesion
	var sql = function(dataCode,dir){
                $scope.showError = false;
		var request = $http({
			method: "post",
			url: "../api/index.php",
			headers: {'Content-Type': 'application/x-www-form-urlencoded'},
			skipAuthorization: true, //en true para que no se envie token de seguridad
			data: dataCode
		});

		/* Check whether the HTTP Request is successful or not. */
		request.success(function (res) {
			if(res.code !== undefined && res.response.token !== undefined){
				//Si se reciben token de seguridad y backend responde user_accepted (cuando se hace login)
				//se almacena el token de seguridad recibido
				if(res.code == user_accepted) store.set('token', res.response.token);
			}
			//Switch para los codigos de respuesta que se pueden recibir
			switch (res.code) {
				case db_isdown:
					$scope.msg = "Ha ocurrido un error inesperado, por favor vuelve a intentarlo";
					$scope.showError = true;
					break;
				case db_unknown_error:
					$scope.msg = "Ha ocurrido un error inesperado, por favor vuelve a intentarlo";
					$scope.showError = true;
					break;
				case user_conflict:
					$scope.msg = "Ya tenemos a un cliente con esos datos. Si ya te has inscrito, por favor inicia sesión";
					$scope.showError = true;
					break;
				case bad_insert_request:
					$scope.msg = "Ha ocurrido un error inesperado, por favor vuelve a intentarlo";
					$scope.showError = true;
					break;
				case user_not_found:
					$scope.msg = "Usuario o Contraseña invalidos, intentalo nuevamente";
					$scope.showError = true;
					break;
				case user_created:
					$scope.msg = "!Gracias por unirte a Natura! Te hemos enviado un correo electrónico para confirmar tu registro, sigue las instrucciones y disfruta de todos nuestros beneficios para ti.";
					$scope.form = false;
					$scope.showError = false;
					break;
				case user_accepted:
					$scope.msg = "";
					$scope.showError = false;
					$window.location.reload();
					break;
				case user_unauthorized:
					$scope.msg = "Usuario o Contraseña invalidos, intentalo nuevamente";
					$scope.showError = true;
					break;
				case access_forbidden:
					$scope.msg = "Ha ocurrido un error inesperado, por favor vuelve a intentarlo";
					$scope.showError = true;
					break;
				case user_wait_activate:
					$scope.showError = false;
					var resend = confirm('Ya te hemos enviado un correo de confirmación para activar tu cuenta, ¿deseas que te lo enviemos nuevamente?');
					if (resend){
						var data = {
							action	: 'ResendActivationEmail',
							nombre   : res.response.nombre,
							correo   : res.response.correo
						};
						sql(data,"");
					}
					break;
			}	
			
		});
	}
	
	//Funcion para realizar solicitud de registro de usuario
	$scope.signup = function (nombre, correo, correoCnf, clave, claveCnf, fecha, telefono,nacionalidad,municipio){
        $scope.eUp = false; //Variable control de pantalla en vista Registro(false)/Login(true)

		//Variables para validacion de campos de texto de por tipo de dato y tamaño
		var mas5menos20 = new RegExp("^[a-zA-Z \-]{5,20}$");
		var mas3menos20 = new RegExp("^[a-zA-Z \-]{3,20}$");
		var num = new RegExp("^[0-9]+$");
		var mail = new RegExp("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$");
		
		if (nombre == undefined || nombre.length == 0) $scope.valid.nombre = false;
		else $scope.valid.nombre = mas5menos20.test(nombre);
		$scope.valid.correo = mail.test(correo);
		if (correo != correoCnf) $scope.valid.correoCnf = false;
		if (correo == correoCnf) $scope.valid.correoCnf =  true;
		if (clave == undefined || clave.length < 8) $scope.valid.clave = false;
		else $scope.valid.clave = true;		
		if (clave != claveCnf) $scope.valid.claveCnf = false;
		if (clave == claveCnf) $scope.valid.claveCnf = true;
		if (telefono == undefined || telefono.length == 0){ 
			$scope.valid.telefono = true;
			telefono = '0';
		}
		else $scope.valid.telefono = num.test(telefono);
		
		if (nacionalidad == undefined || nacionalidad.length == 0) $scope.valid.nacionalidad = false;
		else $scope.valid.nacionalidad = mas3menos20.test(nacionalidad);
		if (municipio == undefined || municipio.length == 0) $scope.valid.municipio = false;
		else $scope.valid.municipio = mas3menos20.test(municipio);
		
		//Si todos los datos son validos se organizan datos para envío
		if ($scope.valid.nombre && $scope.valid.correo && $scope.valid.correoCnf && $scope.valid.clave && $scope.valid.claveCnf && $scope.valid.telefono && $scope.valid.nacionalidad && $scope.valid.municipio){
			var data = {
				action	: 'RegisterNewUser',
				nombre   : nombre,
				correo   : correo,
				clave    : clave,
				fecha	 : fecha,
				telefono : telefono,
				tipo	 : 0,
				documento: 0,
				nacionalidad:nacionalidad,
				municipio: municipio
			};
			//Se encripta contraseña antes del envío
			data.clave = $crypthmac.encrypt(data.clave,"NtraSfe"); 
			sql(data,"newUser"); //Se envia request a la funcion sql
            $scope.eUp = true; //Variable control de pantalla en vista Registro(false)/Login(true)
		}
	}

	//Funcion signin para recibir solicitud de inicio de sesion
	$scope.signin = function (correoIn, claveIn){
        $scope.eIn = false;
		//Se validan los datos recibidos
		if ( correoIn == undefined || correoIn.length == 0) $scope.valid.correoIn = false;
		else $scope.valid.correoIn = true;
		if ( claveIn == undefined || claveIn.length == 0) $scope.valid.claveIn = false;
		else $scope.valid.claveIn = true;
		
		//Si la validacion de datos fue correcta...
		if($scope.valid.correoIn && $scope.valid.claveIn){
			var token = store.get("token") || null;
			if (token) store.remove("token"); //Si hay un token de seguridad en memoria se limpia
			
			var x = $cookies.get("x") || null;
			if (x !== null){
				$cookies.remove("x", { path: '/' });
				$window.location.reload();	
			}
			//Se organizan datos a enviar para solicitud de login
			var data = {
				action	: 'login',
				correo   : correoIn,
				clave    : claveIn
			};
			//Se encripta la contraseña a enviar
			data.clave = $crypthmac.encrypt(data.clave,"NtraSfe")
			//Se envia solicitud de login a la funcion sql
			sql(data,"loginUser");
            $scope.eIn = true;
		}
	}
	
});

//Controlador para la vista logout.php
app.controller("logout",function($scope,$crypthmac,$window,$http,jwtHelper,store,$cookies){
	//Se valida que exista una url de retorno, si no se deja url de inicio
	var url = store.get("url") || null;
	if (!url) url = "/desarrollo/";
	//obtenemos el token en localStorage
		var token = store.get("token") || null;
		if (token) store.remove("token"); //Si hay un token se limpia
		
		var x = $cookies.get("x") || null;
		//Se consulta cookie 'x' quue almacena tipo de usuario logueado
		if (x !== null){//Si la variable esta definida se limpia y se actualiza.
			$cookies.remove("x", { path: '/' });
			$window.location.reload();	
		} 
		else{//Si no esta definido se limpia url de retorno y se redirige a esta url
			store.remove("url");
			$window.location = url;	
		}		
		
		
		
});

//Controlador para la vista activate.php
app.controller("activate",function($scope,$crypthmac,$window,$http,jwtHelper,store,$cookies){
var db_isdown = 521;
var db_unknown_error = 520;
var access_forbidden = 500;
var token_invalid = 502;
var user_conflict = 409;
var bad_insert_request = 400;
var user_already_active = 405;
var user_not_found = 404;
var invalid_password = 402
var user_wait_activate = 403;
var user_created = 201;
var user_accepted = 202;
var pass_changed = 203;
var user_unauthorized = 401;
var response_ok = 0;

	//Esta funcion recibe las solicitudes de activacion de cuenta de usuario
	var sql = function(dataCode){
		var request = $http({
			method: "post",
			url: "../api/index.php",
			headers: {'Content-Type': 'application/x-www-form-urlencoded'},
			skipAuthorization: true,
			data: dataCode
		});

		/* Check whether the HTTP Request is successful or not. */
		request.success(function (res) {
			
			switch (res.code) {
				case db_isdown:
					$scope.msg = "Ha ocurrido un error inesperado, por favor vuelve a intentarlo";
					break;
				case db_unknown_error:
					$scope.msg = "Ha ocurrido un error inesperado, por favor vuelve a intentarlo";
					break;
				case user_unauthorized:
					$scope.msg = "Usuario o Contraseña invalidos, intentalo nuevamente";
					break;
				case access_forbidden:
					$scope.msg = "Ha ocurrido un error inesperado, por favor vuelve a intentarlo";
					break;
				case user_already_active:
					$scope.msg = "El usuario ya ha sido activado, puede iniciar sesión.";
					break;
				case response_ok:
					$scope.msg = "¡Gracias por unirte a Natura!";
					break;
				case token_invalid:
					$scope.msg = "¡Has utilizado un token invalido!. Comunicate con el administrador";
					break;
				default:
					$scope.msg = "Ha ocurrido un error inesperado, por favor vuelve a intentarlo";
					break;
					
			}	
			alert($scope.msg);
			$window.location = "index.php";
			
		});
	}
	
	//esta Funcion prepara la solicitud a backend de activacion de usuario con el token recibido por metodo GET
	$scope.sendToken = function(token){
		var data = {
			action	: 'activateUser',
			token   : token
		};	
		sql(data);
	}
	
});

app.config(["$httpProvider", "jwtInterceptorProvider",  function ($httpProvider, jwtInterceptorProvider) 
{
    $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
    
    //en cada petición enviamos el token a través de los headers con el nombre Authorization
    jwtInterceptorProvider.tokenGetter = function() {
        return localStorage.getItem('token');
    };
    $httpProvider.interceptors.push('jwtInterceptor');
}]);

//JS para efectos graficos en el formulario de registro
$('.form').find('input, textarea').on('keyup blur focus', function (e) {
  
  var $this = $(this),
      label = $this.prev('label');

	  if (e.type === 'keyup') {
			if ($this.val() === '') {
          label.removeClass('active highlight');
        } else {
          label.addClass('active highlight');
        }
    } else if (e.type === 'blur') {
    	if( $this.val() === '' ) {
    		label.removeClass('active highlight'); 
			} else {
		    label.removeClass('highlight');   
			}   
    } else if (e.type === 'focus') {
      
      if( $this.val() === '' ) {
    		label.removeClass('highlight'); 
			} 
      else if( $this.val() !== '' ) {
		    label.addClass('highlight');
			}
    }

});

$('.tab a').on('click', function (e) {
  
  e.preventDefault();
  
  $(this).parent().addClass('active');
  $(this).parent().siblings().removeClass('active');
  
  target = $(this).attr('href');

  $('.tab-content > div').not(target).hide();
  
  $(target).fadeIn(600);
  
});