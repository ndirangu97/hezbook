<?php


$sql=false;
$data=false;

$data["me"]=$_SESSION["userid"];
$data["k"]=0;
$mess="";

$sql="SELECT * FROM requests WHERE reciever=:me and status= :k";
$results=$DB->read($sql,$data);
if (is_array($results)) {
    foreach ($results as $row) {
        
        $mess.="
        <li class='sidebarRequest' >
        <div style='display: flex;align-items:center'>
          <img class='sidebarFriendImg' src='assets/person/1.jpeg'  />
          <p class='sidebarFriendName'>Hezron Ndirangu</p>
        </div>
        <div>
          <button id='$row->sender' onclick='acceptRequest(event)'>Accept </button>
          <button  id='$row->sender' onclick='rejectRequest(event)'>Reject </button>
        </div>
      </li>
        ";
    }
   
    
}else {
    $mess.="No result";
}
$info->message =$mess;
$info->type = "request";
echo json_encode($info);
