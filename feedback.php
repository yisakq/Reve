<?php
require_once "pdo.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>feedback</title>
    <style>
        .chat-box {
            display: flex;
            align-items: flex-start;
        }

        .user-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .message-text {
            margin-bottom: 20px;
        }
        .anchor{
            /* margin-bottom: 20px; */
            color: brown;
            display: block;
            justify-content: center;
             padding: 0;
            color: hsl(0, 0%, 28%);
              font-size: 15px;
              font-weight: bold;
              font-family: monospace;
             letter-spacing: 1px;
            cursor: pointer;
            text-decoration: none;

        }
        .anchor:hover{
            color: aqua;
            justify-content: center;
        }
     
    </style>
</head>

<body>
    <div class="container" >
        <div class="row">
            <div class="card-header d-flex justify-content-between align-items-center p-3 bg-info text-white border-bottom-0" style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
                <h1 style="color:hsl(0, 0%, 28%); font-weight: bold;justify-content: center; ">FEEDBACK</h1>
            </div>
            <div class="col-lg-9">
                <table class="table">
                    <thead class="text-center">
                        <tbody>
                        <?php
                       
                            $query = "SELECT * FROM feedback ";
                            $result = mysqli_query($conn, $query);

                            // Check if the query was successful
                            if ($result) {
                                // Fetch all rows as an associative array
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<div class="chat-box">';
                                    echo '<img src="images/user_icon.png" class="user-icon" alt="User Icon">';
                                    echo '<div>';
                                    // echo '<p class="message-text">' . $row['message'] . '</p>';
                                    echo '<p class="p-3 ms-3" style="border-radius: 15px; background-color: rgba(57, 192, 237,.2);">' . $row['message'] . '</p>';
                                    echo '<a href="mailto:' . $row['email'] . '" class="anchor">Contact user</a>';
                                    echo '</div>';
                                    echo '</div>';
                                }

                                // Free the result set
                                mysqli_free_result($result);
                            }
                        ?>
                    </tbody>
                    
                    </thead>