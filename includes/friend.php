<?php

$query=false;
$data=false;
$data["sender"]=$_SESSION["userid"];
$data["reciever"]=$DATA_OBJECT->reciever;

$query="INSERT INTO requests(sender,reciever) VALUES(:sender,:reciever)";
$save=$DB->write($query,$data);
if ($save) {
    echo "good";
}else {
    echo "bad";
}



