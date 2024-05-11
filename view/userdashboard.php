<?php
include_once('../models/accounttypemodel.php');
include_once('../control/accounttypecontroller.php');
include_once('../control/usercontroller.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        .links {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .links a {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            text-decoration: none;
            color: #333;
            background-color: #f0f0f0;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .links a:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
<div class="container">
        <h1>Dashboard</h1>

        <div class="links">
        <?php
            // Display the determined links if $links is set
            if(isset($links) && is_array($links)) {
                foreach ($links as $link) {
                    echo $link;
                }
            } else {
                echo "No links available.";
            }
            ?>
        </div>
    </div>
</body>
</html>
