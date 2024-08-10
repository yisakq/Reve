<?php
require_once "header.php";

if (isset($_POST['Add_to_Cart'])) {
    if (isset($_SESSION['cart'])) {
        $cartitems = array_column($_SESSION['cart'], 'item_name');
        if (in_array($_POST['item_name'], $cartitems)) {
            echo "
              <script>
                alert('Item Already Added');
                window.location.href = 'product.php?category=" . $_GET['category'] . "';
              </script>";
        } else {
            $count = count($_SESSION['cart']);
            $_SESSION['cart'][$count] = array('item_name' => $_POST['item_name'], 'cost' => $_POST['cost'], 'Quantity' => 1);
            echo "
              <script>
                alert('Item Added');
                window.location.href = 'product.php?category=" . $_GET['category'] . "';
              </script>";
        }
    } else {
        $_SESSION['cart'][0] = array('item_name' => $_POST['item_name'], 'cost' => $_POST['cost'], 'Quantity' => 1);
        echo "
          <script>
            alert('Item Added');
            window.location.href = 'product.php?category=" . $_GET['category'] . "';
          </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo ucfirst($_GET['category']); ?> Section</title>
    <link rel="stylesheet" href="categories.css">
</head>

<body>
    
    <div class="page-content">
        <?php
        $category = $_GET['category'];
        
        $stmt =mysqli_prepare($conn,"SELECT * FROM stock WHERE item LIKE ? OR product_name LIKE ? OR category LIKE ?");
        mysqli_stmt_bind_param($stmt,"sss",$category,$category,$category);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $count = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $count++;
            echo '<div class="shirts">';
            echo '<div class="card">';
            echo '<img src="' . $row['image'] . '" alt="...">';
            echo '<p class="highlight">' . $row['product_name'] . '</p>';
            echo '<p>' . $row['description'] . '</p>';
            echo '<p>' . $row['cost'] . "" . '</p>';
            echo '<form method="POST" ">';
            echo '<input type="hidden" name="item_name" value="' . $row['product_name'] . '">';
            echo '<input type="hidden" name="cost" value="' . $row['cost'] . '">';
            echo '<button type="submit" class="button" name="Add_to_Cart">Add to Cart</button>';
            echo '</form>';
            echo '</div>';
            echo '</div>';
        }

        if ($count == 0) {
            echo '<h2>No items found in the ' . $_GET['category'] . ' category.</h2>';
        }
        ?>
    </div>
</body>

<footer>
    <h2>Thank you for choosing us.Hope you have a wonderful shopping session!</h2>
</footer>
</html>
