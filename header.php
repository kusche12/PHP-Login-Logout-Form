<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login System</title>
    <link href="./style.css" media="screen" rel="stylesheet" type="text/css" />
</head>
<body>
    <header>
        <nav>
            <a class="logo" href = "#">
                <img src="img/KK-Logo2.png" alt="Logo">
            </a>
            <ul class="links">
                <li><a href="#">Home</a></li>
                <li><a href="#">Portfolio</a></li>
                <li><a href="#">About me</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
            <div class="forms">
                <?php 
                if (isset($_SESSION['userId'])) { // You are logged in (this is SUPER IMPORTANT for changing content based on log in vs not logged in)
                    echo '  <form action="includes/logout.inc.php" method="post">
                                <button class="btn" type="submit" name="logout-submit">Logout</button>
                            </form>';
                } else {
                    echo '  <form action="includes/login.inc.php" method="post">
                                <input class="input-info" type="text" name="mailuid" placeholder="Username/Email...">
                                <input class="input-info" type="password" name="pwd" placeholder="Password...">
                                <button class="btn" type="submit" name="login-submit">Login</button>
                            </form>
                            <a class="btn signup" href="signup.php">Signup</a>';
                }
                ?>
                
                
            </div>
        </nav>
    </header>
