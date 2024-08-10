<?php
session_start();
if (isset($_POST['logout'])) {   //checking if logout button is pressed
  header('location:logout.php');
  return;
}
if (isset($_POST['home'])) {   //checking if home button is pressed
  header('location:index.php');
  return;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>My Profile</title>
  <link rel="stylesheet" type="text/css" href="logged.css">

</head>

<body>
  <div class="white">
    <div class="left">
      <img src="images/loginlogo.png" alt="loginlogo">
    </div>
    <div class="right">
      <h2>Welcome <?= $_SESSION["name"] ?></h2>
      <form method="post">
        <button type="submit" name="logout">Logout</button></br></br>
        <button type="submit" name="home">Home</button>
      </form>
    </div>
  </div>

</body>

</html>