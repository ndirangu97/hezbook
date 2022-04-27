<?php
require_once "./connection.php";
$DB = new Database();
$fname = $lname = $email = $password = $password2 =$gender ="";
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
  $fname = ucfirst(test_input($_POST["fname"]));
  $email = test_input($_POST["email"]);
  $lname = ucfirst(test_input($_POST["lname"]));
  $gender =ucfirst( test_input($_POST["gender"]));
  if ($password == $password2) {
    $password = test_input($_POST["password"]);
  } else {
    echo "err";
  }


  $id = $DB->generateuserid(60);

  $query = false;
  $data = false;

  $fa=array();
  $fs=base64_encode(serialize($fa));


  $data["fname"] = $fname;
  $data["lname"] = $lname;
  $data["email"] = $email;
  $data["password"] = $password;
  $data["gender"] = $gender;
  $data["f"] = $fs;
  $data["userid"] = $DB->generateuserid(60);
  if ($gender=="Male") {
    $data["profile"] = "./assets/user_male.jpg";
    
  }else {
    $data["profile"] = "./assets/user_female.jpg";
  }

  $query = "INSERT INTO users(firstname,lastname,email,password,userid,gender,profile,friends) VALUES(:fname,:lname,:email,:password,:userid,:gender,:profile,:f)";
  $save = $DB->write($query, $data);
  if ($save) {
    header("location:login.php");
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
  <title>Register</title>
  <link rel="stylesheet" href="./register.css">
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
            <input type="text" placeholder="Firtsname" name="fname" class="loginInput" minlength="3" maxlength="10" required />
            <input type="text" placeholder="Lastname" name="lname" class="loginInput" minlength="3" maxlength="10" required />
            <input type="email" placeholder="Email" name="email" class="loginInput" required />
            <div style="display: flex;align-items:center;flex-direction:column"><div><b>Gender</b> </div> 
              <div style="margin-bottom: 16px;">
                <input type="radio" id="male" name="gender" value="Male">
                <label for="male">Male</label><br>
                <input type="radio" id="female" name="gender" value="Female">
                <label for="female">Female</label><br>
              </div>
            </div>
            <input type="text" placeholder="Password" class="loginInput" name="password" minlength="6" required />
            <input type="text" placeholder="Password Again" class="loginInput" name="password2" minlength="6" required />
            <input type="submit" class="loginButton" value="Sign Up"></input>
            <button class="loginRegisterButton">
              Log into Account
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>