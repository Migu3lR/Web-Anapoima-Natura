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


function sendMail($correo,$nombre,$token){
    $email_to = $correo;
    $email_from = "reservas@anapoimanatura.com";
    $email_subject = "Nueva Reserva - anapoimanatura.com";
    
    $email_message = '<div style="max-width:600px; min-width:450px; margin: 10px auto;">';
    $email_message .= '<h1 style="margin-left:-40px;">';
    $email_message .= '<img src="http://anapoimanatura.com/img/logo.png" />';
    $email_message .= '</h1>';
    $email_message .= '<table style="width:100%; border-collapse:collapse; border-spacing:0; font:15px/1.5em Helvetica,Arial,sans-serif; color:#5D4C37; border:1px solid #ccc; box-shadow:0 0 1px #ccc;">';
    $email_message .= '<tbody>';
    $email_message .= '<tr style="border-bottom: 1px solid #eee;">';
    $email_message .= '<th style="max-width:30%; vertical-align:top; padding:8px; text-align:left;">';
    $email_message .= "<b>Gracias por visitar Natura, te invitamos a darnos tu opinion sobre nosotros!</b>";
    $email_message .= '</th>';
    $email_message .= '<td style="max-width:30%; vertical-align:top; padding:8px; text-align:left;">';
    $email_message .= "Utiliza el siguiente enlace, para acceder a la pagina de comentarios de Natura:<BR>";
    $email_message .= "<BR>";
    $email_message .= "<b>Enlace:  </b><a href='http://anapoimanatura.com/comentarios/'> COMENTAR </a> <BR>";
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

function nuevoTokenComentarios($correo, $nombre){
    $sql = connectDB();
    mysqli_query($sql,"SET NAMES utf8");
    $er = 0;
    
    $token = date("Y-m-d H:i:s");
    $fechaCreacion = date("Y-m-d");
    $fechaCierre = date("Y-m-d",strtotime("+1 Months"));
    $uso = "C";
    
    $cmd = "INSERT INTO token (tokenid, token, fecha_creacion, fecha_cierre, uso, correo)
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


?>