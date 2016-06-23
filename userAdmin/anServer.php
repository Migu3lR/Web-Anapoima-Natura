<?php

define('db_isdown', 521);
define('db_unknown_error', 520);
define('user_conflict', 409);
define('bad_insert_request', 400);
define('user_not_found', 404);
define('user_created', 201);
define('user_accepted', 202);
define('user_unauthorized', 401);
define('error_send_mail', 501);

function connectDB(){
    $sql = mysqli_connect('localhost', 'hbzzadmin', 'C@c6w217DS', 'naturabase');
    if(!$sql){
	    $er = db_isdown;
	    echo json_encode('{"resp":'. $er .'}');
    }
    return $sql;
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

function getUsers(){
    
	$sql  = "SELECT c.*, r.rol, SUBSTRING(b.ultimaReserva FROM 1 FOR 10) ultimaReserva FROM clntes c "; 
    $sql .= "join rol_clntes r on (r.id_cln = c.id_cln) ";
    $sql .= "left outer join (select c_email, max(created) ultimaReserva ";
    $sql .= "from bk_hotel_booking_bookings book ";
    $sql .= "where status = 'confirmed' group by 1) b on (c.crreo = b.c_email)";
    
	$users = getArraySQL($sql);
    
	$outp = "";
	foreach ($users as $user){
		if ($outp != "") {$outp .= ",";}
		$outp .= '{"id_cln":' . $user["id_cln"] . ',';
        $outp .= '"correo":"' . $user["crreo"] . '",';
		$outp .= '"nombre":"' . $user["nmbre"] . '",';
		$outp .= '"nacimiento":"' . $user["fcha_ncmnto"] . '",';
		$outp .= '"tipo_cedula":"' . $user["tpo_numdoc"] . '",';
		$outp .= '"cedula":"' . $user["id_numdoc"] . '",';
		$outp .= '"telefono":"' . $user["tlfno"] . '",';
		$outp .= '"pais":"' . $user["ncnldad"] . '",';
		$outp .= '"ciudad":"' . $user["cdad"] . '",';
        $outp .= '"creacion":"' . $user["fcha_ingrso"] . '",';
        $outp .= '"ultimaReserva":"' . $user["ultimaReserva"] . '",';
        $outp .= '"estado":"' . $user["estdo_cln"] . '",';
        $outp .= '"fuente":"' . $user["fuente"] . '",';
		$outp .= '"rol":'. $user["rol"] . '}'; 
	}
	$outp ='{"resp":['.$outp.']}';
return $outp;
}

function updUser($data){
    $sql = connectDB();
    mysqli_query($sql,"SET NAMES utf8");
    $er = 0;
    
    $cmd  = "UPDATE clntes SET ";
    $cmd .= "nmbre='".$data->nombre."', ";
    $cmd .= "fcha_ncmnto='".$data->nacimiento."', ";
    if ($data->telefono != "") $cmd .= "tlfno=".$data->telefono.", ";
    else $cmd .= "tlfno=0, ";
    $cmd .= "ncnldad='".$data->pais."', ";
    $cmd .= "cdad='".$data->ciudad."', ";
    $cmd .= "estdo_cln='".$data->estado."', ";
    $cmd .= "fuente='".$data->fuente."' ";
    $cmd .= "WHERE id_cln=".$data->id_cln;
    
    if (!mysqli_query($sql, $cmd)) $er = bad_insert_request;
    else {
        $cmd  = "UPDATE rol_clntes SET ";
        $cmd .= "rol=".$data->rol." ";
        $cmd .= "WHERE id_cln=".$data->id_cln;
        if (!mysqli_query($sql, $cmd)) $er = bad_insert_request;
    }
    echo json_encode('{"resp":'. $er .'}');
    
    mysqli_close($sql); 
}

function newUser($data){
    $sql = connectDB();
    mysqli_query($sql,"SET NAMES utf8");
    $er = 0;
    
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
    
    if (!mysqli_query($sql, $cmd)) $er = bad_insert_request;
    
    echo json_encode('{"resp":'. $er .'}');
    
    mysqli_close($sql); 
}


function delUser($data){
    $sql = connectDB();
    mysqli_query($sql,"SET NAMES utf8");
    $er = 0;
    
    $cmd  = "DELETE from clntes WHERE id_cln=".$data->id_cln;
    
    if (!mysqli_query($sql, $cmd)) $er = bad_insert_request;
    
    echo json_encode('{"resp":'. $er .'}');
    
    mysqli_close($sql); 
}

?>