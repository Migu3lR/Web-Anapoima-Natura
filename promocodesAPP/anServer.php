<?php
function connectDB(){
 //$sql = mysqli_connect('localhost', 'root', '', 'natura');
 $sql = mysqli_connect('localhost', 'hbzzadmin', 'C@c6w217DS', 'naturabase');
 if(!$sql){
  die("Connection failed: " . mysqli_connect_error());
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

function getArraySQL($sql){
    //Creamos la conexión con la función anterior
    $conexion = connectDB();
 
    //generamos la consulta
 
        mysqli_set_charset($conexion, "utf8"); //formato de datos utf8
 
    if(!$result = mysqli_query($conexion, $sql)) die("Error: " . mysqli_error($sql)); //si la conexión cancelar programa
	
	//if(!$c = mysqli_query($conexion, "SELECT count(*) FROM (" . $sql . ")")) die("Error: " . mysqli_error($sql)); //si la conexión cancelar programa

    $rawdata = array(); //creamos un array
 
    //guardamos en un array multidimensional todos los datos de la consulta
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

if(isset($_POST['gnrr'])){
  generarCodigo($_POST['cdgo'],$_POST['dscr'],$_POST['asgn'],$_POST['dscn'],$_POST['fmin'],$_POST['fmax']);
}
if(isset($_POST['editar'])){
  editarCodigo($_POST['id'],$_POST['cdgo'],$_POST['dscr'],$_POST['asgn'],$_POST['dscn'],$_POST['fmin'],$_POST['fmax']);
}
if(isset($_POST['aprb'])){
  aprobarCodigo($_POST['aprobar']);
  //echo print_r($_POST['aprobar']),true); 
}

?>