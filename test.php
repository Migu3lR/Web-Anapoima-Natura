<?php

function barber($type)
{
    echo "You wanted a $type haircut, no problem\n";
}
$f = 'barbe';
if(is_callable($f)) call_user_func_array($f, ["mushroom"]);
else echo "error";


?>