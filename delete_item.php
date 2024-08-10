<?php
require_once "pdo.php";  //it includes information required to connect to database
session_start();

if (isset($_POST['delete']) && isset($_POST['item_id'])) {  
    $stmt =mysqli_prepare($conn,"DELETE FROM stock WHERE item_id =?");
    mysqli_stmt_bind_param($stmt, 'i',$_POST['item_id']);
    mysqli_stmt_execute($stmt);
    echo " <script>
    alert('Item Deleted');
    window.location.href='delete.php';
    </script>";
}

// Make sure that user_id is present
if (!isset($_GET['item_id'])) {
    echo " <script>
    alert('Missing Item ID');
    window.location.href='delete.php';
    </script>";
}

$stmt =mysqli_prepare($conn,"SELECT * FROM stock where item_id =?"); 
mysqli_stmt_bind_param($stmt, 'i',$_GET['item_id']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);  

if ($row === false) {
    $_SESSION['error'] = 'Bad value for item_id';
    header('Location: delete.php');
    return;
}

if (isset($_POST['cancel'])) {
    header('location:delete.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Deletion</title>
    <style>
        body {
            background: url("images/login.jpg");
        }

        .middle {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #fff;
            padding: 30px;
            height: 150px;
        }

        .middle .button {
            width: 160px;
            height: 40px;
            border-radius: 20px;
            padding: 5px;
            background-color: red;
            color: #ffffff;
            outline: none;
            margin-left: 25px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="main">
        <div class="middle">
            <h1>Confirm: Deleting <?= htmlentities($row['product_name']) ?></h1>
            <form method="post">
                <input type="hidden" name="item_id" value="<?= $row['item_id'] ?>"><br>
                <input class="button" type="submit" value="Delete" name="delete">
                <button class="button" type="submit" name="cancel">Cancel</button>
            </form>
        </div>
    </div>
</body>

</html>