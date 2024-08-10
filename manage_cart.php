<?php require_once "header.php";    //all the contents of header.php file are added here

if (isset($_POST['remove_item'])) {
    foreach ($_SESSION['cart'] as $key =>  $value) {
        if ($value['item_name'] == $_POST['item_name']) {
            unset($_SESSION['cart'][$key]);                     //removes the item from cart
            $_SESSION['cart'] = array_values($_SESSION['cart']);
            echo "
            <script>
            alert('Item Removed')
            window.location.href='cart.php'
            </script>";
        }
    }
}
