<?php

$name=$DATA_OBJECT->name;
$id=$_SESSION["userid"];


$sql=false;
$mess="";

$sql="SELECT * FROM users WHERE (firstname LIKE '%$name%' ||lastname LIKE '%$name%') and userid!= $id";
$results=$DB->read($sql,[]);
if (is_array($results)) {
    foreach ($results as $row) {
        $mess.="
        <a href='profile.php?id=$row->userid'>
        <div class='schCnt'>
      <img src='./assets/person/1.jpeg' class='topbarImg' style='margin-left: 20px;' alt=''>
      <p style='margin-left: 90px;'>$row->firstname     $row->lastname</p>
    </div>
    </a>
        ";
    }
   
    
}else {
    $mess.="No result";
}
$info->message =$mess;
$info->type = "name";
echo json_encode($info);

