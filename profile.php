<?php
require_once "pdo.php";   //it includes information required to connect to database
session_start();
if (isset($_SESSION['name']) && !isset($_SESSION['mailid'])) {  //since for admin we only ask name when he logins in
  header('location:adminlogged.php');
  return;
}
if (isset($_SESSION['mailid']) && isset($_SESSION['name'])) {  //user enters both name and mailid  to register so it will be stored in session 
  header('location:logged.php');
  return;
} else {
  $salt = 'ip@II';    //random string used for hashing
  if (isset($_POST['mailid']) && isset($_POST['pass'])) {
    $sql = 'SELECT * FROM users WHERE mailid ="' . $_POST['mailid'] . '"';  //query to fetch data containing the mail id that is entered
    $stmt = mysqli_query($conn,$sql);
    $hashpass = hash('md5', $salt . $_POST['pass']);  //hash function is used to hash the password for security purposes
    if ($row = mysqli_fetch_assoc($stmt)) {   //fetching data from database
      if ($hashpass == $row['password']) {    //checking if entered data and data stored in database match to give access
        $_SESSION["mailid"] = $_POST["mailid"];
        $_SESSION["name"] = $row["name"];
        header('location:index.php');
        return;
      } else {
        $_SESSION["error"] = "Incorrect Password";
      }
    } else {
      $_SESSION["error"] = "Account doesn't exist";
    }
  }
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>My Profile</title>
  <link rel="stylesheet" type="text/css" href="profile.css">
 
</head>

<body>
  <div class="white">
    <div class="left">
      <img src="images/loginlogo.png" alt="loginlogo"></br></br>
      <a href="admin.php">Admin? Click here</a>
    </div>
    <div class="right">
      <h2>User Login</h2>
      <?php
      if (isset($_SESSION["error"])) {
        echo ('<p style="color:red">' . $_SESSION["error"] . "</p>\n");
        unset($_SESSION["error"]);
      }
      ?>
      <form method="post">
        <input type="email" name="mailid" required class="placeicon" placeholder=" Email Id"><br />
        <input type="password" name="pass" required class="placeicon" placeholder="Password"><br />
        <button type="submit">Login</button>

      </form>
      <div class="register">
        <a href="register.php">New User?Click here to register!</a>
      </div>
    </div>
  </div>

</body>

</html>