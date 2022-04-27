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
                  <a href='profile.php?id=$row2->userid'>
                  <li id='sidebarFriend'>
                          <img class='sidebarFriendImg' src='assets/person/1.jpeg' alt='' />
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