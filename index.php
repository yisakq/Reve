<?php
require_once "pdo.php";  //it includes information required to connect to database
require "header.php";   //all the contents of header.php file are added here
if (isset($_POST['send'])) {
  if (isset($_POST['email']) && isset($_POST['message'])) {
    $stmt =mysqli_prepare($conn,'INSERT INTO feedback (email,message) VALUES (?,?)');  //inserting data into database
     mysqli_stmt_bind_param($stmt, 'ss', $_POST['email'], $_POST['message']);
     mysqli_stmt_execute($stmt);
    echo " <script>
    alert('Thank you for your Feedback');
    window.location.href='index.php';
    </script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Rêve</title>
  <link rel="icon" type="image/png" href="images/logo.png" />
  <link rel="stylesheet" type="text/css" href="index.css">
 
</head>

<div class="big_image">
  <img src="images/bigpic.jpg">
</div>
<h2 class="middle">Categories</h2>
<div class="categories">
  <div class="first">
    <div>
      <a href="product.php?category=men">
        <p>Men</p>
      </a>
    </div>
  </div>
  <div class="second">
  <div>
    <a href="product.php?category=women">
      <p>Women</p>
    </a>
  </div>
</div>

<div class="third">
  <div>
    <a href="product.php?category=kids">
      <p>Kids</p>
    </a>
  </div>
</div>
</div>

<br>
<h2 class="middle">Products</h2>
<div class="products">
<div class="fourth">
  <div>
    <a href="product.php?category=shirt">
      <p>Shirts</p>
    </a>
  </div>
</div>

<div class="fifth">
  <div>
    <a href="product.php?category=jeans">
      <p>Jeans and trousers</p>
    </a>
  </div>
</div>
<div class="sixth">
  <div>
    <a href="product.php?category=top">
      <p>Tops</p>
    </a>
  </div>
</div>

<div class="seventh">
    <div>
    <a href="product.php?category=leggings">
      <p>Leggings</p>
    </a>
    </div>
  </div>
  <div class="eighth">
    <div>
    <a href="product.php?category=ethnic_wear">
      <p>Ethnic Wear</p>
    </a>
    </div>
  </div>
</div>

<footer>
  <div class="main">
    <div class="left">
      <h2>About us</h2>
      <p>This is a shopping website where you can shop for a variety of clothing for all men,women and children.</p>
      <div class="social">
        <ul>
          <li><a href="https://www.facebook.com" target="_blank"><i class=""></i></a></li>
          <li><a href="https://twitter.com" target="_blank"><i class=""></i></a></li>
          <li><a href="https://www.instagram.com" target="_blank"><i class=""></i></a></li>
        </ul>
      </div>
    </div>
    <div class="mid">
      <h2>Address</h2>
      <ul>
        <li><i class=""></i><span class="text">BAHIR DAR,Ethiopia</span></li>
        <div class="phone">
          <li><i class=""></i><span class="text">+251928069345</span></li>
        </div>
        <li><i class=""></i><span class="text">ip@gmail.com</span></li>
      </ul>
    </div>
    <div class="right">
      <h2>Contact us</h2>
      <form method="POST">
        <div class="txt"><span>Email:</span></div>
        <input type="email" name="email" required /><br>
        <div class="msg"><span>Message:</span></div>
        <input type="textarea" name="message" required /><br><br>
        <button class="btn" type="submit" name="send">Send</button>
      </form>
    </div>
  </div>
  <p class="copyright">
    <span ></span>2023 All rights reserved.
  </p>
</footer>

</html>