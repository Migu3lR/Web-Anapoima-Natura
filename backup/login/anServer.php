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

function connectDB(){
 $sql = mysqli_connect('localhost', 'hbzzadmin', 'C@c6w217DS', 'naturabase');
 if(!$sql){
	$er = db_isdown;
	echo json_encode('{"resp":'. $er .'}');
 }
 return $sql;
}

function generarCodigo($cdgo, $dscr, $asgn, $dscn, $fmin, $fmax, $list){
 $sql = connectDB();
 $er = 0;
 $cmd = "INSERT INTO promocodes (cdgo, dscr, asgn, dscn, fmin, fmax)
        VALUES ('" . $cdgo . "','" . $dscr . "','" . $asgn . "'," . (int)$dscn . ",'" . $fmin . "','" . $fmax . "')";
 if (!mysqli_query($sql, $cmd)) {
	$er++;
 } else {
	 foreach ($list as $clnt){
		$cmd = "INSERT INTO assignm (id_code, id_user)
			VALUES ('" . $cdgo . "'," . $clnt->ID . ")";
		if (!mysqli_query($sql, $cmd)) $er++;
	 }
 }
 echo json_encode('{"error":'. $er .'}');
 mysqli_close($sql);
}

function aprobarCodigo($cdgo){
 $sql = connectDB();
 $cmd = "UPDATE promocodes SET estdo=1 WHERE ID = ".$cdgo;
 if (!mysqli_query($sql, $cmd)) return false;
 else return true;
 mysqli_close($sql);
}

function getRowSQL($sql){
	$conexion = connectDB();
	$er = 0;
    //generamos la consulta
    mysqli_set_charset($conexion, "utf8"); //formato de datos utf8
	$result = mysqli_query($conexion, $sql);
	
    if(!$result) $er = db_unknown_error;
	if ($er == 0) return mysqli_fetch_row($result);
	else return false;
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

function jsonUsers(){
	$sql = "SELECT * FROM `users`";
	$users = getArraySQL($sql);

	$outp = "";
	foreach ($users as $user){
		if ($outp != "") {$outp .= ",";}
		$outp .= '{"ID":"'  . $user["ID"] . '",';
		$outp .= '"cdla":"'   . $user["cdla"]        . '",';
		$outp .= '"nmbre":"'. $user["nmbre"]     . '"}'; 
	}
	$outp ='{"records":['.$outp.']}';
return $outp;
}

function jsonCodes($sql){
	$codes = getArraySQL($sql);

	$outp = "";
	foreach ($codes as $code){
		if ($outp != "") {$outp .= ",";}
		$outp .= '{"ID":"'  . $code["ID"] . '",';
		$outp .= '"cdgo":"'   . $code["cdgo"]        . '",';
		$outp .= '"dscr":"'   . $code["dscr"]        . '",';
		$outp .= '"asgn":"'   . $code["asgn"]        . '",';
		$outp .= '"dscn":"'   . $code["dscn"]        . '",';
		$outp .= '"fmin":"'   . $code["fmin"]        . '",';
		$outp .= '"fmax":"'. $code["fmax"]     . '"}'; 
	}
	$outp ='{"records":['.$outp.']}';
return $outp;
}

function jsonList($sql){
	
	$clnts = getArraySQL($sql);
	$outp = "";
	foreach ($clnts as $clnt){
		$sql="SELECT * from `users` where ID = " . $clnt["id_user"];
		$client = getArraySQL($sql);
		foreach ($client as $cliente){
			if ($outp != "") {$outp .= ",";}
			$outp .= '{"ID":"'  . $cliente["ID"] . '",';
			$outp .= '"cdla":"'   . $cliente["cdla"]        . '",';
			$outp .= '"nmbre":"'. $cliente["nmbre"]     . '"}'; 
		}
	}
	
	$outp ='{"records":['.$outp.']}';
return $outp;
}

function nuevoCodigo($asgn){
	$sql = "SELECT max(ID) FROM `promocodes`";
	$code = getArraySQL($sql);
	$l = $asgn[0];
	if ($asgn == "Masivo") $l = "T";
	foreach ($code as $c){
		return "COD-".$l.($c[0]+1);
	}	
}

function editarCodigo($id, $cdgo, $dscr, $asgn, $dscn, $fmin, $fmax, $list){
 $sql = connectDB();
 $er = 0;
 $cmd = "UPDATE promocodes SET cdgo = '" . $cdgo . "', dscr = '" . $dscr . "', asgn = '" . $asgn . "', dscn = " . (int)$dscn . ", fmin = '" . $fmin . "', fmax = '" . $fmax . "' WHERE ID = " . $id;

 if (!mysqli_query($sql, $cmd)) {
	$er++;
 } else {
	 $cmd = "DELETE FROM assignm where id_code = '" . $cdgo . "'";
	 if (!mysqli_query($sql, $cmd)) { $er++; }
	 else {
		 foreach ($list as $clnt){
			$cmd = "INSERT INTO assignm (id_code, id_user)
				VALUES ('" . $cdgo . "'," . $clnt->ID . ")";
			if (!mysqli_query($sql, $cmd)) $er++;
		 }
	 }
 }
  echo json_encode('{"error":'. $er .'}');
 }

function nuevoUsuario($nombre, $apellido, $correo, $clave, $fecha, $telefono, $tipo, $documento, $nacionalidad, $municipio){
 $sql = connectDB();
 $er = 0;
 $cmd = "Select id_cln FROM clntes where " . "crreo='".$correo."' or (tpo_numdoc=".$tipo." and id_numdoc=".$documento.")";
 $rslt = getRowSQL($cmd);
 if (!is_null($rslt)) $er = user_conflict;
 else{
 
	$cmd = "INSERT INTO clntes (id_cln, crreo, nmbre, aplldo, fcha_ncmnto, tpo_numdoc, id_numdoc, tlfno, ncnldad,cdad)
			VALUES (NULL, '" . $correo . "','" . $nombre . "','" . $apellido . "','".$fecha."',".$tipo.",".$documento.",".$telefono.",'".$nacionalidad."','".$municipio."')";
	 if (!mysqli_query($sql, $cmd)) $er = bad_insert_request;
	 
	 if ($er == 0){
		$cmd = "Select id_cln FROM clntes where " . 
		"crreo='".$correo."' and tpo_numdoc=".$tipo." and id_numdoc=".$documento;
		$rslt = getRowSQL($cmd);
		
		if (!is_null($rslt)){
			$cmd = "INSERT INTO scrty (id_cln, pass)
				VALUES ('" . $rslt[0] . "','" . $clave . "')";
			if (!mysqli_query($sql, $cmd)) $er = bad_insert_request;
			else $er = user_created;
		}
	 }
 } 
 echo json_encode('{"resp":'. $er .'}');
 mysqli_close($sql);
}

function entrarUsuario($correo, $clave){
 $sql = connectDB();
 $er = 0;
 $cant = 0;
 $cmd = "Select id_cln, nmbre FROM clntes where crreo='".$correo."'";
 $user = getRowSQL($cmd);
 $cmd = "Select rol FROM rol_clntes where id_cln=".$user[0];
 $rol = getRowSQL($cmd);
 if($user == null or $rol == null ) $er = user_not_found;
 else{	 
	
	$cmd = "Select pass FROM scrty where id_cln=".intval($user[0]); 
	$pass = getRowSQL($cmd);
 if ($er == 0){
	
	if ($clave == $pass[0]){
		session_start();
		$_SESSION['nombre'] = $user[1];
		$_SESSION['rol'] = $rol[0];
		$er = user_accepted;
	} else $er = user_unauthorized;
 } 
 }
 echo json_encode('{"resp":'. $er .'}');
 mysqli_close($sql);
}

?>