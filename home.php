<?php
require_once "./connection.php";
$DB = new Database();
$sql = false;
$data = false;

$data["id"] = $_GET["id"];

$sql = "SELECT * FROM users WHERE userid=:id LIMIT 1";
$results = $DB->read($sql, $data);

if (is_array($results)) {
  $results = $results[0];
} else {
  echo "bad";
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="./home.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>

<body>
  <div id="searchModal">



  </div>
  <div class="topbarContainer">
    <div class="topbarLeft">
      <span class="logo">HezBook</span>
    </div>
    <div class="topbarCenter">
      <div class="searchbar">
        <Search class="searchIcon" />
        <input placeholder="Search for friend, post or video" oninput="getNames(this.value)" class="searchInput" />
      </div>
    </div>
    <div class="topbarRight">

      <div class="topbarLinks">
        <span class="topbarLink">Homepage</span>
        <span class="topbarLink">Timeline</span>
      </div>
      <div class="topbarIcons">
        <div class="topbarIconItem">
          <Person />
          <span class="topbarIconBadge">1</span>
        </div>
        <div class="topbarIconItem">
          <Chat />
          <span class="topbarIconBadge">2</span>
        </div>
        <div class="topbarIconItem">
          <Notifications />
          <span class="topbarIconBadge">1</span>
        </div>
      </div>
      <img src="<?php echo ($results->profile)  ?>" alt="" class="topbarImg" />
    </div>
  </div>
  <div class="homeContainer">
    <div class="sidebar">
      <div class="sidebarWrapper">
        <ul class="sidebarList">
          <li class="sidebarListItem">
            <RssFeed class="sidebarIcon" />
            <span class="sidebarListItemText">Feed</span>
          </li>
          <li class="sidebarListItem">
            <Chat class="sidebarIcon" />
            <span class="sidebarListItemText">Chats</span>
          </li>
          <li class="sidebarListItem">
            <PlayCircleFilledOutlined class="sidebarIcon" />
            <span class="sidebarListItemText">Videos</span>
          </li>
          <li class="sidebarListItem">
            <Group class="sidebarIcon" />
            <span class="sidebarListItemText">Groups</span>
          </li>
          <li class="sidebarListItem">
            <Bookmark class="sidebarIcon" />
            <span class="sidebarListItemText">Bookmarks</span>
          </li>
          <li class="sidebarListItem">
            <HelpOutline class="sidebarIcon" />
            <span class="sidebarListItemText">Questions</span>
          </li>
          <li class="sidebarListItem">
            <WorkOutline class="sidebarIcon" />
            <span class="sidebarListItemText">Jobs</span>
          </li>
          <li class="sidebarListItem">
            <Event class="sidebarIcon" />
            <span class="sidebarListItemText">Events</span>
          </li>
          <li class="sidebarListItem">
            <School class="sidebarIcon" />
            <span class="sidebarListItemText">Courses</span>
          </li>
        </ul>
        <button class="sidebarButton">Show More</button>
        <hr class="sidebarHr" />
        <div>

          <h3>Friend requests</h3>

        </div>

        <ul id="sidebarRequestList">
          <?php


          $sql = false;
          $data = false;

          $data["me"] = $_GET['id'];
          $data["k"] = 0;


          $sql = "SELECT * FROM requests WHERE reciever=:me and status= :k";
          $resultsr = $DB->read($sql, $data);
          if (is_array($resultsr)) {
            foreach ($resultsr as $row) {

              echo "
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
          } else {
            echo "No friend result currently";
          }
          // $info->message = $mess;
          // $info->type = "request";
          // echo json_encode($info);
          ?>
        </ul>
      </div>
    </div>

    <div class="feed">


      <div class="feedWrapper">
        <div style="width: 100%;height:240px;overflow-x:hidden;">
          <ul style="display:flex;height:100%">
            <li id="story" style="background: yellow;">
              ff
            </li>

            <li id="story" style="background: white;">
              ffg
            </li>
            <li id="story" style="background: white;">
              ffg
            </li>
            <li id="story" style="background: green;">
              cc
            </li>
          </ul>
        </div>
        <div class="share">

          <div class="shareWrapper">
            <div class="shareTop">
              <img class="shareProfileImg" src="<?php echo ($results->profile)  ?>" alt="" />
              <input type="text" name="desc" id="desc" placeholder="What's in your mind <?php echo ($results->firstname)  ?>" class="shareInput" />
            </div>
            <hr class="shareHr" />
            <div id="prof" style="display: none;">
              <img src="./assets/person/3.jpeg" id="profImg" style="height: 300px;width:100%;object-fit:cover;border-radius:4px" alt="">
            </div>
            <div class="shareBottom">
              <div class="shareOptions">
                <div class="shareOption" style="display: flex;justify-content:center;align-items:center">
               
                  <input style="display: none;" type="file" name="file" id="profileFile" onchange="changeProfilePic(this.files)">
                 <label for="profileFile"><img src="./assets/photo-gallery.png" style="height: 50px;width:50px;object-fit:cover"></label>
                  <p style="margin-left: 10px;">Post a Photo/Video </p>
                </div>
                
                
                
              </div>
              <input type="submit" class="shareButton" value="Share" onclick="sendProfile()"></input>
            </div>
          </div>

        </div>

        <div class="post">
          <?php
          $sql = false;
          $data = false;
          $data["me"]=$_GET["id"];


          $sql = "SELECT * FROM posts WHERE sender=:me || reciever=:me GROUP BY postid ORDER BY id DESC ";
          $resultsp = $DB->read($sql,$data);
          if (is_array($resultsp)) {
            

            foreach ($resultsp as $p) {
              $sql = false;
              $data = false;
              $data["me"]=$p->sender;
              
    
    
              $sql = "SELECT * FROM users WHERE userid=:me";
              $resultsu = $DB->read($sql,$data);
              $resultsu=$resultsu[0];
              // $date=strtotime(time());
              // $date2=strtotime($resultsu->date);

              // print_r(date_diff($date,$date2));
              $idd=$p->postid.'i';
                $if=$idd.'good';
                // $idd=$p->postid.'i';
                $idi=$idd.'v';
                $cm=$idi.'com';
                $com=$cm.'modal';
               

                
              
              echo "
              <div class='postWrapper' >
                <div class='postTop'>
                  <div class='postTopLeft'>
                    <img class='postProfileImg' src='$resultsu->profile' />
                    <span class='postUsername'> $resultsu->firstname $resultsu->lastname </span>
                    <span class='postDate'>".date("jS M  H:i a",strtotime($resultsu->date))."</span>
                  </div>
                  <div class='postTopRight'>
                    <!-- <MoreVert /> -->
                    hello
                  </div>
                </div>
                <div class='postCenter'>
                  <span class='postText'>$p->status</span>
                  <img class='postImg' src='$p->profile' />
                </div>
                <div class='postBottom' >
                  <div class='postBottomLeft'>
                    <img class='likeIcon' id='lkImg' src='assets/like.png' onClick='likeHandler()' />
                  
                    <span class='postLikeCounter'><span id='ls' >You and </span>54 people like it</span>
                  </div>
                  <div><img id='$idd' onclick='writeComment(event)' src='./assets/chat.png' style='height:20px;width:20px;cursor:pointer' /></div>
                  <div class='postBottomRight' style='cursor:pointer' id='$cm' onclick='readComments(event)'  >
                     9 comments  
                  </div>
                </div>
                <div id='$if' style='display:none'>
              

                  <input  type='text' class='$p->postid' placeholder='write a comment' />
                  <input id='$p->postid'  type='submit' value='Send' onclick='sendComment(event)' />
                  
                </div>
                <div class='$cm' style='display:none'>
                   comments
                </div>
                
            </div>
              
              ";
              
            }
          }

          ?>
        
        </div>
      </div>
    </div>
    <div class="rightbar">
      <div class="rightbarWrapper" style="display: flex;flex-direction:column;align-items:center">
        <div class="birthdayContainer">
          <img class="birthdayImg" src="assets/gift.png" alt="" />
          <span class="birthdayText">
            <b>Pola Foster</b> and <b>3 other friends</b> have a birhday
            today.
          </span>
        </div>
        <img class="rightbarAd" src="assets/ad.png" alt="" />
        <h4 class="rightbarTitle">Online Friends</h4>
        <ul id="sidebarFriendList" >
          <?php

          $sql = false;
          $data = false;

          $data["me"] = $_GET["id"];
          $sql = "SELECT * FROM users WHERE userid=:me";
          $results = $DB->read($sql, $data);

          if (is_array($results)) {
            $results = $results[0];
            $r = $results->friends;
            $ra = unserialize(base64_decode($r));

            foreach ($ra as $key) {

              $sql = false;
              $data = false;

              $data["me"] = $key;
              $sql = "SELECT * FROM users WHERE userid=:me";
              $results2 = $DB->read($sql, $data);
              if (is_array($results2)) {
                foreach ($results2 as $row2) {
                  echo "
                  <a href='profile.php?id=$row2->userid' style='text-decoration:none;color:inherit'>
                  <li id='sidebarFriend' style='width:300px;height:60px;border-radius:8px;background:rgb(231, 230, 230);padding-left:20px'>
                          <img class='sidebarFriendImg' style='margin-right:30px' src='$row2->profile' alt='' />
                          <span class='sidebarFriendName'>$row2->firstname $row2->lastname</span>
                  </li>
                        </a>     
                        ";
                }
              }
            }
          }



          ?>

        </ul>
      </div>
    </div>
  </div>
</body>

</html>
<script>
  const myform = new FormData();
  const href = window.location.href;
  // console.log(href);
  const param = new URLSearchParams(href);
  const url = param.toString();
  // console.log(param.toString());
  // const p=url.slice(52);
  const p = url.replace("http%3A%2F%2Flocalhost%2Fhezbook%2Fhome.php%3Fid=", "");
  localStorage.setItem("id", p);
  const ownid = localStorage.getItem("id");
  





  function _(element) {

    return document.getElementById(element);
  }

  const data = {};
  const sendData = (data, type) => {

    var xml = new XMLHttpRequest();

    xml.onload = function() {

      if (xml.readyState == 4 || xml.status == 200) {

        handleResult(xml.responseText);

      }
    }

    data.type = type;
    var data_string = JSON.stringify(data);

    xml.open("POST", "routes.php", true);
    xml.send(data_string);
  }
  const handleResult = (results) => {
    // alert(results);

    let data = JSON.parse(results);
    switch (data.type) {
      case 'name':
        let mdl = document.getElementById("searchModal");
        mdl.style.display = "block";

        mdl.innerHTML = data.message;

        break;
      case 'request':
        let r = document.getElementById("sidebarRequestList");
        r.innerHTML = data.message;

        mdl.innerHTML = data.message;

        break;
      case 'accept':
        sendData({}, 'request')

        break;
     

    }
  }

  const status = window.navigator.onLine;
  if (status) online()
  else offline()

  window.addEventListener('online', online)
  window.addEventListener('offline', offline)

  function online() {

    sendData({
      id: ownid
    }, 'online')
  }

  function offline() {

    sendData({
      id: ownid
    }, 'offline')
  }





  //function to change profile pic
  const changeProfilePic = (files) => {

    let previewBox = document.getElementById("profImg");
    let p = document.getElementById("prof");
    p.style.display = "block";
    previewBox.src = URL.createObjectURL(files[0]);


    const ownid = localStorage.getItem("id");

    myform.append('file', files[0]);
    myform.append('id', ownid);




  }

  const sendProfile = () => {

    let d = document.getElementById("desc");
    let des = d.value;
    if (des != "") {
      myform.append('post', des);
    } else {
      myform.append('post', "");
    }

    myform.append('type', 'post');
    

    var xml = new XMLHttpRequest();
    xml.onload = function() {
      if (xml.readyState == 4 || xml.status == 200) {
        handleFileResult(xml.responseText);
      }
    }
    xml.open('POST', 'files.php', true);
    xml.send(myform);


  }
  //func to handle file results
  const handleFileResult = (results) => {

    // alert(results);

    var f = JSON.parse(results);
    switch (f.type) {
      case 'post':
        location.reload()

        break;
    
      default:
        break;
    }

  }

  //search inputs results
  const getNames = (text) => {

    var char = text.trim()
    if (char == "") {
      let mdl = document.getElementById("searchModal");
      mdl.style.display = "none";
    } else {
      sendData({
        name: char
      }, 'name')
    }

  }
  //get friend Requests
  const getRequests = () => {
    let fr = document.getElementById("sidebarFriendList");
    fr.style.display = "none";
    let r = document.getElementById("sidebarRequestList");
    r.style.display = "flex";
    sendData({}, 'request')
  }
  //get friend Requests
  const getFriends = () => {
    let fr = document.getElementById("sidebarFriendList");
    fr.style.display = "block";
    let r = document.getElementById("sidebarRequestList");
    r.style.display = "none";
    // sendData({}, 'request')
  }
  //  acceptRequest 
  const acceptRequest = (e) => {

    let s = e.target.id;

    sendData({
      sender: s
    }, 'accept')
  }
  var  like=false;
  const likeHandler=()=>{
    let i=document.getElementById('lkImg');
    let ls=document.getElementById('ls');
    

    
    if (like==false) {
      like=true;
      i.src="./assets/heart.png";
      ls.style.display="inline ";
    }else if (like==true) {
      like=false;
      i.src="./assets/like.png";
      ls.style.display="none";
    }
    
  }

  var like2=true;
  const writeComment=(e)=>{
    const i=e.target.id
   
   var t=i.concat("good");
   
   let d= document.getElementById(t);
    
    if (like2==false) {
      like2=true;
      d.style.display="none";
      
    }else if (like2==true) {
      like2=false;
      d.style.display="block";
     
    }
    
  }
  const sendComment=(e)=>{
    let y=e.target.id;
 
    let iu= document.getElementsByClassName(y)[0];
    
    // =document.getElementById(y)
    var iv=iu.value;
  

    if (iv=="") {
      alert("no empty value")
    }else{
      sendData({
        comm:iv,
        id:y
      },"comment")
    }
  }  
  var like3=true;
  const readComments=(e)=>{
  
    let mo=document.getElementsByClassName(e.target.id)[0]
    
    mo.style.display='block'

    
    if (like3==false) {
      like3=true;
      mo.style.display="none";
      
    }else if (like3==true) {
      like3=false;
      mo.style.display="block";
     
    }
  }
</script>