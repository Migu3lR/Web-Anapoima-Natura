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
 //$sql = mysqli_connect('localhost', 'hbzzadmin', 'C@c6w217DS', 'naturabase');
 $sql = mysqli_connect('localhost', 'root', '', 'natura');
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
	mysqli_query($conexion,"SET NAMES utf8");
	$result = mysqli_query($conexion, $sql);
	
    if(!$result) $er = db_unknown_error;
	if ($er == 0) return mysqli_fetch_row($result);
	else return false;
}

function getArraySQL($sql){
    $conexion = connectDB();
    mysqli_set_charset($conexion, "utf8"); //formato de datos utf8
	mysqli_query($conexion,"SET NAMES utf8");
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

function nuevoPost($nombre, $email, $mensaje, $rate){
$sql = connectDB();
mysqli_query($sql,"SET NAMES utf8");
$er = 0;
$cmd = "INSERT INTO comentarios (ID, id_cln, nombre, correo, mensaje, rate)
		VALUES (NULL, NULL, '" . $nombre . "','" . $email . "','" . $mensaje . "',".$rate.")";
 if (!mysqli_query($sql, $cmd)) $er = bad_insert_request;
   
 echo json_encode('{"resp":'. $er .'}');
 mysqli_close($sql);
}

function jsonPost(){
	$sql = "SELECT * FROM comentarios order by fecha desc";
	$posts = getArraySQL($sql);

	$outp = "";
	foreach ($posts as $post){
		if ($outp != "") {$outp .= ",";}
		$outp .= '{"nombre":"' . $post["nombre"] . '",';
		$outp .= '"correo":"' . $post["correo"] . '",';
		$outp .= '"mensaje":"' . $post["Mensaje"] . '",';
		$outp .= '"fecha":"' . $post["fecha"] . '",';
		$outp .= '"rate":'. $post["rate"] . '}'; 
	}
	$outp ='{"records":['.$outp.']}';
return $outp;
}

?>