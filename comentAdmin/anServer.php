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

function sendMail($correo,$nombre,$token){
    $email_to = $correo;
    $email_from = "reservas@anapoimanatura.com";
    $email_subject = "Nueva Reserva - anapoimanatura.com";
    
    $email_message = '<div style="max-width:600px; min-width:450px; margin: 10px auto;">';
    $email_message .= '<center>';
    $email_message .= '<img src="http://anapoimanatura.com/img/logo.png" />';
    $email_message .= '</center>';
    $email_message .= '<table style="width:100%; border-collapse:collapse; border-spacing:0; font:15px/1.5em Helvetica,Arial,sans-serif; color:#5D4C37; border:1px solid #ccc; box-shadow:0 0 1px #ccc;">';
    $email_message .= '<tbody>';
    $email_message .= '<tr style="border-bottom: 1px solid #eee;">';
    $email_message .= '<th style="max-width:30%; vertical-align:top; padding:8px; text-align:left;">';
    $email_message .= "<b>Hola $nombre, <br>Gracias por visitarnos en Natura, te invitamos a darnos tu opinion sobre nosotros!</b>";
    $email_message .= '</th>';
    $email_message .= '<td style="max-width:30%; vertical-align:top; padding:8px; text-align:left;">';
    $email_message .= "Utiliza el siguiente enlace, para acceder a la pagina de comentarios de Natura:<BR>";
    $email_message .= "<BR>";
    $email_message .= "<b>Enlace:  </b><a href='http://anapoimanatura.com/produccion/comentarios/comentar.php?tk=$token'> COMENTAR </a> <BR>";
    $email_message .= '</td>';
    $email_message .= '</tr>';
    $email_message .= '</tbody>';
    $email_message .= '</table>';
    $email_message .= '</div>';
    
    $headers = "From: $email_from\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    $result = mail($email_to, $email_subject, $email_message, $headers);
    
    if ($result) echo json_encode('{"resp":0}');
    else echo json_encode('{"resp":'.error_send_mail.'}');
    
    return $result;
}

function nuevoTokenComentarios($nombre, $correo){
    $sql = connectDB();
    mysqli_query($sql,"SET NAMES utf8");
    $er = 0;
    
    $token = sha1(date("Y-m-d H:i:s"));
    
    $fechaCreacion = date("Y-m-d");
    $fechaCierre = date("Y-m-d",strtotime("+1 Months"));
    $uso = "C";
    
    $cmd = "INSERT INTO tokens (tokenid, token, fecha_creacion, fecha_cierre, uso, correo)
            VALUES (NULL, '$token', '$fechaCreacion', '$fechaCierre', '$uso', '$correo')";
    if (!mysqli_query($sql, $cmd)) {
        $er = bad_insert_request;
        echo json_encode('{"resp":'. $er .'}');
    }
    else {
        sendMail($correo,$nombre,$token);
    }
    
    mysqli_close($sql); 
}

function getProm(){
    $sql = "SELECT sum(rate)/count(*) as prom FROM comentarios ";
    $sql .= "where rate > 0 ";
    $sql .= "and estado= 'A'";
        
	$resp = getArraySQL($sql);
    $prom = isset($resp[0]['prom']) ? $resp[0]['prom'] : 0; 
    
    echo json_encode('{"resp":'. $prom .'}');
}

function getCmts(){
	$sql = "SELECT * FROM comentarios";
	$posts = getArraySQL($sql);

	$outp = "";
	foreach ($posts as $post){
		if ($outp != "") {$outp .= ",";}
		$outp .= '{"nombre":"' . $post["nombre"] . '",';
		$outp .= '"correo":"' . $post["correo"] . '",';
		$outp .= '"mensaje":"' . $post["Mensaje"] . '",';
		$outp .= '"fecha":"' . $post["fecha"] . '",';
		$outp .= '"id":' . $post["ID"] . ',';
		$outp .= '"id_cln":"' . $post["id_cln"] . '",';
		$outp .= '"estado":"' . $post["estado"] . '",';
		$outp .= '"publicar":"' . $post["publicar"] . '",';
		$outp .= '"tokenid":"' . $post["tokenid"] . '",';
		$outp .= '"rate":'. $post["rate"] . '}'; 
	}
	$outp ='{"resp":['.$outp.']}';
return $outp;
}

function updComent($id,$estado,$publicar){
    $sql = connectDB();
    mysqli_query($sql,"SET NAMES utf8");
    $er = 0;
    
    $cmd = "UPDATE comentarios SET estado='".$estado."', publicar='".$publicar."' WHERE ID=".$id;
    
    if (!mysqli_query($sql, $cmd)) $er = bad_insert_request;
    
    echo json_encode('{"resp":'. $er .'}');
    
    mysqli_close($sql); 
}


?>