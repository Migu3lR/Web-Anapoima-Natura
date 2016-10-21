<?php

//Se definen los codigos de respuesta de Servidor para los request de la pagina
$er = 0;
define('db_isdown', 521); //Error: No se puede conectar a la base de datos
define('db_unknown_error', 520); //Error: Error desconocido de ejecucion en base de datos
define('access_forbidden', 500); //Error: Acceso prohibido para el usuario que realiza la solicitud
define('error_send_mail', 501); //Error: Error al intentar enviar correo electronico
define('token_invalid', 502); //Error: El token recibido es invalido
define('user_conflict', 409); //Error: El usuario que intenta registrar ya existe
define('user_already_active', 405); //Mensaje: El usuario que intenta activar ya se encuentra activo
define('user_wait_activate', 403); //Mensaje: El usuario que intenta loguear aun esta pendiente por activacion
define('bad_insert_request', 400); //Error: Error ejecutar INSERT o UPDATE en base de datos
define('user_not_found', 404); //Error: El usuario que intenta logear no existe
define('invalid_password', 402); //Error: Contraseña invalida
define('user_created', 201); //Mensaje: El usuario se registro correctamente
define('user_accepted', 202); //Mensaje: El usuario se ha logeado correctamente
define('pass_changed', 203); //Mensaje: La contraseña de usuario ha sido cambiada correctamente
define('user_unauthorized', 401); //Error: El usuario no ha sido autorizado para esta accion
define('response_ok', 0); //Mensaje: El proceso solicitado se ejecuto correctamente

//Parametros para configuracion de conexion a Base de Datos
if (!defined("HB_HOST")) define("HB_HOST", "localhost"); //Hostname de la base de datos
if (!defined("HB_USER")) define("HB_USER", "hbzzadmin"); //Nombre de usuario
if (!defined("HB_PASS")) define("HB_PASS", "C@c6w217DS"); //Contraseña
if (!defined("HB_DB")) define("HB_DB", "naturabase_desarrollo"); //Nombre de la base de datos

//Funcion para envio de correos
//Uso: sendMail(Correo destino, Correo origen, Asunto, Mensaje)
function sendMail($to,$from,$subject,$body){
    //Se parametrizan los Headers
    $headers = "From: $from\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    $result = mail($to, $subject, $body, $headers); // Se envia correo con comando Mail de PHP

    //Se retorna codigo de error
    if ($result) return response_ok;
    else return error_send_mail;

}

//Funcion para abrir conexion con la base de datos
function connectDB(){
    //Usando los parametros establecidos para conexion a la BD
    $sql = mysqli_connect(HB_HOST, HB_USER, HB_PASS, HB_DB);
    if(!$sql){ //Si ocurre error...
        $code = db_isdown;
        $response = array();
        SendResponse($code,$response);
    }
    return $sql; //Si no hay error se retorna conexion
}

//Funcion para extraccion de Data de la BD para resultados de una sola Fila
//Uso: getRowSQL(Sentencia SQL Select)
function getRowSQL($sql){
	$conexion = connectDB(); //Abrir conexion a la base de datos
	mysqli_set_charset($conexion, "utf8"); //Se configura formato de datos utf8

    $result = mysqli_query($conexion, $sql); //Se ejecuta consulta de base de datos

    //Se retorna resultado
    if(!$result) return false;
	return mysqli_fetch_row($result);

}

//Funcion para ejecucion de sentencias en BD
//Uso executeSQL(Sentencia SQL Update o Insert)
function executeSQL($sql){
    $conexion = connectDB(); //Abrir conexion a la base de datos
    mysqli_set_charset($conexion, "utf8"); //formato de datos utf8

    if(!$result = mysqli_query($conexion, $sql)) $er = db_unknown_error; //Se ejecuta consulta
    mysqli_close($conexion); //desconectamos la base de datos
    return $er; // Retorna codigo respuesta
}

//Funcion para extraccion de data de la BD en formato JSON para Angular
//Uso: jsonQuery(Sentencia SQL Select)
function jsonQuery($sql){
    $conexion = connectDB(); //Abrir conexion a la base de datos
    mysqli_set_charset($conexion, "utf8"); //formato de datos utf8
    if(!$result = mysqli_query($conexion, $sql)) $er = db_unknown_error;
    $rawdata = array(); //creamos un array para listar el resultado
	if($result){
        while($row = mysqli_fetch_assoc($result)){ //Resultado de la consulta se convierte a JSON, todos los campos en String
            $rawdata[] = $row;
        }
    }

    mysqli_close($conexion); //desconectamos la base de datos
    return $rawdata; //devolvemos el array
}

//Funcion para conversion de un campo JSON, de String a Integer
function field2int($list, $field){
    //$list -> Array que contiene el campo JSON
    //$field -> Nombre del Campo JSON a convertir
    foreach ($list as &$row) {
        $row[$field] = intval($row[$field]);
    }
    return $list; //Se retorna $list con el campo ya convertido
}
//Funcion creada para encargarse de enviar todas las respuestas de las solicitudes en Front-End
function SendResponse($code,$items=array(),$sendTkn=true){
    //$code -> Codigo de respuesta a la solicitud
    //$items -> Objetos a enviar en respuesta
    //$sendTkn -> Parametro Boolean para envio de token de seguridad de usuario
    //            True: Para enviar token
    //            False: para no enviar el token
    $ItemswithToken = array();
    if ($sendTkn){ //Si $sendTkn es True, se obtiene el token para el usuario que realiza la solicitud
        $id = isAuth(); // Se consulta si el usuario que realiza la solicitud se encuentra autenticado
                        // Si se encuentra autenticado el metodo isAuth() retorna el ID de usuario
        $token = getToken($id); // Se obtiene un token para el usuario
        if ($token) {
            $jwt = JWT::encode($token, 'N4tur4S4f3'); // Encriptamos el token con la palabra secreta de Natura
            $ItemswithToken = array( //Agregamos el token a la respuesta a dar
                "token" => $jwt
            );
        }
    }

    $items = array_merge($items,$ItemswithToken); //Unimos los objetos a enviar con el token

    //Se declara variable de respuesta
    $response = array (
        "code" => $code,        //Codigo de respuesta
        "response" => $items    //Objetos a enviar y token su hubieron
    );

    echo json_encode($response);  //Se envia respuesta a Front-End via echo
    exit();
}

//Funcion para definir accion a realizar ante un usuario no autenticado o que no tiene acceso a cierta tarea
function unAuth($forb=false){
    // $forb -> Variable para definir si el llamado de la funcion es por acceso denegado
    if ($forb !== 'forbidden'){ //Funcion llamada para usuario no autenticado
        echo json_encode( //Se retorna respuesta via echo
            array(
                "code" => user_unauthorized, //Se envia codigo de respuesta para no autenticado
                "response" => array()
            )
        );
    }else{ //Funcion llamada para acceso denegado
        echo json_encode( //Se retorna respuesta via echo
            array(
                "code" => access_forbidden, //Se envia codigo de respuesta para no autenticado
                "response" => array()
            )
        );
    }
    exit;
}

//Funcion creada para llamar metodo definido en los parametros de solicitud en Front-End
function call_resquest($r, $Auth_Required = true, $Admin_Required = false){
    //$r -> Contiene atributo action, que define el nombre del metodo a llamar
    //$Auth_Required -> Parametro Boolean para definir si el llamado  requiere que se esté autenticado
    //$Admin_Required -> Parametro Boolean para definir si el llamado  requiere permisos de Administrador
    if(is_callable($r->action)){  //Se consulta si el metodo llamado existe
        $auth = isAuth($Admin_Required); //Se consulta si el usuario esta autenticado teniendo en cuenta si se requieren permisos de administrador
        if (($Auth_Required && $auth!==false && $auth!=='forbidden') || !$Auth_Required){ //Se validan permisos requeridos
            call_user_func_array($r->action, [$auth,$r]); //Se llama al metodo solicitado si cumple requisitos
        }
        else unAuth($auth); //Si no cumple con los permisos requeridos se envia respuesta de "no autorizado"
    } else unAuth('forbidden'); // Si el metodo llamado no existe se envia respuesta de "Acceso denegado"
}

switch($_SERVER['REQUEST_METHOD']){ //Se evalua el tipo de solicitud realizada por Front-End
case 'GET': //Si se invoca el metodo GET en la solicitud, se deniega el acceso
    header("HTTP/1.1 403 Unauthorized");
    exit;
    break;
case 'POST': //Si se invoca el metodo POST en la solicitud, se procesa la socitud
    require_once('JWT.php'); //Se agrega libreria JWT al entorno

    //Se reciben dos tipos de solicitud POST, carga de archivos o de texto plano
    if (!isset($_FILES["file"]))
        // Si la solicitud es de texto plano, se llama a la funcion new_request para atender la nueva solicitud
        new_request(json_decode(file_get_contents("php://input")));
    else{ //Si la solicitud es de carga de archivos
        require_once('upload.php'); // Se agrega libreria de Upload al entorno
        $r = new stdClass;
        $r->action = 'uploadAvatar';   //Se define metodo a llamar, para cargar Avatar de usuario
        new_request($r); // Se llama a funcion new_request para procesar la solicitud
    }
    break;
}

//Funcion creada para recibir las nuevas solicitudes al Back-End
function new_request($r){
    //$AuthNotRequired -> En este array se deben listar los nombre de los metodos que no requieran Autenticacion en la solicitud
    $AuthNotRequired = array(
        'login',
        'RegisterNewUser',
        'ResendActivationEmail',
        'activateUser',
        'getComents',
        'newComent'
    );

    //$AdminRequired -> En este array se deben listar los nombres de los metodos que requieran Permisos de Administrador en la solicitud
    $AdminRequired = array(
        'updateComent',
        'getPromComments_a',
        'getComments_a',
        'NewTokenforComment',
        'getUsers_a',
        'delUser_a',
        'newUser_a',
        'updUser_a',
        'getUsersPromos_a',
        'getPromos_a',
        'getPromo_Users_a',
        'newPromo_a',
        'updPromo_a',
        'delPromo_a',
        'modifClntes_a',
        'delClntes_a'
    );

    //Si el nombre del metodo solicitado no se encuentra en alguno de los array anteriores
    //significa el metodo a llamar, requiere que el usuario se encuentre autenticado (No requiere administrador)

    //Si la solicitud contiene el campo action (nombre del metodo a llamar)
    //se llama a la funcion call_request, validando que el metodo llamado requiera permisos o no.
    //Si no se hace la solicitud de manera correcta, se llama a la funcion unAuth denegando el acceso (parametro 'forbidden')
    if (isset($r->action)) call_resquest($r,!in_array($r->action, $AuthNotRequired),in_array($r->action, $AdminRequired));
    else unAuth('forbidden');

}

function login($auth,$r){
// Metodo login invocado desde
// Vista:       /login/index.php
// Controlador: /login/js/controller.Login.js
//---------------------------------------------
// Autenticacion:   No requerida
// Objetivo:        Iniciar sesion de usuario generando Token de seguridad

    $er = response_ok;
    //Consultar a la base de datos si el usuario que realiza la solicitud de LOGIN
    //existe en la tabla CLNTES donde la fuente de registro sea 'R'
    //y tenga un rol asignado en la tabla ROL_CLNTES, y una contraseña en la tabla SCRTY
    $cmd = "Select c.id_cln, s.pass, c.estdo_cln,c.nmbre FROM clntes c JOIN scrty s ON (s.id_cln = c.id_cln) JOIN rol_clntes r ON (r.id_cln = c.id_cln) where c.fuente='R' and c.crreo='".$r->correo."'";
    $pass = getRowSQL($cmd);
    if($pass == null)
        //Si el usuario no existe o no se encuentra con las condiciones necesarias, se devuelve mensaje de error.
        $er = user_not_found;
    elseif($pass[2] =='A'){
        //Si el usuario existe, cumple las condiciones necesarias y su estado es Activo...
        $token = new stdClass;
        if ($r->clave == $pass[1]){ //Validamos que la contraseña recibida sea correcta, si lo es...
            $er = user_accepted; //Se devuelve mensaje de usuario aceptado
            $token = getToken($pass[0]); //Se generó Token de seguridad a traves de la funcion getToken
        } else $er = user_unauthorized; //Si la contraseña es incorrecta se devuelve mensaje de error.

        if ($token && $er == user_accepted){ //Si el token se generó de manera correcta y la contraseña fue correcta...
            $jwt = JWT::encode($token, 'N4tur4S4f3'); //Se encripta el token con la palabra secreta de Natura
            echo json_encode( //Se devuelve respuesta a Front-End via echo, con el token generado
                array(
                    "code" => $er,
                    "response" => array(
                        "token" => $jwt
                    )
                )
            );
        } else $er = user_not_found; //Si el token no se genera de manera correcta o la contraseña fue incorrecta de devuelve mensaje de error
    } elseif($pass[2] =='P'){
        //Si el usuario existe, cumple las condiciones necesarias y su estado es Pendiente...
        $er = user_wait_activate; //Se devuelve mensaje de Usuario pendiente de activacion
    } else $er = user_not_found; //Si no se cumple ninguna de las condiciones se devuelve mensaje de error.

    if ($er != user_accepted){ //Si el usuario no fue aceptado...
        $re = array();
        if ($er == user_wait_activate){ //Si el usuario esta pendiente por activacion
            $re = array(                //Se agrega a la respuesta nombre del usuario y correo para reenviar solicitud de activacion
                "nombre" => $pass[3],
                "correo" => $r->correo
            );
        }
        echo json_encode( // Se devuelve respuesta a Front-End via echo, con codigo de error.
            array(
                "code" => $er,
                "response" => $re
            )
        );
    }
}

//Funcion creada para retornar Token de seguridad para inicio de sesion de usuario
function getToken($id){
    //$id -> ID de usuario en la tabla CLNTES

    //Se consulta informacion de usuario en la tabla CLNTES y ROL_CLNTES
    $cmd = "Select c.id_cln, c.nmbre, c.crreo, r.rol FROM clntes c JOIN rol_clntes r ON (r.id_cln = c.id_cln) where fuente='R' and estdo_cln='A' and c.id_cln=".$id;
    $user = getRowSQL($cmd);

    if($user){ //Si el usuario existe obtienen los siguientes campos para el Token:
        $id = $user[0]; //ID de usuario
        $nombre = $user[1].''; //Nombre del usuario
        $email = $user[2]; //Correo electronico
        $rol = $user[3]; //Rol del usuario

        //Generamos el token con la informacion obtenida
        $token = new stdClass;
        $token->iat = time();
        $token->exp = time() + (3600*24);
        $token->id = intval($id);
        $token->name = $nombre;
        $token->email = $email;
        $token->rol = intval($rol);

        return $token; // Se retorna Token de seguridad
    } else return false; //Si el usuario no exite se retorna false como error.
}

//Funcion creada para validar si los Headers de la solictud realizada contiene campo Authorization (Token de seguridad)
function isAuth ($verfAdmin = false){
    //$verfAdmin -> Parametro boolean para definir si el llamado a esta funcion requiere validar si el usuario es administrador
    $headers = apache_request_headers();
    if(!isset($headers["Authorization"]) || empty($headers["Authorization"]))
        return false; // Si no se obtiene autenticacion se retorna false como error.
    else {
        // Si se obtiene Token de seguridad de la solicitud...
        $token = explode(" ", $headers["Authorization"]);
        $user = JWT::decode(trim($token[1],'"'), 'N4tur4S4f3',array('HS256')); // Desencriptamos token de seguridad

        if ($verfAdmin && $user->rol == 0)
            return 'forbidden'; //Si se requieren permisos de adminsitrador y el usuario no es administrador, se retorna error de Acceso Denegado

        //Si no se ha retornado respuesta se realiza checkeo de los datos recibidos
        //y se retorna respuesta del siguiente llamado a la funcion checkUser
        return checkUser($user->id, $user->email, $user->rol);
    }
}

//Funcion creada para validar los datos de usuario recibidos en un Token de Seguridad
function checkUser($id, $email, $rol){
    //$id -> ID de usuario en Token
    //$email -> Correo electronico de usuario en Token
    //$rol -> Rol de usuario en Token

    //Se consultando los datos recibidos en el token contra los datos existentes en la base de datos
    //en las tablas CLNTES y ROL_CLNTES, y que la fuente de registro sea 'R' y su estado sea 'A'
    $cmd = "Select c.crreo, r.rol FROM clntes c JOIN rol_clntes r ON (r.id_cln = c.id_cln) where fuente='R' and estdo_cln='A' and c.id_cln=".$id;
    $user = getRowSQL($cmd);

    if($user){ if ($email == $user[0] && $rol == $user[1]) return $id; } // si los datos son correctas se retorna ID de usuario
    return 'forbidden'; //Si los datos son invalidos, se retornaa error de Acceso denegado.
}

function getUserInfo($id,$r){
// Metodo getUserInfo invocado desde
// Vista:       /userProfile/index.php
// Controlador: /userProfile/js/controller.UserProfile.js
//---------------------------------------------
// Autenticacion:   Requerida
// Objetivo:        Retornar informacion de usuario para la página de Perfil de Usuario

    //Se consultan datos de registro del usuario
    $cmd = "Select c.*, r.rol FROM clntes c JOIN rol_clntes r ON (r.id_cln = c.id_cln) where fuente='R' and estdo_cln='A' and c.id_cln=".$id;
    $user = jsonQuery($cmd);

    //Se consultan datos de las reservas realizadas por el usuario
    $cmd = "Select b.uuid as id_reserva, b.created as fecha_reserva, b.status as estado_reserva, b.date_from as llegada_reserva, b.date_to as retiro_reserva FROM bk_hotel_booking_bookings b JOIN clntes c ON (b.c_email = c.crreo) where c.id_cln=".$id;
    $bookings = jsonQuery($cmd);

    //Se consultan datos de los comentarios realizados por el usuario (Solo los Aceptados por el Administrador)
    $cmd = "Select cm.fecha, cm.rate as puntaje, cm.Mensaje as mensaje FROM comentarios cm  JOIN clntes c ON (cm.correo = c.crreo) where cm.estado='A' and c.id_cln=".$id;
    $comments = jsonQuery($cmd);

    //Se genera respuesta estructurada para Front-End
    $response = array(
                    "userInfo" => $user,
                    "userBookings" => $bookings,
                    "userComments" => $comments
                    );
    SendResponse(response_ok,$response); //Se envia respuesta llamando a la funcion SendResponse.
}

function editUser_personal($auth,$user){
// Metodo editUser_personal invocado desde
// Vista:       /userProfile/editProfile.php
// Controlador: /userProfile/js/controller.UserProfile.js
//---------------------------------------------
// Autenticacion:   Requerida
// Objetivo:        Realizar update la informacion de usuario editada desde la página de Perfil de Usuario

    //Se crea query para actualizar tabla de clientes con los campos datos recibidos en la solicitud
    $cmd  = "UPDATE clntes SET";
    $cmd .= " nmbre = '".$user->nombre."',";
    $cmd .= " tlfno = '".$user->telefono."',";
    $cmd .= " ncnldad = '".$user->pais."',";
    $cmd .= " cdad = '".$user->ciudad."',";
    $cmd .= " fcha_ncmnto = '".$user->nacimiento."'";
    $cmd .= " WHERE id_cln = ".$user->id_cln;

    $code = executeSQL($cmd); //Se envia query a la base de datos y se obtiene codigo de respuesta

    $response = array();
    SendResponse($code,$response); //Se envia respuesta llamando a la funcion SendResponse.

}

function uploadAvatar($id,$r){
// Metodo uploadAvatar invocado desde
// Vista:       /userProfile/editProfile.php
// Controlador: /userProfile/js/controller.UserProfile.js
//---------------------------------------------
// Autenticacion:   Requerida
// Objetivo:        Subir imagen para avatar de usuario desde la página de Perfil de Usuario

    $code = changeAvatar($id); //Se llama a funcion changeAvatar de la libreria Upload.php para subir la imagen
    if ($code==response_ok){ //Si se cargo correctamente la imagen...
    //Se actualiza en la tabla CLNTES el nombre del archivo cargado, para mostrar imagen la vista
    $cmd  = "UPDATE clntes SET";
    $cmd .= " avatar = '".$id.".jpg'";
    $cmd .= " WHERE id_cln = ".$id;

    $code = executeSQL($cmd);
    }

    $response = array();
    SendResponse($code,$response); //Se envia respuesta llamando a la funcion SendResponse.

}

function changePass($auth,$r){
// Metodo changePass invocado desde
// Vista:       /userProfile/editProfile.php
// Controlador: /userProfile/js/controller.UserProfile.js
//---------------------------------------------
// Autenticacion:   Requerida
// Objetivo:        Cambiar contraseña desde la página de Perfil de Usuario

    $code = response_ok;

    //$r->id_cln    ->  ID del cliente
    //$r->nueva     ->  Nueva contraseña
    //$r->anterior  ->  Anterior contraseña
    $id = $r->id_cln;
    $nueva = $r->nueva;

    //Se consulta contraseña actual de usuario
    $cmd  = "SELECT pass FROM scrty WHERE id_cln = $id";
    $pass = jsonQuery($cmd);

    if ($pass[0]['pass'] == $r->anterior){ //Si la contraseña actual es igual a la contraseña Anterior enviada en la solicitud...
        $cmd  = "UPDATE scrty SET pass = '$nueva' WHERE id_cln = $id"; //Se cambia la contraseña por la nueva
        $code = executeSQL($cmd);
        $cmd  = "SELECT pass FROM scrty WHERE id_cln = $id"; //Se consulta la contraseña que se ha cambiado
        $pass = jsonQuery($cmd);
        if ($pass[0]['pass'] == $nueva) $code = pass_changed; //Si la contraseña fue cambiada correctamente, se envia respuesta de Contraseña cambiada
        else $code = db_unknown_error; //Si no cambio, se envia codigo de error.
    } else $code = invalid_password; // Si la contraseña anterior es incorrecta, se envia codigo de error.

    $response = array();
    SendResponse($code,$response); //Se envia respuesta llamando a la funcion SendResponse.
}

function getPromComments_a($auth,$r){
// Metodo getPromComments_a invocado desde
// Vista:       /comentAdmin/index.php
// Controlador: /comentAdmin/js/controller.comentAdmin.js
//---------------------------------------------
// Autenticacion:   Requerida como Administrador
// Objetivo:        Consultar puntaje promedio de comentarios para la página de Gestion de Comentarios (Escritorio)

    //Se crea consulta a la base de datos, calculando el puntaje promedio otorgado por usuarios a traves de la pagina de comentarios
    $sql = "SELECT sum(rate)/count(*) as prom FROM comentarios ";
    $sql .= "where rate > 0 ";
    $sql .= "and estado= 'A'";
    $prom = jsonQuery($sql);

    $response = array("prom" => $prom[0]['prom']); //Se genera respuesta estructurada para Front-End
    SendResponse(response_ok,$response); //Se envia respuesta llamando a la funcion SendResponse
}

function getComments_a($auth,$r){
// Metodo getComments_a invocado desde
// Vista:       /comentAdmin/gestion.php
// Controlador: /comentAdmin/js/controller.comentAdmin.js
//---------------------------------------------
// Autenticacion:   Requerida como Administrador
// Objetivo:        Generar listado de comentarios existentes en base de datos para administracion

    //Se crea consulta a la base de datos, listando todos los comentarios realizados.
	$sql = "SELECT * FROM comentarios";
	$posts = jsonQuery($sql); //Se ejecuta la consulta, extrayendo los datos en formato JSON
    $posts = field2int($posts,'rate'); //El campo 'rate' se transforma a Integer

    $response = array("comments" => $posts);//Se genera respuesta estructurada para Front-End
    SendResponse(response_ok,$response);    //Se envia respuesta llamando a la funcion SendResponse
}


function NewTokenforComment($auth,$r){
// Metodo NewTokenforComment invocado desde
// Vista:       /comentAdmin/index.php
// Controlador: /comentAdmin/js/controller.comentAdmin.js
//---------------------------------------------
// Autenticacion:   Requerida como Administrador
// Objetivo:        Generar nuevo token de seguridad (texto encriptado) y enviarlo via email para permitir la creacion de nuevos comentarios

    $code = response_ok;

    $nombre = $r->nombre; //Campo nombre enviado por Front-End, necesario para el envio de email con token de seguridad
    $correo = $r->correo; //Campo correo enviado por Front-End, necesario para el envio de email con token de seguridad

    $tkn = sha1(date("Y-m-d H:i:s")); //Se genera nuevo token encriptando con sha1, un string (se encripta un timestamp para asegurar la aleatoriedad)
    $fechaCreacion = date("Y-m-d"); //Variable de fechaCreacion para almancenar en BD fecha de apertura del token
    $fechaCierre = date("Y-m-d",strtotime("+1 Months")); //Variable fechaCierre para almacenar el BD fecha de cierre del token (cada Token tiene una vigencia de 1 mes)
    $uso = "C"; //Se define el uso del Token como 'C' para comentarios (BD)

    //Se crea query para insertar nuevo token de seguridad en la BD teniendo en cuenta los anteriores datos
    $cmd = "INSERT INTO tokens (tokenid, token, fecha_creacion, fecha_cierre, uso, correo)
            VALUES (NULL, '$tkn', '$fechaCreacion', '$fechaCierre', '$uso', '$correo')";
    $code = executeSQL($cmd); //Se ejecuta el query llamando a la funcion executeSQL

    if ($code === response_ok) { //Si no ocurrio algun error en la creacion...
        //Se genera informacion para el envio de correo electronico al usuario
        $to = $correo;
        $from = "reservas@anapoimanatura.com";
        $subject = "Danos tu opinión de nosotros - anapoimanatura.com";

        $email_message = '<div style="max-width:600px; min-width:450px; margin: 10px auto;">';
        $email_message .= '<center>';
        $email_message .= '<img src="http://anapoimanatura.com/desarrollo/images/home/logo.png" />';
        $email_message .= '</center>';
        $email_message .= '<table style="width:100%; border-collapse:collapse; border-spacing:0; font:15px/1.5em Helvetica,Arial,sans-serif; color:#5D4C37; border:1px solid #ccc; box-shadow:0 0 1px #ccc;">';
        $email_message .= '<tbody>';
        $email_message .= '<tr style="border-bottom: 1px solid #eee;">';
        $email_message .= '<td style="max-width:30%; vertical-align:top; padding:8px; text-align:left;">';
        $email_message .= "<b>Hola $nombre, <br>Gracias por visitarnos en Natura, te invitamos a darnos tu opinion sobre nosotros!</b>";
        $email_message .= '</td>';
        $email_message .= '<td style="max-width:30%; vertical-align:top; padding:8px; text-align:left;">';
        $email_message .= "Utiliza el siguiente enlace, para realizar darnos tu opinión de Natura:<BR>";
        $email_message .= "<BR>";
        $email_message .= "<b>Enlace:  </b><a href='http://anapoimanatura.com/desarrollo/comentarios/comentar.php?tk=$tkn'> COMENTAR </a> <BR>";
        $email_message .= '</td>';
        $email_message .= '</tr>';
        $email_message .= '</tbody>';
        $email_message .= '</table>';
        $email_message .= '</div>';

        $code = sendMail($to,$from,$subject,$email_message); //Se llama a la funcion sendMail para el envio del correo y se captura codigo de respuesta

    }

    $response = array();
    SendResponse($code,$response); //Se envia respuesta llamando a la funcion SendResponse
}

function updateComent($auth,$r){
// Metodo updateComent invocado desde
// Vista:       /comentAdmin/gestion.php
// Controlador: /comentAdmin/js/controller.comentAdmin.js
//---------------------------------------------
// Autenticacion:   Requerida como Administrador
// Objetivo:        Actualizar data de comentarios desde la pagina de administracion de comentarios.

    $idCmt = $r->id; //Se recibe campo id, del ID del comentarios en BD
    $estado = $r->estado; //Se recibe campo estado, del estado del comentario en la BD (Activo, Pendiente, Rechazado)
    $publicar = $r->publicar; //Se recibe campo publicar, como parametro en BD para definir si un comentario es publicado o no

    //Query creado para actualizar los datos del comentario solicitado
    $cmd = "UPDATE comentarios SET estado='$estado', publicar='$publicar' WHERE ID=$idCmt";

    $code = executeSQL($cmd); //Se ejecuta query a traves de funcion executeSQL

    $response = array();
    SendResponse($code,$response); //Se envia respuesta a Front-End llamando a la funcion SendResponse
}

function getComents($auth,$r){
// Metodo getComents invocado desde
// Vista:       /comentarios/index.php
// Controlador: /comentarios/js/controller.Comentarios.js
//---------------------------------------------
// Autenticacion:   No requerida
// Objetivo:        Actualizar data de comentarios desde la pagina de administracion de comentarios.

    //Query para listar los comentarios en estado Activo y Publicados para la pagina de comentarios
    $sql = "SELECT * FROM comentarios where estado='A' and publicar='S' order by fecha desc";
    $posts = jsonQuery($sql); //Se obtiene resultado en formato JSON
    $posts = field2int($posts,'rate'); //Se convierte el campo 'rate' a tipo Integer

    $response = array("comments" => $posts); //Se genera respuesta estructurada para Front-End
    SendResponse(response_ok,$response); //Se envia respuesta mediante la funcion SendResponse
}

function newComent($auth,$r){
// Metodo getComents invocado desde
// Vista:       /comentarios/index.php
// Controlador: /comentarios/js/controller.Comentarios.js
//---------------------------------------------
// Autenticacion:   No requerida
// Objetivo:        Crear nuevo comentario en la base de datos, teniendo en cuenta los requisitos de seguridad

    $nombre = $r->nombre;   //Se recibe campo nombre
    $email = $r->email;     //Se recibe campo email
    $mensaje = $r->mensaje; //Se recibe campo mensaje
    $rate = $r->rate;       //Se recibe campo rate (puntaje)
    $token = $r->token;     //Se recibe campo Token

    $code = response_ok;

    $hoy = date("Y-m-d");

    //Se crea query para validar que el token recibido corresponde al correo electronico enviado en la solicitud
    //y ademas que el token se encuentre activo.
    $cmd = "Select tokenid, fecha_cierre FROM tokens where token='$token' and correo='$email' and estado='A'";
    $rslt = jsonQuery($cmd);

    if (!empty($rslt)){
        //Se valida que el tiempo de vigencia no haya pasado
        if ($hoy <= $rslt[0]['fecha_cierre']){
            //Si se cumplen los requisitos de seguridad, se crea query para insertar el comentarios a la BD
            $cmd = "INSERT INTO comentarios (id, id_cln, nombre, correo, mensaje, rate, tokenid)
            VALUES (NULL, NULL, '$nombre','$email','$mensaje',$rate,'".$rslt[0]['tokenid']."')";

            $code = executeSQL($cmd);
        } else $code = token_invalid; //Si paso el tiempo de vigencia del token, se envia mensaje de error
    } else $code = token_invalid; //Si el token no existe, o el token corresponde con el correo dado

    $response = array();
    SendResponse($code,$response); //Se envia respuesta llamando a la funcion SendResponse
}

function RegisterNewUser($auth,$r){
// Metodo RegisterNewUser invocado desde
// Vista:       /login/index.php
// Controlador: /login/js/controller.Login.js
//---------------------------------------------
// Autenticacion:   No requerida
// Objetivo:        Registrar nuevo usuario en la base de datos

    $code = response_ok;

    $nombre = $r->nombre;
    $correo = $r->correo;
    $clave = $r->clave;
    $fecha = substr($r->fecha,0,10);
    $telefono = $r->telefono;
    $tipo = $r->tipo;
    $documento = $r->documento;
    $nacionalidad = $r->nacionalidad;
    $municipio = $r->municipio;

    //Se consulta si el usuario a crear, existe previamente en la base de datos (El correo es la llave de la tabla de clientes)
    $cmd = "Select id_cln, fuente, estdo_cln FROM clntes where crreo='$correo'";
    $rslt = jsonQuery($cmd);

    if (empty($rslt)){
        //Si el usuario no existe, se genera query para insertar el nuevo usuario el base de datos, en estado Pendiente por activacion
        $cmd = "INSERT INTO clntes (id_cln, crreo, nmbre, fcha_ncmnto, tpo_numdoc, id_numdoc, tlfno, ncnldad,cdad,fuente,estdo_cln)
                VALUES (NULL, '$correo','$nombre','$fecha',$tipo,$documento,$telefono,'$nacionalidad','$municipio','R','P')";

    } elseif($rslt[0]['fuente'] != 'R'){
        //Si el usario existe pero la fuente de la informacion no es Registro (Comentarios, Reservas...), Actualizamos los datos del usuario
        $cmd = "UPDATE clntes SET nmbre='$nombre',
                fcha_ncmnto='$fecha',
                tlfno=$telefono,
                ncnldad='$nacionalidad',
                cdad='$municipio',
                fuente='R',
                estdo_cln='P'
                WHERE id_cln=".$rslt[0]['id_cln'];
    } else {
        //Si el usuario ya existe y la fuente de la informacion es Registro...
        $response = array();
        $code = user_conflict; //Se genera codigo de error
        SendResponse($code,$response,false); //Se envia respuesta a Front-End, colocando false en parametro 3, para que no se envie token de seguridad.
    }

    $code = executeSQL($cmd); // si no ocurrio error, se ejecuta la consulta resultante llamando executeSQL, y se captura codigo de respuesta

    if ($code === response_ok){ //Si no ocurre error...
        //Se crea query para insertar en la base de datos la contraseña de usuario.
        $cmd = "INSERT INTO scrty (id_cln, pass) select id_cln, '$clave' from clntes where crreo='$correo' and estdo_cln='P'";
        $code = executeSQL($cmd); //Se ejecuta query llamando a la funcion executeSQL y se captura codigo de error

        if ($code === response_ok){//Si no hubo error...
            $tkn = sha1(date("Y-m-d H:i:s")); //Se genera Token a partir de encriptar con SHA1 timestamp actual
            $fechaCreacion = date("Y-m-d"); //Variable fechaCreacion para almacenar fecha de creacion de usuario en BD
            $fechaCierre = '2099-12-31'; //Variable fechaCierre para almacenar fecha de cierre (max Calendario)
            $uso = "R"; //Se define uso como 'R' para registro a traves de login

            //Se crea query para insertar nuevo token en la BD con los datos anteriores
            $cmd = "INSERT INTO tokens (tokenid, token, fecha_creacion, fecha_cierre, uso, correo)
                    VALUES (NULL, '$tkn', '$fechaCreacion', '$fechaCierre', '$uso', '$correo')";
            $code = executeSQL($cmd); //Se ejecuta query llamando a la funcion executeSQL y se captura codigo de error

            if ($code === response_ok) {// Si no ocurre error, se envia correo electronico al usuario con Token para activar la cuenta
                $to = $correo;
                $from = "reservas@anapoimanatura.com";
                $subject = "Activa tu cuenta en Natura - anapoimanatura.com";

                $email_message = '<div style="max-width:600px; min-width:450px; margin: 10px auto;">';
                $email_message .= '<center>';
                $email_message .= '<img src="http://anapoimanatura.com/desarrollo/images/home/logo.png" />';
                $email_message .= '</center>';
                $email_message .= '<table style="width:100%; border-collapse:collapse; border-spacing:0; font:15px/1.5em Helvetica,Arial,sans-serif; color:#5D4C37; border:1px solid #ccc; box-shadow:0 0 1px #ccc;">';
                $email_message .= '<tbody>';
                $email_message .= '<tr style="border-bottom: 1px solid #eee;">';
                $email_message .= '<td style="max-width:30%; vertical-align:top; padding:8px; text-align:left;">';
                $email_message .= "<b>Hola $nombre, <br>Te has registrado en el Portal Natura</b>";
                $email_message .= '</td>';
                $email_message .= '<td style="max-width:30%; vertical-align:top; padding:8px; text-align:left;">';
                $email_message .= "Debes activar tu cuenta utilizando el siguiente enlace:<BR>";
                $email_message .= "<BR>";
                $email_message .= "<b>Enlace:  </b><a href='http://anapoimanatura.com/desarrollo/login/activate.php?tk=$tkn'> Activar mi cuenta </a> <BR>";
                $email_message .= '</td>';
                $email_message .= '</tr>';
                $email_message .= '</tbody>';
                $email_message .= '</table>';
                $email_message .= '</div>';

                sendMail($to,$from,$subject,$email_message); //Se envia correo llamando a la funcion sendMail

                $code = user_created; //Codigo de respuesta, usuario creado
                $response = array();
                SendResponse($code,$response,false); //Se responde a Front-End llamando a la funcion SendResponse
                }
            }
        }
    $response = array();
    SendResponse($code,$response,false);
}

function ResendActivationEmail($auth,$r){
// Metodo ResendActivationEmail invocado desde
// Vista:       /login/index.php
// Controlador: /login/js/controller.Login.js
//---------------------------------------------
// Autenticacion:   No requerida
// Objetivo:        Reenviar correo de activacion de cuenta de usuario

    $code = response_ok;

    $nombre = $r->nombre; //Se recibe campo de nombre
    $correo = $r->correo; //Se recibe campo de correo

    //Se genera consulta para saber si el usuario que envia la solicitud tiene un Token pendiente por utilizar
    $cmd = "select token from tokens where correo='$correo' and uso='R' and estado='A'";
    $token = getRowSQL($cmd);

    if ($token != null) { //Si existe un token para el usuario se reenvia
        $to = $correo;
        $from = "reservas@anapoimanatura.com";
        $subject = "Activa tu cuenta en Natura - anapoimanatura.com";

        $email_message = '<div style="max-width:600px; min-width:450px; margin: 10px auto;">';
        $email_message .= '<center>';
        $email_message .= '<img src="http://anapoimanatura.com/desarrollo/images/home/logo.png" />';
        $email_message .= '</center>';
        $email_message .= '<table style="width:100%; border-collapse:collapse; border-spacing:0; font:15px/1.5em Helvetica,Arial,sans-serif; color:#5D4C37; border:1px solid #ccc; box-shadow:0 0 1px #ccc;">';
        $email_message .= '<tbody>';
        $email_message .= '<tr style="border-bottom: 1px solid #eee;">';
        $email_message .= '<td style="max-width:30%; vertical-align:top; padding:8px; text-align:left;">';
        $email_message .= "<b>Hola $nombre, <br>Te has registrado en el Portal Natura</b>";
        $email_message .= '</td>';
        $email_message .= '<td style="max-width:30%; vertical-align:top; padding:8px; text-align:left;">';
        $email_message .= "Debes activar tu cuenta utilizando el siguiente enlace:<BR>";
        $email_message .= "<BR>";
        $email_message .= "<b>Enlace:  </b><a href='http://anapoimanatura.com/desarrollo/login/activate.php?tk=$token[0]'> Activar mi cuenta </a> <BR>";
        $email_message .= '</td>';
        $email_message .= '</tr>';
        $email_message .= '</tbody>';
        $email_message .= '</table>';
        $email_message .= '</div>';

        $code = sendMail($to,$from,$subject,$email_message); // Se envia correo electronico llamando a la funcion sendMail

        $response = array();
        SendResponse($code,$response,false); // Se envia respuesta llamando a la funcion SendResponse
    } else{ //Si no hay ningun codigo pendiente por enviar para este usuario...
        $code = access_forbidden; // se genera codigo de error
        $response = array();
        SendResponse($code,$response,false); //Se envia respuesta llamando a la funcion SendResponse, indicando en el parametro 3 false para que no se envie token de seguridad.
    }
}

function activateUser($auth,$r){
// Metodo activateUser invocado desde
// Vista:       /login/activate.php
// Controlador: /login/js/controller.Login.js
//---------------------------------------------
// Autenticacion:   No requerida
// Objetivo:        Realizar activacion de cuenta de usario a partir de token de seguridad

    $token = $r->token; //Se recibe campo token en la solicitud

    //Se consulta en base de datos si el token es valido para activar una cuenta de usuario
    $cmd = "select tokenid, correo from tokens where token='$token' and uso='R' and estado='A'";
    $sel = getRowSQL($cmd); //Se invoca funcion getRowSQL para capturar respuesta de base de datos de un solo registro.

    if ($sel != null) { //Si el token existe, se realiza proceso de activacion previa validacion de lo datos...
        $correo = $sel[1]; //Se captura correo del cliente para el que fue asignado el token
        $tokenid = $sel[0]; //Se captura ID del token recibido

        //Se valida que el cliente al que pertenece el token, perteneza a una cuenta en estado Pendiente y su fuente sea Registro
        $cmd = "select crreo from clntes where crreo='$correo' and fuente='R' and estdo_cln='P'";
        $sel = getRowSQL($cmd);

        if ($sel != null) { //Si el cliente se encuentra pendiente de activacion, activamos la cuenta de usuario
            $cmd = "UPDATE clntes SET estdo_cln='A' WHERE crreo='$correo'"; //Se genera SQL para modificar el estado del Cliente a Activo
            $code = executeSQL($cmd); //Ejecutamos la consulta anterior llamando a la funcion executeSQL
            if ($code === response_ok){ //Si no ocurrio ningun error, inactivamos el token para que no pueda ser utilizado posteriormente
                $cmd = "UPDATE tokens SET estado='I' WHERE tokenid=$tokenid"; //SQL para inactivar token
                $code = executeSQL($cmd);    //Se ejecuta la inactivacion del token, y se captura codigo de respuesta
                $response = array();
                SendResponse($code,$response); //Se envia respuesta Front-End
            } else {    //Si ocurrio algun error en la Activacion de la cuenta de usuario...
                $response = array();
                SendResponse($code,$response); //Se envia Codigo de error a Front-End
            }
        } else { //Si el cliente al que se le asigno el token recibido ya se encuentra activo...
            $code = user_already_active; //Se genera codigo de respuesta de Usuario ya activo
            $response = array();
            SendResponse($code,$response); // Se envia respuesta a Front-End
        }
    } else { //Si el token recibido no existe o no se encuentra activo...
        $code = token_invalid; //Se genera codigo de error de Token Invalido
        $response = array();
        SendResponse($code,$response); //Se envia error a Front-End
    }
}


function getUsers_a($auth,$r){
// Metodo getUsers_a invocado desde
// Vista:       /userAdmin/gestion.php
// Controlador: /userAdmin/js/controller.userAdmin.js
//---------------------------------------------
// Autenticacion:   Requerida como Administrador
// Objetivo:        Capturar listado de usuarios en base de datos

    //Se genera consulta para listar clientes en base de datos
	$sql  = "SELECT c.id_cln as id_cln,c.crreo as correo,c.nmbre as nombre,c.fcha_ncmnto as nacimiento,c.tlfno as telefono,";
    $sql .= "c.ncnldad as pais,c.cdad as ciudad,c.fcha_ingrso as creacion,c.estdo_cln as estado,c.fuente as fuente,";
    $sql .= "r.rol as rol, SUBSTRING(b.ultimaReserva FROM 1 FOR 10) as ultimaReserva FROM clntes c ";
    $sql .= "join rol_clntes r on (r.id_cln = c.id_cln) ";
    $sql .= "left outer join (select c_email, max(created) ultimaReserva ";
    $sql .= "from bk_hotel_booking_bookings book ";
    $sql .= "where status = 'confirmed' group by 1) b on (c.crreo = b.c_email)";
    $users = jsonQuery($sql); //Se ejecuta consulta llamando a la funcion jsonQuery para obtener los datos en formato JSON

    $response = array("users" => $users); //Se genera respuesta estructurada para Front-End
    SendResponse(response_ok,$response); //Se envia respuesta llamando a SendResponse
}

function delUser_a($auth,$data){
// Metodo getUsers_a invocado desde
// Vista:       /userAdmin/gestion.php
// Controlador: /userAdmin/js/controller.userAdmin.js
//---------------------------------------------
// Autenticacion:   Requerida como Administrador
// Objetivo:        Eliminar usuario de la base de datos

    $cmd  = "DELETE from clntes WHERE id_cln=".$data->id_cln; //SQL para eliminar usuario recibido en la solicitud

    $code = executeSQL($cmd);//Se ejecuta SQL para eliminar el usuario llamando a la funcion executeSQL

    $response = array();
    SendResponse($code,$response);//Enviamos respuesta a Front-End con el codigo de respuesta
}

function newUser_a($auth,$data){
// Metodo newUser_a invocado desde
// Vista:       /userAdmin/gestion.php
// Controlador: /userAdmin/js/controller.userAdmin.js
//---------------------------------------------
// Autenticacion:   Requerida como Administrador
// Objetivo:        Crear nuevo usuario en base de datos

    //Consultamos en la base de datos si el usuario enviado en la solicitud existe previamente
    $cmd = "Select id_cln, fuente, estdo_cln FROM clntes where crreo='".$data->correo."'";
    $rslt = jsonQuery($cmd); //Se captura el resultado de la consulta llamando a la funcion jsonQuery
    $code = user_conflict;
    if (empty($rslt)){ //Si el usuario no existe...
        //Se genera SQL para insertar al cliente en la base de datos
        $cmd  = "INSERT into clntes ";
        $cmd .= "(id_cln,crreo,nmbre,fcha_ncmnto,tpo_numdoc,id_numdoc,tlfno,ncnldad,cdad,fuente,estdo_cln) VALUES (";
        $cmd .= "null,'".$data->correo."', ";
        $cmd .= "'".$data->nombre."', ";
        $cmd .= "'".$data->nacimiento."',null,null, ";
        if ($data->telefono != "") $cmd .= $data->telefono.", ";
        else $cmd .= "0, ";
        $cmd .= "'".$data->pais."', ";
        $cmd .= "'".$data->ciudad."', ";
        $cmd .= "'".$data->fuente."', ";
        $cmd .= "'".$data->estado."')";

        $code = executeSQL($cmd); //Se ejecuta el SQL
        if ($code === response_ok){ //Si no hubo error al crear el usuario...
            $clave2 = $data->c2; //Se captura contraseña encriptada enviada en la solicitud
            $clave1 = $data->c1; //Se captura contraseña de usuario enviada en la solicitud
            $correo = $data->correo; //Se captura correo electronico enviado en la solicitud

            //Se genera SQL para insertar contraseña de usuario a la base de datos
            $cmd = "INSERT INTO scrty (id_cln, pass) select id_cln, '$clave2' from clntes where crreo='$correo' and estdo_cln in ('P','A')";
            $code = executeSQL($cmd); //Se ejecuta el SQL

            if ($code === response_ok){ //Si no hubo error al insertar la contraseña del usuario
                $nombre = $data->nombre; //Se captura nombre de usuario enviado en la solicitud
                $tkn = sha1(date("Y-m-d H:i:s")); //Se genera token encriptar con SHA1 el timestamp actual
                $fechaCreacion = date("Y-m-d");
                $fechaCierre = '2099-12-31';
                $uso = "R"; //Se define uso en 'R' para crear token de Registro
                //Se genera SQL para crear nuevo token de seguridad
                $cmd = "INSERT INTO tokens (tokenid, token, fecha_creacion, fecha_cierre, uso, correo)
                        VALUES (NULL, '$tkn', '$fechaCreacion', '$fechaCierre', '$uso', '$correo')";
                $code = executeSQL($cmd); //ejecutamos SQL

                if ($code === response_ok) { //Si el token se creo correctamente, enviamos correo al usuario con su contraseña y token
                    $to = $correo;
                    $from = "reservas@anapoimanatura.com";
                    $subject = "Activa tu cuenta en Natura - anapoimanatura.com";

                    $email_message = '<div style="max-width:600px; min-width:450px; margin: 10px auto;">';
                    $email_message .= '<center>';
                    $email_message .= '<img src="http://anapoimanatura.com/desarrollo/images/home/logo.png" />';
                    $email_message .= '</center>';
                    $email_message .= '<table style="width:100%; border-collapse:collapse; border-spacing:0; font:15px/1.5em Helvetica,Arial,sans-serif; color:#5D4C37; border:1px solid #ccc; box-shadow:0 0 1px #ccc;">';
                    $email_message .= '<tbody>';
                    $email_message .= '<tr style="border-bottom: 1px solid #eee;" >';
                    $email_message .= '<td style="max-width:30%; vertical-align:top; padding:8px; text-align:left;">';
                    $email_message .= "<b>Hola $nombre, <br>Te has registrado en el Portal Natura</b>";
                    $email_message .= '</td>';
                    $email_message .= '<td style="max-width:30%; vertical-align:top; padding:8px; text-align:left;">';
                    $email_message .= "Debes activar tu cuenta utilizando el siguiente enlace:<BR>";
                    $email_message .= "<BR>";
                    $email_message .= "<b>Enlace:  </b><a href='http://anapoimanatura.com/desarrollo/login/activate.php?tk=$tkn'> Activar mi cuenta </a> <BR>";
                    $email_message .= "<br>Te hemos asignado esta contraseña para iniciar sesion:<BR>";
                    $email_message .= "<BR>";
                    $email_message .= "<b>Contraseña:  </b>$clave1 <BR>";
                    $email_message .= '</td>';
                    $email_message .= '</tr>';
                    $email_message .= '</tbody>';
                    $email_message .= '</table>';
                    $email_message .= '</div>';

                    sendMail($to,$from,$subject,$email_message);// Se envia correo electronico al usuario

                    $code = user_created; //Se genera codigo de respuesta de Usuario Creado
                    $response = array();
                    SendResponse($code,$response); // Se envia codigo de respusta a Front-End

                }
            }
        }
    }

    $response = array();
    SendResponse($code,$response); //Si ocurrio algun error se envia respuesta a Front-End
}

function updUser_a($auth,$data){
// Metodo updUser_a invocado desde
// Vista:       /userAdmin/gestion.php
// Controlador: /userAdmin/js/controller.userAdmin.js
//---------------------------------------------
// Autenticacion:   Requerida como Administrador
// Objetivo:        Actualizar datos de usuario

    $id_cln = $data->id_cln;    //ID de usuario recibido en la solicitud
    $c1 = $data->c1;            //Se captura contraseña de usuario recibida en la solicitud
    $c2 = $data->c2;            //Se captura contraseña encriptada recibida en la solicitud
    $estado = $data->estado;    //Estado de cuenta de usuario recibido en la solicitud
    $fuente = $data->fuente;    //Fuente de la informacion recibido en la solicitd
    $correo = $data->correo;    //Correo electronico de usuario recibido en la solicitud

    //Se consulta en base de datos si el usuario de la solicitud ya tiene alguna contraseña guardada
    $cmd = "select * from scrty where id_cln = $id_cln";
    $rslt = jsonQuery($cmd); //Ejecutamos la consulta
    //Si el usuario no tiene una contraseña, la fuente recibida es Registro y el estado recibido es Activo
    //Se cambia la variable estado a Pendiente, ya que el usuario debe activar su cuenta primero
    if (empty($rslt) && $fuente=='R' && $estado=='A') $estado = 'P';
    //Se genera SQL para actualizar los datos de usuario
    $cmd  = "UPDATE clntes SET ";
    $cmd .= "nmbre='".$data->nombre."', ";
    $cmd .= "fcha_ncmnto='".$data->nacimiento."', ";
    if ($data->telefono != "") $cmd .= "tlfno=".$data->telefono.", ";
    else $cmd .= "tlfno=0, ";
    $cmd .= "ncnldad='".$data->pais."', ";
    $cmd .= "cdad='".$data->ciudad."', ";
    $cmd .= "estdo_cln='".$estado."', ";
    $cmd .= "fuente='".$data->fuente."' ";
    $cmd .= "WHERE id_cln=".$data->id_cln;

    $code = executeSQL($cmd); //Se ejecuta SQL
    if ($code === response_ok){ //Si no hay error en la ejecucion
    //Actualizamos el rol del Cliente segun la solicitud realizada con el siguiente SQL
        $cmd  = "UPDATE rol_clntes SET ";
        $cmd .= "rol=".$data->rol." ";
        $cmd .= "WHERE id_cln=".$data->id_cln;

        $code = executeSQL($cmd); //Ejecutamos actualizacion de rol
        //Consultamos si no hubo error en la anterior ejecucion, si el usuario no tiene contraseña
        //y si la fuente es Registro y el estado de la cuenta es Pendiente
        //Si asi es, se crea la contraseña para el usuario
        if($code === response_ok && empty($rslt) && $fuente=='R' && $estado=='P'){
            //SQL para insertar la contraseña de usuario
            $cmd = "INSERT INTO scrty (id_cln, pass) select id_cln, '$c2' from clntes where crreo='$correo' and estdo_cln in ('P')";
            $code = executeSQL($cmd); //Ejecutamos SQL

            if ($code === response_ok){ // Si no hubo ningun error

                $nombre = $data->nombre; //Se captura nombre de usuario de la solicitud
                $tkn = sha1(date("Y-m-d H:i:s")); //Se genera token encriptando con sha1 el timestamp actual
                $fechaCreacion = date("Y-m-d"); //
                $fechaCierre = '2099-12-31';
                $uso = "R"; //Variable $uso en "R" para usuarios de registro

                //SQL para insertar token a la base de datos
                $cmd = "INSERT INTO tokens (tokenid, token, fecha_creacion, fecha_cierre, uso, correo)
                        VALUES (NULL, '$tkn', '$fechaCreacion', '$fechaCierre', '$uso', '$correo')";
                $code = executeSQL($cmd); //Se ejecuta con executeSQL

                if ($code === response_ok) { //Si no ocurre error
                    $to = $correo;
                    $from = "reservas@anapoimanatura.com";
                    $subject = "Activa tu cuenta en Natura - anapoimanatura.com";

                    $email_message = '<div style="max-width:600px; min-width:450px; margin: 10px auto;">';
                    $email_message .= '<center>';
                    $email_message .= '<img src="http://anapoimanatura.com/desarrollo/images/home/logo.png" />';
                    $email_message .= '</center>';
                    $email_message .= '<table style="width:100%; border-collapse:collapse; border-spacing:0; font:15px/1.5em Helvetica,Arial,sans-serif; color:#5D4C37; border:1px solid #ccc; box-shadow:0 0 1px #ccc;">';
                    $email_message .= '<tbody>';
                    $email_message .= '<tr style="border-bottom: 1px solid #eee;" >';
                    $email_message .= '<td style="max-width:30%; vertical-align:top; padding:8px; text-align:left;">';
                    $email_message .= "<b>Hola $nombre, <br>Te has registrado en el Portal Natura</b>";
                    $email_message .= '</td>';
                    $email_message .= '<td style="max-width:30%; vertical-align:top; padding:8px; text-align:left;">';
                    $email_message .= "Debes activar tu cuenta utilizando el siguiente enlace:<BR>";
                    $email_message .= "<BR>";
                    $email_message .= "<b>Enlace:  </b><a href='http://anapoimanatura.com/desarrollo/login/activate.php?tk=$tkn'> Activar mi cuenta </a> <BR>";
                    $email_message .= "<br>Te hemos asignado esta contraseña para iniciar sesion:<BR>";
                    $email_message .= "<BR>";
                    $email_message .= "<b>Contraseña:  </b>$c1 <BR>";
                    $email_message .= '</td>';
                    $email_message .= '</tr>';
                    $email_message .= '</tbody>';
                    $email_message .= '</table>';
                    $email_message .= '</div>';

                    sendMail($to,$from,$subject,$email_message); //Se envia correo electronico al cliente

                    $response = array();
                    SendResponse($code,$response); //Se envia respuesta a Front-End con SendResponse

                }
            }
        }
    }

    $response = array();
    SendResponse($code,$response); //Si ocurrio algun error se envia respuesta a Front-End
}

function getUsersPromos_a($auth,$r){
// Metodo getUsersPromos_a invocado desde
// Vista:       /promosAdmin/index.php
// Controlador: /promosAdmin/js/controller.promosAdmin.js
//---------------------------------------------
// Autenticacion:   Requerida como Administrador
// Objetivo:        Listar usuarios en base de datos registrados y con cuenta activa

    //SQL para consultar en base de datos el listado de clientes
	$sql  = "SELECT id_cln,crreo as correo,nmbre as nombre FROM clntes WHERE estdo_cln = 'A' and fuente='R'";
    $users = jsonQuery($sql); //Se ejecuta consulta y se captura resultado en JSON

    $response = array("users" => $users); //Se genera respuesta estructurada para Front-End
    SendResponse(response_ok,$response); //Se envia respuesta
}

function getPromos_a($auth,$r){
// Metodo getPromos_a invocado desde
// Vista:       /promosAdmin/gestion.php
// Controlador: /promosAdmin/js/controller.promosAdmin.js
//---------------------------------------------
// Autenticacion:   Requerida como Administrador
// Objetivo:        Listar promociones en base de datos

    //SQL para consultar en base de datos el listado de codigos promocionales
	$sql  = "SELECT p.*, estdo as estado, asgn as tipo FROM promocodes p";
    $promos = jsonQuery($sql); //Se ejecuta consulta y se captura resultado en JSON

    $response = array("promos" => $promos); //Se genera respuesta estructurada
    SendResponse(response_ok,$response); //Se envia respuesta a Front-End
}

function getPromo_Users_a($auth,$r){
// Metodo getPromo_Users_a invocado desde
// Vista:       /promosAdmin/gestion.php
// Controlador: /promosAdmin/js/controller.promosAdmin.js
//---------------------------------------------
// Autenticacion:   Requerida como Administrador
// Objetivo:        Consulta de usuarios relacionados con promocion solicitada

    //SQL para consultar en base de datos el listado de usuarios enlazados a la promocion
	$sql  = "SELECT DISTINCT id_cln, crreo as correo, nmbre as nombre FROM clntes c ";
    $sql .= "JOIN assignm a ON (c.id_cln = a.id_user) ";
    $sql .= "WHERE estdo_cln = 'A' and fuente='R' AND id_code = '".$r->cdgo ."'";
    $users = jsonQuery($sql); //Se ejecuta consulta

    $response = array("users" => $users);
    SendResponse(response_ok,$response); //Se envia respuesta a Front-End

}

function newPromo_a($auth,$r){
// Metodo newPromo_a invocado desde
// Vista:       /promosAdmin/gestion.php
// Controlador: /promosAdmin/js/controller.promosAdmin.js
//---------------------------------------------
// Autenticacion:   Requerida como Administrador
// Objetivo:        Creacion de nuevas promociones

    $dscr = $r->dscr; //Descripcion de promocion recibida en solicitud
    $asgn = $r->asgn; //Tipo de promocion recibida en solicitud
    $dscn = $r->dscn; //Porcentaje Descuento recibida en solicitud
    $fmin = $r->fmin; //Fecha inicio de promocion recibida en solicitud
    $fmax = $r->fmax; //Fecha fin de promocion recibida en solicitud
    $list = $r->clnt; //Listado de clientes para enlazar a promocion recibida en solicitud

    //Se genera nombre automatico de Codigo Promocional
    $sql = "SELECT max(ID) FROM promocodes";
	$res = getRowSQL($sql);
	$l = $asgn[0];
	if ($asgn == "Masivo") $l = "T";
	$cdgo = "COD-".$l.(intval($res[0])+1);

    //Se inserta en la base de datos la nueva promocion
    $cmd = "INSERT INTO promocodes (cdgo, dscr, asgn, dscn, fmin, fmax)
        VALUES ('$cdgo','$dscr','$asgn',$dscn,'$fmin','$fmax')";
    $code = executeSQL($cmd);
    //Si no ocurrio error en la insercion...
    if ($code === response_ok) {
        //Se almacena en base de datos, usuarios relacionados a la promocion
        foreach ($list as $clnt){
            $cmd = "INSERT INTO assignm (id_code, id_user) VALUES ('" . $cdgo . "'," . $clnt->id_cln . ")";
            $code = executeSQL($cmd);
        }
    }
    //Si ocurrio algun error se envia respuesta a Front-End
    $response = array();
    SendResponse($code,$response);

}

function updPromo_a($auth,$r){
// Metodo updPromo_a invocado desde
// Vista:       /promosAdmin/gestion.php
// Controlador: /promosAdmin/js/controller.promosAdmin.js
//---------------------------------------------
// Autenticacion:   Requerida como Administrador
// Objetivo:        Actualizacion de promociones

    $cdgo = $r->cdgo; //Nombre de codigo promocional recibido en solicitud
    $fmin = $r->fmin; //Fecha de inicio del codigo promocional recibido en solicitud
    $fmax = $r->fmax; //Fecha de cierre del codigo promocional recibido en solicitud
    $dscr = $r->descrip; //Descripcion del codigo promocional recibido en solicitud
    $asgn = $r->tipo; //Tipo de codigo promocional recibido en solicitud
    $estd = $r->estado; //Estado de codigo promocional recibido en solicitud
    $dscn = $r->descuento; //Porcentaje descuento de codigo promocional recibido en solicitud
    $list = $r->lista; //Listado de clientes relacionados al codigo promocional recibido en solicitud

    //Se actualiza los datos de la promocion segun solicitud
    $cmd = "UPDATE promocodes SET dscr = '$dscr', asgn = '$asgn', dscn = $dscn,
            fmin = '$fmin', fmax = '$fmax', estdo = $estd WHERE cdgo = '$cdgo'";
    $code = executeSQL($cmd);

    if ($code === response_ok) {//Si no ocurre error...
        //Se actualiza listado de clientes enlazados a la promocion
        $cmd = "DELETE FROM assignm WHERE id_code = '$cdgo'";
        $code = executeSQL($cmd);
        if ($code === response_ok) {
            foreach ($list as $clnt){
                $cmd = "INSERT INTO assignm (id_code, id_user) VALUES ('" . $cdgo . "'," . $clnt->id_cln . ")";
                $code = executeSQL($cmd);
            }
        }
    }
    $response = array();
    SendResponse($code,$response); //Se envia respuesta del servidor

}

function delPromo_a($auth,$r){
// Metodo delPromo_a invocado desde
// Vista:       /promosAdmin/gestion.php
// Controlador: /promosAdmin/js/controller.promosAdmin.js
//---------------------------------------------
// Autenticacion:   Requerida como Administrador
// Objetivo:        Eliminar promociones

    $cdgo = $r->id_code; //Nombre del codigo promocional recibido en la solicitud

    //Se elimina de la base de datos el codigo solicitado
    $cmd = "DELETE FROM promocodes WHERE cdgo = '$cdgo'";
    $code = executeSQL($cmd);

    if ($code === response_ok) {
        //Se elimina listado de clientes enlazados a la promocion eliminada
        $cmd = "DELETE FROM assignm WHERE id_code = '$cdgo'";
        $code = executeSQL($cmd);
    }

    $response = array();
    SendResponse($code,$response); //Se envia respuesta del servidor
}

function modifClntes_a($auth,$data){
// Metodo modifClntes_a invocado desde
// Vista:       /userAdmin/gestion.php
// Controlador: /userAdmin/js/controller.userAdmin.js
//---------------------------------------------
// Autenticacion:   Requerida como Administrador
// Objetivo:        Modificar informacion de usuario de la base de datos

    $clntes = $data->id_cln; //id del usuario a modificar recibido en la solicitud
    $c_1 = $data->c1; //Contraseña recibido en la solicitud
    $c_2 = $data->c2; //Contraseña encriptada recibido en la solicitud
    $estado = $data->estado; //Estado de la cuenta de usuario recibido en la solicitud

    $code = response_ok;
    foreach ($clntes as $i => $id_cln){
        $cmd = "select * from scrty where id_cln = $id_cln"; //Se consulta si el usuario tiene una contraseña asignada
        $rslt = jsonQuery($cmd);

        /Se consulta estado actual de fuente de informacion, correo y nombre del usuario en base de datos
        $sql  = "SELECT fuente,crreo as correo,nmbre as nombre FROM clntes WHERE id_cln=$id_cln";
        $u = jsonQuery($sql);
        $fuente = $u[0]['fuente'];
        $nombre = $u[0]['nombre'];
        $correo = $u[0]['correo'];
        $c1 = $c_1[$i];
        $c2 = $c_2[$i];

        //Si el usuario no tiene una contraseña asignada, se encuentra registrado y con estado de cuenta Activo
        //Se cambia el estado a Pendiente
        if (empty($rslt) && $fuente=='R' && $estado=='A') $estado = 'P';

        if ($estado == 'I'){ //Si el estado recibido es inactivo
            $cmd  = "UPDATE clntes SET ";
            $cmd .= "estdo_cln='".$estado."' ";
            $cmd .= "WHERE id_cln=".$id_cln;
            $code += executeSQL($cmd); //Se cambia el estado del cliente a inactivo
        } else {
            $cmd  = "UPDATE clntes SET ";
            $cmd .= "estdo_cln='".$estado."' ";
            $cmd .= "WHERE id_cln=".$id_cln;
            $cmd .= " AND fuente='R'";
            $code += executeSQL($cmd); //Si no es inactivo, se actualiza el estado solo si la fuente de informacion es Registro
        }

        //Si no han ocurrido errores y el usuario no tiene contraseña y la fuente es Registro y el estado Pendiente...
        if($code === response_ok && empty($rslt) && $fuente=='R' && $estado=='P'){
            $cmd = "INSERT INTO scrty (id_cln, pass) VALUES ($id_cln, '$c2')";
            $code += executeSQL($cmd); //Se almacena la contraseña recibida para el usuario

            if ($code === response_ok){ ///Si no ocurre error...

                $tkn = sha1(date("Y-m-d H:i:s")); //Se genera token de seguridad
                $fechaCreacion = date("Y-m-d");
                $fechaCierre = '2099-12-31';
                $uso = "R"; //Con R para usuario de Registro

                ///Almacenamos token en base de datos
                $cmd = "INSERT INTO tokens (tokenid, token, fecha_creacion, fecha_cierre, uso, correo)
                        VALUES (NULL, '$tkn', '$fechaCreacion', '$fechaCierre', '$uso', '$correo')";
                $code += executeSQL($cmd);

                if ($code === response_ok) { //Si no ocurre error ...
                    $to = $correo;
                    $from = "reservas@anapoimanatura.com";
                    $subject = "Activa tu cuenta en Natura - anapoimanatura.com";

                    $email_message = '<div style="max-width:600px; min-width:450px; margin: 10px auto;">';
                    $email_message .= '<center>';
                    $email_message .= '<img src="http://anapoimanatura.com/desarrollo/images/home/logo.png" />';
                    $email_message .= '</center>';
                    $email_message .= '<table style="width:100%; border-collapse:collapse; border-spacing:0; font:15px/1.5em Helvetica,Arial,sans-serif; color:#5D4C37; border:1px solid #ccc; box-shadow:0 0 1px #ccc;">';
                    $email_message .= '<tbody>';
                    $email_message .= '<tr style="border-bottom: 1px solid #eee;" >';
                    $email_message .= '<td style="max-width:30%; vertical-align:top; padding:8px; text-align:left;">';
                    $email_message .= "<b>Hola $nombre, <br>Te has registrado en el Portal Natura</b>";
                    $email_message .= '</td>';
                    $email_message .= '<td style="max-width:30%; vertical-align:top; padding:8px; text-align:left;">';
                    $email_message .= "Debes activar tu cuenta utilizando el siguiente enlace:<BR>";
                    $email_message .= "<BR>";
                    $email_message .= "<b>Enlace:  </b><a href='http://anapoimanatura.com/desarrollo/login/activate.php?tk=$tkn'> Activar mi cuenta </a> <BR>";
                    $email_message .= "<br>Te hemos asignado esta contraseña para iniciar sesion:<BR>";
                    $email_message .= "<BR>";
                    $email_message .= "<b>Contraseña:  </b>$c1 <BR>";
                    $email_message .= '</td>';
                    $email_message .= '</tr>';
                    $email_message .= '</tbody>';
                    $email_message .= '</table>';
                    $email_message .= '</div>';

                    sendMail($to,$from,$subject,$email_message); // se envia correo electronico con token y contraseña al cliente

                }
            }
        }
    }
    $response = array();
    SendResponse($code,$response); ///Se envia codigo de respuesta a Front-End

}

function delClntes_a($auth,$data){
// Metodo delClntes_a invocado desde
// Vista:       /userAdmin/gestion.php
// Controlador: /userAdmin/js/controller.userAdmin.js
//---------------------------------------------
// Autenticacion:   Requerida como Administrador
// Objetivo:        Eliminar clientes de la base de datos

    $clntes = $data->id_cln; //Se captura id del cliente de la solicitud

    $code = response_ok;
    foreach ($clntes as $id_cln){

        //Se eliminan clientes solicitados
        $cmd  = "DELETE from clntes WHERE id_cln=".$id_cln;
        $code += executeSQL($cmd);
    }
    $response = array();
    SendResponse($code,$response); //Se envia codigo de respuesta del servidor
}


?>