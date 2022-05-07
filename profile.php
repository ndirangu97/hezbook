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
  <title>Profile</title>
  <link rel="stylesheet" href="./home.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>

<body>
  <div class="topbarContainer">
    <div class="topbarLeft">
      <span class="logo">Lamasocial</span>
    </div>
    <div class="topbarCenter">
      <div class="searchbar">
        <Search class="searchIcon" />
        <input placeholder="Search for friend, post or video" class="searchInput" />
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
      <img src="./assets/person/1.jpeg" alt="" class="topbarImg" />
    </div>
  </div>
  <div class="profile">
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
        <div style="display: flex;justify-content:center"><?php echo ($results->firstname) . 's  ';  ?>Friends</div>
        <ul id="sidebarFriendList">
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
    <div class="profileRight">
      <div class="profileRightTop" style="position:relative">
        <div class="profileCover">
          <img class="profileCoverImg" src="assets/post/3.jpeg" alt="" />
          <img class="profileUserImg" src="assets/person/7.jpeg" alt="" />
        </div>
        <div class="profileInfo">
          <h4 class="profileInfoName"><?php echo ($results->firstname);
                                      echo ' ';
                                      echo ($results->lastname)  ?></h4>
          <span class="profileInfoDesc">Hello my friends!</span>

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
          }
          $ui = $_GET["id"];
          if (in_array($ui, $ra)) {
            echo "<p class='sndReq'>Friends </p>";
          } else {
            echo "<p class='sndReq' id='fnd' onclick='addFriend()'>Add Friend</p>";
          }




          ?>


        </div>
      </div>
      <div class="profileRightBottom">
        <div class="feed">
          <div class="feedWrapper">
            <div class="share">
              <div class="shareWrapper">
                <div class="shareTop">
                  <img class="shareProfileImg" src="./assets/person/1.jpeg" alt="" />
                  <input placeholder="Write something to  <?php echo ($results->firstname)  ?>" class=" shareInput" />
                </div>
                <hr class="shareHr" />
                <div class="shareBottom">
                  <div class="shareOptions">
                    <div class="shareOption">
                      <PermMedia htmlColor="tomato" class="shareIcon" />
                      <span class="shareOptionText">Photo or Video</span>
                    </div>
                    <div class="shareOption">
                      <label htmlColor="blue" class="shareIcon" />
                      <span class="shareOptionText">Tag</span>
                    </div>
                    <div class="shareOption">
                      <Room htmlColor="green" class="shareIcon" />
                      <span class="shareOptionText">Location</span>
                    </div>
                    <div class="shareOption">
                      <EmojiEmotions htmlColor="goldenrod" class="shareIcon" />
                      <span class="shareOptionText">Feelings</span>
                    </div>
                  </div>
                  <button class="shareButton">Share</button>
                </div>
              </div>
            </div>

            <div class="post">
              <div class="postWrapper">
                <div class="postTop">
                  <div class="postTopLeft">
                    <img class="postProfileImg" src="assets/person/1.jpeg" />
                    <span class="postUsername"> Hezron Ndirangu </span>
                    <span class="postDate">27 JAn 2020</span>
                  </div>
                  <div class="postTopRight">
                    <!-- <MoreVert /> -->
                    hello
                  </div>
                </div>
                <div class="postCenter">
                  <span class="postText">Love for all,Hatred for none</span>
                  <img class="postImg" src="assets/post/3.jpeg" alt="" />
                </div>
                <div class="postBottom">
                  <div class="postBottomLeft">
                    <img class="likeIcon" src="assets/like.png" onClick="{likeHandler}" alt="" />
                    <img class="likeIcon" src="assets/heart.png" onClick="{likeHandler}" alt="" />
                    <span class="postLikeCounter">54 people like it</span>
                  </div>
                  <div class="postBottomRight">
                    <span class="postCommentText">9 comments</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="rightbar">
          <div class="rightbarWrapper">
            <h4 class="rightbarTitle">User information</h4>
            <div class="rightbarInfo">
              <div class="rightbarInfoItem">
                <span class="rightbarInfoKey">City:</span>
                <span class="rightbarInfoValue">New York</span>
              </div>
              <div class="rightbarInfoItem">
                <span class="rightbarInfoKey">From:</span>
                <span class="rightbarInfoValue">Madrid</span>
              </div>
              <div class="rightbarInfoItem">
                <span class="rightbarInfoKey">Relationship:</span>
                <span class="rightbarInfoValue">Single</span>
              </div>
            </div>
            <h4 class="rightbarTitle"><?php echo ($results->firstname) . "'s"  ?> photos</h4>
            <div class="rightbarFollowings">
              <?php

              $sql = false;
              $data = false;

              $data["me"] = $_GET["id"];
              $sql = "SELECT * FROM posts WHERE sender=:me and profile!=null";
              $resultsp = $DB->read($sql, $data);

              if (is_array($resultsp)) {
                foreach ($resultsp as $row2) {
                  echo "
                    <a href='profile.php?id=$row2->userid' style='text-decoration:none;color:inherit'>
                        <div class='rightbarFollowing'>
                        <img src='$row2->profile'  class='rightbarFollowingImg' />
                       
                      </div>
                    </a>     
                          ";
                }
              } else {
                echo "
                $results->firstname hasn't posted any photos yet
                    
                      ";
              }




              ?>
            </div>
          </div>
        </div>
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
  
  
  const p = url.replace("http%3A%2F%2Flocalhost%2Fhezbook%2Fprofile.php%3Fid=", "");
  localStorage.setItem("idp", p);
  const id = localStorage.getItem("idp");
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
    alert(results);

    let data = JSON.parse(results);
    switch (data.type) {
      case 'name':
        let mdl = document.getElementById("searchModal");
        mdl.style.display = "block";

        mdl.innerHTML = data.message;

        break;

    }
  }


  const ownid = localStorage.getItem("id");
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




  const addFriend = () => {

    sendData({
      reciever: p
    }, "friend")

    let f=document.getElementById('fnd')
    f.innerHTML="Request Sent"
  }
</script>