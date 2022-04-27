<?php

$query=false;
$data=false;

$data["c"]=$DATA_OBJECT->comm;
$data["i"]=$DATA_OBJECT->id;
$data["s"]=$_SESSION['userid'];

$query="INSERT INTO postcomment(postid,sender,comment) VALUES(:i,:s,:c)";
$save=$DB->write($query,$data);
if ($save) {
    echo "good";
}else {
    echo "bad";
}