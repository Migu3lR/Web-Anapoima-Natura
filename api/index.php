<?php
$er = 0;
define('db_isdown', 521);
define('db_unknown_error', 520);
define('access_forbidden', 500);
define('error_send_mail', 501);
define('token_invalid', 502);
define('user_conflict', 409);
define('user_already_active', 405);
define('user_wait_activate', 403);
define('bad_insert_request', 400);
define('user_not_found', 404);
define('invalid_password', 402);
define('user_created', 201);
define('user_accepted', 202);
define('pass_changed', 203);
define('user_unauthorized', 401);
define('response_ok', 0);

if (!defined("HB_HOST")) define("HB_HOST", "localhost");
if (!defined("HB_USER")) define("HB_USER", "hbzzadmin");
if (!defined("HB_PASS")) define("HB_PASS", "C@c6w217DS");
if (!defined("HB_DB")) define("HB_DB", "naturabase");

function sendMail($to,$from,$subject,$body){
    
    $headers = "From: $from\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    $result = mail($to, $subject, $body, $headers);
    
    if ($result) return response_ok;
    else return error_send_mail;
    
}

function connectDB(){
 $sql = mysqli_connect(HB_HOST, HB_USER, HB_PASS, HB_DB);
 if(!$sql){
	$er = db_isdown;
	echo json_encode('{"resp":'. $er .'}');
 }
 return $sql;
}

function getRowSQL($sql){
	$conexion = connectDB();
	$er = response_ok;
    //generamos la consulta
    mysqli_set_charset($conexion, "utf8"); //formato de datos utf8
	$result = mysqli_query($conexion, $sql);
	
    if(!$result) return false;
	return mysqli_fetch_row($result);
	
}

function executeSQL($sql){
    $conexion = connectDB();
    $er = response_ok;
    mysqli_set_charset($conexion, "utf8"); //formato de datos utf8
    if(!$result = mysqli_query($conexion, $sql)) $er = db_unknown_error;
    mysqli_close($conexion); //desconectamos la base de datos
    return $er;
}

function jsonQuery($sql){
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8"); //formato de datos utf8
    if(!$result = mysqli_query($conexion, $sql)) $er = db_unknown_error;
    $rawdata = array(); //creamos un array
	if($result){
    while($row = mysqli_fetch_assoc($result))
    {
        $rawdata[] = $row;
    }}
 
    mysqli_close($conexion); //desconectamos la base de datos
    return $rawdata; //devolvemos el array
}

function field2int($list, $field){
    foreach ($list as &$row) {
        $row[$field] = intval($row[$field]);
    }
    return $list;
}

function SendResponse($code,$items=array(),$sendTkn=true){
    $ItemswithToken = array();
    if ($sendTkn){
        $id = isAuth();
        $token = getToken($id);
        if ($token) {
            $jwt = JWT::encode($token, 'N4tur4S4f3');
            $ItemswithToken = array(
                "token" => $jwt
            );
        }
    }
    
    $items = array_merge($items,$ItemswithToken);
    
    $response = array (
        "code" => $code,
        "response" => $items
    );
    
    echo json_encode($response);  
    exit();      
}

function unAuth($forb=false){   
    if ($forb !== 'forbidden'){ 
        echo json_encode(
            array(
                "code" => user_unauthorized, 
                "response" => array()
            )
        );
    }else{
        echo json_encode(
            array(
                "code" => access_forbidden, 
                "response" => array()
            )
        );
    }    
    exit;
}

function call_resquest($r, $Auth_Required = true, $Admin_Required = false){
    if(is_callable($r->action)){ 
        $auth = isAuth($Admin_Required);
        if (($Auth_Required && $auth!==false && $auth!=='forbidden') || !$Auth_Required){
            call_user_func_array($r->action, [$auth,$r]);
        }
        else unAuth($auth);
    } else unAuth('forbidden');
}

switch($_SERVER['REQUEST_METHOD']){
case 'GET': 
    header("HTTP/1.1 403 Unauthorized");
    exit;
    break;
case 'POST':
    
    require_once('JWT.php');
    
    if (!isset($_FILES["file"]))    
        new_request(json_decode(file_get_contents("php://input")));
    else{
        require_once('upload.php');
        $r = new stdClass;
        $r->action = 'uploadAvatar';   
        new_request($r);
    }
    break;
}

function new_request($r){
    
    $AuthNotRequired = array(
        'login',
        'RegisterNewUser',
        'ResendActivationEmail',
        'activateUser',
        'getComents',
        'newComent'
    );
    
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
    
    if (isset($r->action)) call_resquest($r,!in_array($r->action, $AuthNotRequired),in_array($r->action, $AdminRequired));
    else unAuth('forbidden');
     
}

function login($auth,$r){
    $er = response_ok;
    
    $cmd = "Select c.id_cln, s.pass, c.estdo_cln,c.nmbre FROM clntes c JOIN scrty s ON (s.id_cln = c.id_cln) JOIN rol_clntes r ON (r.id_cln = c.id_cln) where c.fuente='R' and c.crreo='".$r->correo."'";
    $pass = getRowSQL($cmd);
    if($pass == null) $er = user_not_found;
    elseif($pass[2] =='A'){
        $token = new stdClass;
        if ($r->clave == $pass[1]){
            $er = user_accepted;
            $token = getToken($pass[0]);
        } else $er = user_unauthorized;
        
        if ($token && $er == user_accepted){
            $jwt = JWT::encode($token, 'N4tur4S4f3');
            echo json_encode(
                array(
                    "code" => $er, 
                    "response" => array(
                        "token" => $jwt
                    )
                )
            );
        } else $er = user_not_found;
    } elseif($pass[2] =='P'){
        $er = user_wait_activate;
    } else $er = user_not_found;
    
    if ($er != user_accepted){
        $re = array();
        if ($er == user_wait_activate){
            $re = array(
                "nombre" => $pass[3],
                "correo" => $r->correo
            );
        }
        echo json_encode(
            array(
                "code" => $er, 
                "response" => $re
            )
        );
    }
}

function getToken($id){
    $cmd = "Select c.id_cln, c.nmbre, c.crreo, r.rol FROM clntes c JOIN rol_clntes r ON (r.id_cln = c.id_cln) where fuente='R' and estdo_cln='A' and c.id_cln=".$id;
    $user = getRowSQL($cmd);
    
    if($user){        
        $id = $user[0];
        $nombre = $user[1].'';
        $email = $user[2];
        $rol = $user[3];
        
        $token = new stdClass;
        $token->iat = time();
        $token->exp = time() + (3600*24);
        $token->id = intval($id);
        $token->name = $nombre;
        $token->email = $email;
        $token->rol = intval($rol);
        
        return $token; 
    } else return false;
}

function isAuth ($verfAdmin = false){
    $headers = apache_request_headers();
    if(!isset($headers["Authorization"]) || empty($headers["Authorization"])) return false;    
    else {
        $token = explode(" ", $headers["Authorization"]);
        $user = JWT::decode(trim($token[1],'"'), 'N4tur4S4f3',array('HS256'));
        
        if ($verfAdmin && $user->rol == 0) return 'forbidden';         
        return checkUser($user->id, $user->email, $user->rol);

    }
}

function checkUser($id, $email, $rol){
    $cmd = "Select c.crreo, r.rol FROM clntes c JOIN rol_clntes r ON (r.id_cln = c.id_cln) where fuente='R' and estdo_cln='A' and c.id_cln=".$id;
    $user = getRowSQL($cmd);
    
    if($user){ if ($email == $user[0] && $rol == $user[1]) return $id; }
    return 'forbidden';
}

function getUserInfo($id,$r){
    $cmd = "Select c.*, r.rol FROM clntes c JOIN rol_clntes r ON (r.id_cln = c.id_cln) where fuente='R' and estdo_cln='A' and c.id_cln=".$id;
    $user = jsonQuery($cmd);
    
    $cmd = "Select b.uuid as id_reserva, b.created as fecha_reserva, b.status as estado_reserva, b.date_from as llegada_reserva, b.date_to as retiro_reserva FROM bk_hotel_booking_bookings b JOIN clntes c ON (b.c_email = c.crreo) where c.id_cln=".$id;
    $bookings = jsonQuery($cmd);
    
    $cmd = "Select cm.fecha, cm.rate as puntaje, cm.Mensaje as mensaje FROM comentarios cm  JOIN clntes c ON (cm.correo = c.crreo) where cm.estado='A' and c.id_cln=".$id;
    $comments = jsonQuery($cmd);
    
    
    $response = array(
                    "userInfo" => $user,
                    "userBookings" => $bookings,
                    "userComments" => $comments
                    );
    SendResponse(response_ok,$response);    
}

function editUser_personal($auth,$user){
    $cmd  = "UPDATE clntes SET";
    $cmd .= " nmbre = '".$user->nombre."',";
    $cmd .= " tlfno = '".$user->telefono."',";
    $cmd .= " ncnldad = '".$user->pais."',";
    $cmd .= " cdad = '".$user->ciudad."',";
    $cmd .= " fcha_ncmnto = '".$user->nacimiento."'";
    $cmd .= " WHERE id_cln = ".$user->id_cln;
    
    $code = executeSQL($cmd);
    
    $response = array();
    SendResponse($code,$response);

}

function uploadAvatar($id,$r){
    $code = changeAvatar($id);
    if ($code==response_ok){
    $cmd  = "UPDATE clntes SET";
    $cmd .= " avatar = '".$id.".jpg'";
    $cmd .= " WHERE id_cln = ".$id;
    
    $code = executeSQL($cmd);
    }
    
    $response = array();
    SendResponse($code,$response);
    
}

function changePass($auth,$r){
    $code = response_ok; 
    $id = $r->id_cln;
    $nueva = $r->nueva;
    $cmd  = "SELECT pass FROM scrty WHERE id_cln = $id";
    $pass = jsonQuery($cmd);
    
    if ($pass[0]['pass'] == $r->anterior){
        $cmd  = "UPDATE scrty SET pass = '$nueva' WHERE id_cln = $id";
        $code = executeSQL($cmd);
        $cmd  = "SELECT pass FROM scrty WHERE id_cln = $id";
        $pass = jsonQuery($cmd);
        if ($pass[0]['pass'] == $nueva) $code = pass_changed;
        else $code = db_unknown_error;
    } else $code = invalid_password;
    
    $response = array();
    SendResponse($code,$response);
    
}

function getPromComments_a($auth,$r){
    $sql = "SELECT sum(rate)/count(*) as prom FROM comentarios ";
    $sql .= "where rate > 0 ";
    $sql .= "and estado= 'A'";
    $prom = jsonQuery($sql);
        
    
    $response = array("prom" => $prom[0]['prom']);
    SendResponse(response_ok,$response);
}

function getComments_a($auth,$r){
	$sql = "SELECT * FROM comentarios";
	$posts = jsonQuery($sql);
    $posts = field2int($posts,'rate');
    
    $response = array("comments" => $posts);
    SendResponse(response_ok,$response);    
}


function NewTokenforComment($auth,$r){
    $code = response_ok;
    
    $nombre = $r->nombre;
    $correo = $r->correo;
    
    $tkn = sha1(date("Y-m-d H:i:s"));
    $fechaCreacion = date("Y-m-d");
    $fechaCierre = date("Y-m-d",strtotime("+1 Months"));
    $uso = "C";
    
    $cmd = "INSERT INTO tokens (tokenid, token, fecha_creacion, fecha_cierre, uso, correo)
            VALUES (NULL, '$tkn', '$fechaCreacion', '$fechaCierre', '$uso', '$correo')";
    $code = executeSQL($cmd);
    
    if ($code === response_ok) {
        
        $to = $correo;
        $from = "reservas@anapoimanatura.com";
        $subject = "Danos tu opinión de nosotros - anapoimanatura.com";
        
        $email_message = '<div style="max-width:600px; min-width:450px; margin: 10px auto;">';
        $email_message .= '<center>';
        $email_message .= '<img src="http://186.147.34.63/images/home/logo.png" />';
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
        $email_message .= "<b>Enlace:  </b><a href='http://186.147.34.63/comentarios/comentar.php?tk=$tkn'> COMENTAR </a> <BR>";
        $email_message .= '</td>';
        $email_message .= '</tr>';
        $email_message .= '</tbody>';
        $email_message .= '</table>';
        $email_message .= '</div>';
        
        $code = sendMail($to,$from,$subject,$email_message);
        
    }
     
        
    $response = array();
    SendResponse($code,$response);
}

function updateComent($auth,$r){
    $idCmt = $r->id;
    $estado = $r->estado;
    $publicar = $r->publicar;
    
    $cmd = "UPDATE comentarios SET estado='$estado', publicar='$publicar' WHERE ID=$idCmt";
    
    $code = executeSQL($cmd);
    
    $response = array();
    SendResponse($code,$response);
}

function getComents($auth,$r){
    $sql = "SELECT * FROM comentarios where estado='A' and publicar='S' order by fecha desc";
    $posts = jsonQuery($sql);
    $posts = field2int($posts,'rate');
    
    $response = array("comments" => $posts);
    SendResponse(response_ok,$response);
}

function newComent($auth,$r){
    $nombre = $r->nombre;
    $email = $r->email;
    $mensaje = $r->mensaje;
    $rate = $r->rate;
    $token = $r->token;
    
    $code = response_ok;
    
    $hoy = date("Y-m-d");
    $cmd = "Select tokenid, fecha_cierre FROM tokens where token='$token' and correo='$email' and estado='A'";
    $rslt = jsonQuery($cmd);
    
    if (!empty($rslt)){
        if ($hoy <= $rslt[0]['fecha_cierre']){
            $cmd = "INSERT INTO comentarios (id, id_cln, nombre, correo, mensaje, rate, tokenid)
            VALUES (NULL, NULL, '$nombre','$email','$mensaje',$rate,'".$rslt[0]['tokenid']."')";
            
            $code = executeSQL($cmd);
        } else $code = token_invalid;		
    } else $code = token_invalid;

    $response = array();
    SendResponse($code,$response);
}

function RegisterNewUser($auth,$r){
    
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
    
    $cmd = "Select id_cln, fuente, estdo_cln FROM clntes where crreo='$correo'";
    $rslt = jsonQuery($cmd);
    
    if (empty($rslt)){
        $cmd = "INSERT INTO clntes (id_cln, crreo, nmbre, fcha_ncmnto, tpo_numdoc, id_numdoc, tlfno, ncnldad,cdad,fuente,estdo_cln)
                VALUES (NULL, '$correo','$nombre','$fecha',$tipo,$documento,$telefono,'$nacionalidad','$municipio','R','P')";
        
    } elseif($rslt[0]['fuente'] != 'R'){
        $cmd = "UPDATE clntes SET nmbre='$nombre', 
                fcha_ncmnto='$fecha', 
                tlfno=$telefono, 
                ncnldad='$nacionalidad',
                cdad='$municipio',
                fuente='R',
                estdo_cln='P'
                WHERE id_cln=".$rslt[0]['id_cln'];
    } else {
        $response = array();
        $code = user_conflict;
        SendResponse($code,$response,false);
    }
    
    $code = executeSQL($cmd);
    
    if ($code === response_ok){
        
        $cmd = "INSERT INTO scrty (id_cln, pass) select id_cln, '$clave' from clntes where crreo='$correo' and estdo_cln='P'";
        $code = executeSQL($cmd);
    
        if ($code === response_ok){
            $tkn = sha1(date("Y-m-d H:i:s"));
            $fechaCreacion = date("Y-m-d");
            $fechaCierre = '2099-12-31';
            $uso = "R";
            /////////////////////////////////
            $cmd = "INSERT INTO tokens (tokenid, token, fecha_creacion, fecha_cierre, uso, correo)
                    VALUES (NULL, '$tkn', '$fechaCreacion', '$fechaCierre', '$uso', '$correo')";
            $code = executeSQL($cmd);
        
            if ($code === response_ok) {
                $to = $correo;
                $from = "reservas@anapoimanatura.com";
                $subject = "Activa tu cuenta en Natura - anapoimanatura.com";
                
                $email_message = '<div style="max-width:600px; min-width:450px; margin: 10px auto;">';
                $email_message .= '<center>';
                $email_message .= '<img src="http://186.147.34.63/images/home/logo.png" />';
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
                $email_message .= "<b>Enlace:  </b><a href='http://186.147.34.63/login/activate.php?tk=$tkn'> Activar mi cuenta </a> <BR>";
                $email_message .= '</td>';
                $email_message .= '</tr>';
                $email_message .= '</tbody>';
                $email_message .= '</table>';
                $email_message .= '</div>';
                
                sendMail($to,$from,$subject,$email_message);
                
                $code = user_created;
                $response = array();
                SendResponse($code,$response,false);
                    
                }
            }
        }
    $response = array();
    SendResponse($code,$response,false);         
}

function ResendActivationEmail($auth,$r){
    $code = response_ok;
    
    $nombre = $r->nombre;
    $correo = $r->correo;
    
    $cmd = "select token from tokens where correo='$correo' and uso='R' and estado='A'";
    $token = getRowSQL($cmd);

    if ($token != null) {
        $to = $correo;
        $from = "reservas@anapoimanatura.com";
        $subject = "Activa tu cuenta en Natura - anapoimanatura.com";
        
        $email_message = '<div style="max-width:600px; min-width:450px; margin: 10px auto;">';
        $email_message .= '<center>';
        $email_message .= '<img src="http://186.147.34.63/images/home/logo.png" />';
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
        $email_message .= "<b>Enlace:  </b><a href='http://186.147.34.63/login/activate.php?tk=$token[0]'> Activar mi cuenta </a> <BR>";
        $email_message .= '</td>';
        $email_message .= '</tr>';
        $email_message .= '</tbody>';
        $email_message .= '</table>';
        $email_message .= '</div>';
        
        $code = sendMail($to,$from,$subject,$email_message);
        
        $response = array();
        SendResponse($code,$response,false);    
    } else{
        $code = access_forbidden;
        $response = array();
        SendResponse($code,$response,false);
    }
}

function activateUser($auth,$r){
    $token = $r->token;
    
    $cmd = "select tokenid, correo from tokens where token='$token' and uso='R' and estado='A'";
    $sel = getRowSQL($cmd);

    if ($sel != null) {
        $correo = $sel[1];
        $tokenid = $sel[0];
        
        $cmd = "select crreo from clntes where crreo='$correo' and fuente='R' and estdo_cln='P'";
        $sel = getRowSQL($cmd);
        
        if ($sel != null) {
            $cmd = "UPDATE clntes SET estdo_cln='A' WHERE crreo='$correo'";
            $code = executeSQL($cmd);
            if ($code === response_ok){
                $cmd = "UPDATE tokens SET estado='I' WHERE tokenid=$tokenid";
                $code = executeSQL($cmd);    
                $response = array();
                SendResponse($code,$response);
            } else {
                $response = array();
                SendResponse($code,$response);
            }
        } else {
            $code = user_already_active;
            $response = array();
            SendResponse($code,$response);
        }
    } else {
        $code = token_invalid;
        $response = array();
        SendResponse($code,$response);
    }
}


function getUsers_a($auth,$r){
    
	$sql  = "SELECT c.id_cln as id_cln,c.crreo as correo,c.nmbre as nombre,c.fcha_ncmnto as nacimiento,c.tlfno as telefono,";
    $sql .= "c.ncnldad as pais,c.cdad as ciudad,c.fcha_ingrso as creacion,c.estdo_cln as estado,c.fuente as fuente,";
    $sql .= "r.rol as rol, SUBSTRING(b.ultimaReserva FROM 1 FOR 10) as ultimaReserva FROM clntes c "; 
    $sql .= "join rol_clntes r on (r.id_cln = c.id_cln) ";
    $sql .= "left outer join (select c_email, max(created) ultimaReserva ";
    $sql .= "from bk_hotel_booking_bookings book ";
    $sql .= "where status = 'confirmed' group by 1) b on (c.crreo = b.c_email)";
    $users = jsonQuery($sql);
    
    $response = array("users" => $users);
    SendResponse(response_ok,$response);
}

function delUser_a($auth,$data){
    $cmd  = "DELETE from clntes WHERE id_cln=".$data->id_cln;
    
    $code = executeSQL($cmd);
    
    $response = array();
    SendResponse($code,$response);
}

function newUser_a($auth,$data){
    $cmd = "Select id_cln, fuente, estdo_cln FROM clntes where crreo='".$data->correo."'";
    $rslt = jsonQuery($cmd);
    $code = user_conflict;
    if (empty($rslt)){
        ///////lo de arriba apra agregar validacion de si el usuario existe
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
        
        $code = executeSQL($cmd);
        if ($code === response_ok){
            $clave2 = $data->c2;
            $clave1 = $data->c1;
            $correo = $data->correo;
            $cmd = "INSERT INTO scrty (id_cln, pass) select id_cln, '$clave2' from clntes where crreo='$correo' and estdo_cln in ('P','A')";
            $code = executeSQL($cmd);
            
            if ($code === response_ok){
                
                $nombre = $data->nombre;
                $tkn = sha1(date("Y-m-d H:i:s"));
                $fechaCreacion = date("Y-m-d");
                $fechaCierre = '2099-12-31';
                $uso = "R";
                /////////////////////////////////
                $cmd = "INSERT INTO tokens (tokenid, token, fecha_creacion, fecha_cierre, uso, correo)
                        VALUES (NULL, '$tkn', '$fechaCreacion', '$fechaCierre', '$uso', '$correo')";
                $code = executeSQL($cmd);
            
                if ($code === response_ok) {
                    $to = $correo;
                    $from = "reservas@anapoimanatura.com";
                    $subject = "Activa tu cuenta en Natura - anapoimanatura.com";
                    
                    $email_message = '<div style="max-width:600px; min-width:450px; margin: 10px auto;">';
                    $email_message .= '<center>';
                    $email_message .= '<img src="http://186.147.34.63/images/home/logo.png" />';
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
                    $email_message .= "<b>Enlace:  </b><a href='http://186.147.34.63/login/activate.php?tk=$tkn'> Activar mi cuenta </a> <BR>";
                    $email_message .= "<br>Te hemos asignado esta contraseña para iniciar sesion:<BR>";
                    $email_message .= "<BR>";
                    $email_message .= "<b>Contraseña:  </b>$clave1 <BR>";
                    $email_message .= '</td>';
                    $email_message .= '</tr>';
                    $email_message .= '</tbody>';
                    $email_message .= '</table>';
                    $email_message .= '</div>';
                    
                    sendMail($to,$from,$subject,$email_message);
                    
                    $code = user_created;
                    $response = array();
                    SendResponse($code,$response);
                        
                }
            }
        }
    }
    
    $response = array();
    SendResponse($code,$response);
}

function updUser_a($auth,$data){
    $id_cln = $data->id_cln;
    $c1 = $data->c1;
    $c2 = $data->c2;
    $estado = $data->estado;
    $fuente = $data->fuente;
    $correo = $data->correo;
    
    $cmd = "select * from scrty where id_cln = $id_cln";
    $rslt = jsonQuery($cmd);
    if (empty($rslt) && $fuente=='R' && $estado=='A') $estado = 'P';
    
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
    
    $code = executeSQL($cmd);
    if ($code === response_ok){
        $cmd  = "UPDATE rol_clntes SET ";
        $cmd .= "rol=".$data->rol." ";
        $cmd .= "WHERE id_cln=".$data->id_cln;
        
        $code = executeSQL($cmd);
        
        if($code === response_ok && empty($rslt) && $fuente=='R' && $estado=='P'){
            $cmd = "INSERT INTO scrty (id_cln, pass) select id_cln, '$c2' from clntes where crreo='$correo' and estdo_cln in ('P')";
            $code = executeSQL($cmd);
            
            if ($code === response_ok){
                
                $nombre = $data->nombre;
                $tkn = sha1(date("Y-m-d H:i:s"));
                $fechaCreacion = date("Y-m-d");
                $fechaCierre = '2099-12-31';
                $uso = "R";
                /////////////////////////////////
                $cmd = "INSERT INTO tokens (tokenid, token, fecha_creacion, fecha_cierre, uso, correo)
                        VALUES (NULL, '$tkn', '$fechaCreacion', '$fechaCierre', '$uso', '$correo')";
                $code = executeSQL($cmd);
            
                if ($code === response_ok) {
                    $to = $correo;
                    $from = "reservas@anapoimanatura.com";
                    $subject = "Activa tu cuenta en Natura - anapoimanatura.com";
                    
                    $email_message = '<div style="max-width:600px; min-width:450px; margin: 10px auto;">';
                    $email_message .= '<center>';
                    $email_message .= '<img src="http://186.147.34.63/images/home/logo.png" />';
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
                    $email_message .= "<b>Enlace:  </b><a href='http://186.147.34.63/login/activate.php?tk=$tkn'> Activar mi cuenta </a> <BR>";
                    $email_message .= "<br>Te hemos asignado esta contraseña para iniciar sesion:<BR>";
                    $email_message .= "<BR>";
                    $email_message .= "<b>Contraseña:  </b>$c1 <BR>";
                    $email_message .= '</td>';
                    $email_message .= '</tr>';
                    $email_message .= '</tbody>';
                    $email_message .= '</table>';
                    $email_message .= '</div>';
                    
                    sendMail($to,$from,$subject,$email_message);
                    
                    $response = array();
                    SendResponse($code,$response);
                        
                }
            }
        }
    }
            
    $response = array();
    SendResponse($code,$response);
}

function getUsersPromos_a($auth,$r){
    
	$sql  = "SELECT id_cln,crreo as correo,nmbre as nombre FROM clntes WHERE estdo_cln = 'A' and fuente='R'";
    $users = jsonQuery($sql);
    
    $response = array("users" => $users);
    SendResponse(response_ok,$response);
}

function getPromos_a($auth,$r){
    
	$sql  = "SELECT p.*, estdo as estado, asgn as tipo FROM promocodes p";
    $promos = jsonQuery($sql);
    
    $response = array("promos" => $promos);
    SendResponse(response_ok,$response);
}

function getPromo_Users_a($auth,$r){
    
    
	$sql  = "SELECT DISTINCT id_cln, crreo as correo, nmbre as nombre FROM clntes c ";
    $sql .= "JOIN assignm a ON (c.id_cln = a.id_user) ";
    $sql .= "WHERE estdo_cln = 'A' and fuente='R' AND id_code = '".$r->cdgo ."'";
    $users = jsonQuery($sql);
    
    
    
    $response = array("users" => $users);
    SendResponse(response_ok,$response);
    
}

function newPromo_a($auth,$r){
    $dscr = $r->dscr;
    $asgn = $r->asgn;
    $dscn = $r->dscn;
    $fmin = $r->fmin;
    $fmax = $r->fmax;
    $list = $r->clnt;
     
    $sql = "SELECT max(ID) FROM promocodes";
	$res = getRowSQL($sql);
	$l = $asgn[0];
	if ($asgn == "Masivo") $l = "T";
	
    $cdgo = "COD-".$l.(intval($res[0])+1);
	   
    $cmd = "INSERT INTO promocodes (cdgo, dscr, asgn, dscn, fmin, fmax)
        VALUES ('$cdgo','$dscr','$asgn',$dscn,'$fmin','$fmax')";
    
    $code = executeSQL($cmd);
    if ($code === response_ok) {
        foreach ($list as $clnt){
            $cmd = "INSERT INTO assignm (id_code, id_user) VALUES ('" . $cdgo . "'," . $clnt->id_cln . ")";
            $code = executeSQL($cmd);
        }       
    }
    $response = array();
    SendResponse($code,$response);
        
        
}

function updPromo_a($auth,$r){
    
    $cdgo = $r->cdgo;
    $fmin = $r->fmin;
    $fmax = $r->fmax;
    $dscr = $r->descrip;
    $asgn = $r->tipo;
    $estd = $r->estado;
    $dscn = $r->descuento;
    $list = $r->lista;
     
    $cmd = "UPDATE promocodes SET dscr = '$dscr', asgn = '$asgn', dscn = $dscn, 
            fmin = '$fmin', fmax = '$fmax', estdo = $estd WHERE cdgo = '$cdgo'";
    
    $code = executeSQL($cmd);
    if ($code === response_ok) {
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
    SendResponse($code,$response);
   
}

function delPromo_a($auth,$r){
    
    $cdgo = $r->id_code;
     
    $cmd = "DELETE FROM promocodes WHERE cdgo = '$cdgo'";
    
    $code = executeSQL($cmd);
    
    if ($code === response_ok) {
        $cmd = "DELETE FROM assignm WHERE id_code = '$cdgo'";
        $code = executeSQL($cmd);
    }            
    
    $response = array();
    SendResponse($code,$response);
   
}

function modifClntes_a($auth,$data){
    $clntes = $data->id_cln;
    $c_1 = $data->c1;
    $c_2 = $data->c2;
    $estado = $data->estado;
    
    $code = response_ok;
    foreach ($clntes as $i => $id_cln){
        $cmd = "select * from scrty where id_cln = $id_cln";
        $rslt = jsonQuery($cmd);
        
        $sql  = "SELECT fuente,crreo as correo,nmbre as nombre FROM clntes WHERE id_cln=$id_cln";
        $u = jsonQuery($sql);
        $fuente = $u[0]['fuente'];
        $nombre = $u[0]['nombre'];
        $correo = $u[0]['correo'];
        $c1 = $c_1[$i];
        $c2 = $c_2[$i];
        if (empty($rslt) && $fuente=='R' && $estado=='A') $estado = 'P'; 
        
        if ($estado == 'I'){
            $cmd  = "UPDATE clntes SET ";
            $cmd .= "estdo_cln='".$estado."' ";
            $cmd .= "WHERE id_cln=".$id_cln;
            $code += executeSQL($cmd);
        } else {
            $cmd  = "UPDATE clntes SET ";
            $cmd .= "estdo_cln='".$estado."' ";
            $cmd .= "WHERE id_cln=".$id_cln;
            $cmd .= " AND fuente='R'";
            $code += executeSQL($cmd);
        }
        
        if($code === response_ok && empty($rslt) && $fuente=='R' && $estado=='P'){
            $cmd = "INSERT INTO scrty (id_cln, pass) VALUES ($id_cln, '$c2')";
            $code += executeSQL($cmd);
            
            if ($code === response_ok){
                
                $tkn = sha1(date("Y-m-d H:i:s"));
                $fechaCreacion = date("Y-m-d");
                $fechaCierre = '2099-12-31';
                $uso = "R";
                /////////////////////////////////
                $cmd = "INSERT INTO tokens (tokenid, token, fecha_creacion, fecha_cierre, uso, correo)
                        VALUES (NULL, '$tkn', '$fechaCreacion', '$fechaCierre', '$uso', '$correo')";
                $code += executeSQL($cmd);
            
                if ($code === response_ok) {
                    $to = $correo;
                    $from = "reservas@anapoimanatura.com";
                    $subject = "Activa tu cuenta en Natura - anapoimanatura.com";
                    
                    $email_message = '<div style="max-width:600px; min-width:450px; margin: 10px auto;">';
                    $email_message .= '<center>';
                    $email_message .= '<img src="http://186.147.34.63/images/home/logo.png" />';
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
                    $email_message .= "<b>Enlace:  </b><a href='http://186.147.34.63/login/activate.php?tk=$tkn'> Activar mi cuenta </a> <BR>";
                    $email_message .= "<br>Te hemos asignado esta contraseña para iniciar sesion:<BR>";
                    $email_message .= "<BR>";
                    $email_message .= "<b>Contraseña:  </b>$c1 <BR>";
                    $email_message .= '</td>';
                    $email_message .= '</tr>';
                    $email_message .= '</tbody>';
                    $email_message .= '</table>';
                    $email_message .= '</div>';
                    
                    sendMail($to,$from,$subject,$email_message);
                        
                }
            }
        }
    }
    $response = array();
    SendResponse($code,$response);
    
}

function delClntes_a($auth,$data){
    $clntes = $data->id_cln;
    
    $code = response_ok;
    foreach ($clntes as $id_cln){
        $cmd  = "DELETE from clntes WHERE id_cln=".$id_cln;
        $code += executeSQL($cmd);
    }
    $response = array();
    SendResponse($code,$response);
}


?>