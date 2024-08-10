<?php
require_once "pdo.php";  //it includes information required to connect to database
session_start();
$salt = 'ip@II';   //random string used for hashing
if (isset($_POST['name']) && isset($_POST['mailid']) && isset($_POST['pass'])) {
  if (strlen($_POST['name']) < 1 || strlen($_POST['mailid']) < 1 || strlen($_POST['pass']) < 1) {
    $_SESSION["error"] = "Please fill all the fields";
  } else if (!strpos($_POST['mailid'], '@') ) {    //as maild must have a @ sign
    $_SESSION["error"] = "Email must have an at-sign (@)";
  } else {
    unset($_SESSION["mailid"]);          //logsout from the previous account if not logged out
    $hashpass = hash('md5', $salt . $_POST['pass']);  //hash function is used to hash the password for security purposes
    $stmt = mysqli_prepare($conn,'INSERT INTO Users(name,mailid,password) VALUES (?,?,?)');  //inserting data into database
    mysqli_stmt_bind_param($stmt, 'sss', $_POST['name'], $_POST['mailid'], $hashpass);
mysqli_stmt_execute($stmt);
    echo " <script>
    alert('Registration Successful');
    window.location.href='profile.php';
    </script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Register Yourself</title>
  <link rel="stylesheet" type="text/css" href="register.css">
 

</head>

<body>
  <div class="white">
    <div class="left">
      <img src="images/registerlogo.png" alt="registerlogo">
    </div>
    <div class="right">
      <h2>User Registration</h2>
      <?php
      if (isset($_SESSION["error"])) {
        echo ('<p style="color:red">' . $_SESSION["error"] . "</p>\n");
        unset($_SESSION["error"]);
      }
      ?>
      <form method="post">
        <input type="text" name="name" required class="placeicon" placeholder=" Username"><br />
        <input type="email" name="mailid"  class="placeicon" placeholder=" Email Id"><br />
        <input type="password" name="pass" required class="placeicon" placeholder=" Password"><br />
        <button type="submit">Register</button>
      </form>
    </div>
  </div>

</body>

</html>