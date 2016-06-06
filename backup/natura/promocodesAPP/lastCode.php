<?php
include 'anServer.php';
$sql = "SELECT max(ID) FROM `promocodes`";
	$code = getArraySQL($sql);
	
	foreach ($code as $c){
		echo "'".($c[0]+1)."'";
		//return '{"last":'.$cod.',"error":0}';
	}

?>