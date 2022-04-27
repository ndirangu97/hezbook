<?php


$query=false;
$data=false;
$data["s"]=1;
$data["i"]=$DATA_OBJECT->id;


$query="UPDATE users SET online =:s WHERE userid=:i ";
$save=$DB->write($query,$data);
if ($save) {
    // echo "good";
}else {
    // echo "bad";
}
