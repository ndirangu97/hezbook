<?php
session_start();
require_once "./connection.php";

$DATA_RAW = file_get_contents('php://input');
$DATA_OBJECT = json_decode($DATA_RAW);

$info = (object)[];

$DB=new Database();
// print_r($DATA_OBJECT);



$username =""; $password = "";
$Err="";

if (isset($DATA_OBJECT->type) && $DATA_OBJECT->type == "name") {
  include "./includes/name.php";

}
elseif (isset($DATA_OBJECT->type) && $DATA_OBJECT->type == "online") {
  include "./includes/online.php";

  
}
elseif (isset($DATA_OBJECT->type) && $DATA_OBJECT->type == "offline") {
	include "./includes/offline.php";
	
	
  }
elseif (isset($DATA_OBJECT->type) && $DATA_OBJECT->type == "request") {
	include "./includes/request.php";
	
  }
  elseif (isset($DATA_OBJECT->type) && $DATA_OBJECT->type == "comment") {
	include "./includes/comments.php";
	
	
  }
  

elseif (isset($DATA_OBJECT->type) && $DATA_OBJECT->type == "post") {
 

    print_r($DATA_OBJECT);
}
elseif (isset($DATA_OBJECT->type) && $DATA_OBJECT->type == "friend") {

    include "./includes/friend.php";
}
elseif (isset($DATA_OBJECT->type) && $DATA_OBJECT->type == "accept") {

    include "./includes/accept.php";
}




  
// function test_input($data) {
//     $data = trim($data);
//     $data = stripslashes($data);
//     $data = htmlspecialchars($data);
//     return $data;
//   }

  function generateuserid()
	{

		$rand = "";
		$randCount = rand(4,60);
		for ($i=0; $i < $randCount; $i++) { 
			
			$r = rand(0,9);
			$rand .= $r;
		}

		return $rand;
	}
	//generates messageid
function generateMessageId()
{

	$array = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
	$rand = rand(4, 60);
	$r = '';
	for ($i = 0; $i <= $rand; $i++) {
		$random = rand(0, 61);
		$r .= $array[$random];
	}
	return $r;
}


?>





