<?php
$json='{"code":"COD0000","dscr":"asd","asgn":"Unico","dscn":"5","fmin":"2016-01-01T05:00:00.000Z","fmax":"2016-01-01T05:00:00.000Z","clnt":[{"ID":"1","cdla":"1","nmbre":"migue1"}]}';
$d=json_decode($json);

var_dump(json_decode($json));
var_dump(json_decode($json, true));

echo $d->clnt[0]->ID;


?>