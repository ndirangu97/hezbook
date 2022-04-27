<?php


require_once './connection.php';
require_once "./routes.php";

$DB = new Database();

$info = (object)[];
$err = "";

// print_r($_FILES);

print_r($_POST);
// die;

if ($_POST['post'] == "" && $_FILES == null) {
    $info->message = 'You write something or choose profile photo';
    $info->dataType = 'posts';
    echo json_encode($info);
} elseif ($_POST['post'] == "" && $_FILES != null) {
    if ($_FILES['file']['name'] != "" && $_FILES['file']['error'] == 0) {

        $folder = './uploads/';
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        $destination = $folder . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $destination);

                
                
                $image=$destination;
                
                
                $sql = false;
                $data = false;
      
                $data["me"] = $_POST["id"];
                $sql = "SELECT * FROM users WHERE userid=:me LIMIT 1";
                $results = $DB->read($sql, $data);
      
                if (is_array($results)) {
                  $results = $results[0];
                  $r = $results->friends;
                  $ra = unserialize(base64_decode($r));
                  $query = false;
                    $data = false;
                    $data["pi"] = generateMessageId();
      
                  foreach ($ra as $key) {
      
                    
      
                    $data["s"] = $_SESSION["userid"];
                    $data["r"] = $key;
                    
                    $data["f"] = $destination;
                    $query = "INSERT INTO posts(postid,sender,reciever,profile) VALUES(:pi,:s,:r,:f) ";
                    $writef = $DB->write($query, $data);
                    if ($writef) {
                     echo "reeer";
                    }else {
                        echo 6;
                    }
                  }
                }
      
      
      
                


    }
} elseif ($_POST['post'] != "" && $_FILES != null) {
    
    if ($_FILES['file']['name'] != "" && $_FILES['file']['error'] == 0) {

        $folder = './uploads/';
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        $destination = $folder . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $destination);

                
                
                $image=$destination;
                
                
                $sql = false;
                $data = false;
      
                $data["me"] = $_POST["id"];
                $sql = "SELECT * FROM users WHERE userid=:me LIMIT 1";
                $results = $DB->read($sql, $data);
      
                if (is_array($results)) {
                  $results = $results[0];
                  $r = $results->friends;
                  $ra = unserialize(base64_decode($r));
                  $query = false;
                    $data = false;

                    $data["pi"] = generateMessageId();
      
                  foreach ($ra as $key) {
      
                    
      
                    $data["s"] = $_SESSION["userid"];
                    $data["r"] = $key;
                    $data["ts"] =$_POST['post'];
                    
                    $data["f"] = $destination;
                    $query = "INSERT INTO posts(postid,sender,reciever,status,profile) VALUES(:pi,:s,:r,:ts,:f)  ";
                    $writef = $DB->write($query, $data);
                    if ($writef) {
                     echo "reeer";
                    }else {
                        echo 6;
                    }
                  }
                }
      
      
      
                


    }
}elseif ($_POST['post'] != "" && $_FILES == null) {
    
            
            $sql = false;
            $data = false;
  
                
                $data["me"] = $_SESSION["userid"];
            $sql = "SELECT * FROM users WHERE userid=:me LIMIT 1";
            $results = $DB->read($sql, $data);
  
            if (is_array($results)) {
              $results = $results[0];
              $r = $results->friends;
              $ra = unserialize(base64_decode($r));
              $query = false;
                $data = false;

                $data["pi"] = generateMessageId();
  
              foreach ($ra as $key) {
  
                
  
                $data["s"] = $_SESSION["userid"];
                $data["r"] = $key;
                $data["ts"] =$_POST['post'];
                
               
                $query = "INSERT INTO posts(postid,sender,reciever,status) VALUES(:pi,:s,:r,:ts)  ";
                $writef = $DB->write($query, $data);
                if ($writef) {
                 echo "reeer";
                }else {
                    echo 6;
                }
              }
            }

}
