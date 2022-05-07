<?php


require_once './connection.php';
require_once "./routes.php";

$DB = new Database();

$info = (object)[];
$err = "";
$mess="";
// print_r($_FILES);



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

                

                  if (count($ra)!=0) {
                    
                   
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
                      $info->message =$mess;
                      $info->type = "post";
                      echo json_encode($info);
                      
                    }else {
                        echo 6;
                    }
                  }  
                  }else {
                   
                    $data=false;
                    $query=false;
                    $data["s"] = $_SESSION["userid"];
                    $data["pi"] = generateMessageId();
                    
                    $data["f"] = $destination;
                    $query = "INSERT INTO posts(postid,sender,profile) VALUES(:pi,:s,:f) ";
                    $writef = $DB->write($query, $data);
                    if ($writef) {
                      $info->message =$mess;
                      $info->type = "post";
                      echo json_encode($info);
                      
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
                    if (count($ra)!=0) {
                      
                      foreach ($ra as $key) {
          
                        
          
                        $data["s"] = $_SESSION["userid"];
                        $data["r"] = $key;
                        $data["ts"] =$_POST['post'];
                        
                        $data["f"] = $destination;
                        $query = "INSERT INTO posts(postid,sender,reciever,status,profile) VALUES(:pi,:s,:r,:ts,:f)  ";
                        $writef = $DB->write($query, $data);
                        if ($writef) {


                          $info->message =$mess;
                          $info->type = "post";
                          echo json_encode($info);
                        }
                      }
                      
                    } else {
                      
                      $data["s"] = $_SESSION["userid"];
                       
                        $data["ts"] =$_POST['post'];
                        
                        $data["f"] = $destination;
                        $query = "INSERT INTO posts(postid,sender,status,profile) VALUES(:pi,:s,:ts,:f)  ";
                        $writef = $DB->write($query, $data);
                        if ($writef) {
                          $info->message =$mess;
                          $info->type = "post";
                          echo json_encode($info);
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
                if (count($ra)!=0) {
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

                }else{
                  $data["s"] = $_SESSION["userid"];
                  
                  $data["ts"] =$_POST['post'];
                  
                 
                  $query = "INSERT INTO posts(postid,sender,status) VALUES(:pi,:s,:ts)  ";
                  $writef = $DB->write($query, $data);
                  if ($writef) {
                          $info->message =$mess;
                          $info->type = "post";
                          echo json_encode($info);
                  }else {
                      echo 6;
                  }


                }
  
              
            }

}
