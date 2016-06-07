<?php
$er = 0;
define('db_isdown', 521);
define('db_unknown_error', 520);
define('user_conflict', 409);
define('bad_insert_request', 400);
define('user_not_found', 404);
define('user_created', 201);
define('user_accepted', 202);
define('user_unauthorized', 401);

if (!defined("HB_HOST")) define("HB_HOST", "localhost");
if (!defined("HB_USER")) define("HB_USER", "hbzzadmin");
if (!defined("HB_PASS")) define("HB_PASS", "C@c6w217DS");
if (!defined("HB_DB")) define("HB_DB", "naturabase");

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
	$er = 0;
    //generamos la consulta
    mysqli_set_charset($conexion, "utf8"); //formato de datos utf8
	$result = mysqli_query($conexion, $sql);
	
    if(!$result) return false;
	return mysqli_fetch_row($result);
	
}

function getArraySQL($sql){
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8"); //formato de datos utf8
    if(!$result = mysqli_query($conexion, $sql)) $er = db_unknown_error;
    $rawdata = array(); //creamos un array
	$i=0;
 
    while($row = mysqli_fetch_array($result))
    {
        $rawdata[$i] = $row;
        $i++;
    }
 
    mysqli_close($conexion); //desconectamos la base de datos
    return $rawdata; //devolvemos el array
}

function unauth(){
    header("HTTP/1.1 403 Unauthorized");
    exit;
}

switch($_SERVER['REQUEST_METHOD'])
{
case 'GET': 
    unauth();
    break;
case 'POST':
    //include 'multiThreads.php';
    require_once('JWT.php');
    
    //$r = multiRequest($_POST);
    //print_r($r);
    new_request(json_decode(file_get_contents("php://input"))); 
    break;
}

function new_request($r){
    switch ($r->action){
        case "login":
            authUser($r);
        break;
        case "barra":
            echo "i es una barra";
        break;
        case "pastel":
            echo "i es un pastel";
        break;
        default: unauth(); break;
    }    
}

function authUser($r){
    $sql = connectDB();
    
    $er = 0;
    
    $cant = 0;
    $cmd = "Select id_cln, nmbre, aplldo, tlfno, crreo, ncnldad, cdad  FROM clntes where crreo='".$r->correo."'";
    $user = getRowSQL($cmd);
    $cmd = "Select rol FROM rol_clntes where id_cln=".$user[0];
    $rol = getRowSQL($cmd);
    if($user == null or $rol == null ) $er = user_not_found;
    else{	 

    $cmd = "Select pass FROM scrty where id_cln=".intval($user[0]); 
    $pass = getRowSQL($cmd);
    if ($pass){

        if ($r->clave == $pass[0]){
            //ha hecho login
                $er = user_accepted;
            
                $id = $user[1];
                $nombre = $user[1].' '.$user[2];
                $email = $user[4].'';
                $rol = $rol[0];
                
                $user = new stdClass;
				$user->iat = time();
				$user->exp = time() + (3600*24);
                $user->id = intval($id);
                $user->name = $nombre;
                $user->email = $email;
                $user->rol = intval($rol);
				$jwt = JWT::encode($user, 'N4tur4S4f3');
				echo json_encode(
					array(
						"code" => $er, 
						"response" => array(
							"token" => $jwt
						)
					)
				);
        } else $er = user_unauthorized;
        } 
    }
    if ($er != user_accepted){
    echo json_encode(
					array(
						"code" => $er, 
						"response" => array()
					)
				);
    }
    mysqli_close($sql);
    
}




?>
