<?php
require_once "pdo.php"; 
session_start();
if (isset($_SESSION['name'])) {
if (isset($_SESSION['cart'])) {  //checks if items are present in cart
    $count = count($_SESSION['cart']); //returns the no.of items in cart
    $_SESSION['count'] = $count;
    $stmt =mysqli_prepare($conn,'INSERT INTO purchase (username,total_items,total_amount) VALUES (?,?,?)');  //inserting data into database
    mysqli_stmt_bind_param($stmt, 'sii', $_SESSION['name'], $_SESSION['count'],$_SESSION['total'] );
    mysqli_stmt_execute($stmt);
    unset($_SESSION['cart']);  //clears the cart once data is stored in database
    //pop-up message
    echo " <script>
    alert('Thank you for shopping with us');
    window.location.href='index.php';
    </script>";
} else {
    //pop-up message
    echo " <script>
    alert('Your cart is empty');
    window.location.href='cart.php';
    </script>";
}
}
else{
    echo " <script>
    alert('sign in first');
    window.location.href='cart.php';
    </script>";
}