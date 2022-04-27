<?php

require_once "./connection.php";
require_once "./routes.php";
$DB = new Database();
$email = $password  ="";

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
//   echo "<pre>";
// print_r($_POST);
// echo "<pre>";
 
  $email = test_input($_POST["email"]);
  
  $password = test_input($_POST["password"]);
  


  $id = $DB->generateuserid(60);

  $sql = false;
  $data = false;

  $data["email"] = $email;
  
  

  $sql = "SELECT * FROM users WHERE email=:email LIMIT 1";
  $results = $DB->read($sql, $data);
  
  if (is_array($results)) {
    $results=$results[0];
    if ($results->password== $password) {
      $_SESSION["userid"]=$results->userid;
      header("location:home.php?id=$results->userid");
    }else {
      echo "error";
    }

  } else {
    echo "bad";
  }
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./login.css">
</head>
<body>
    
    <div class="login">
        <div class="loginWrapper">
          <div class="loginLeft">
            <h3 class="loginLogo">HezBook</h3>
            <span class="loginDesc">
              Connect with friends and the world around you on Lamasocial.
            </span>
          </div>
          <div class="loginRight">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="loginBox">
              <input type="email" placeholder="Email" name="email" class="loginInput" required />
              <input type="password" placeholder="Password" name="password" class="loginInput"  minlength="6" required />
            
              <input type="submit" class="loginButton" value="Login"></input>
              <span class="loginForgot">Forgot Password?</span>
              <button class="loginRegisterButton">
                Create a New Account
              </button>
            </div>
            </form>
          </div>
        </div>
      </div>
</body>
</html>