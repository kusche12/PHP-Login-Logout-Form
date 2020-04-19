<?php
// Log in handler
if (isset($_POST['login-submit'])) { // Did you actually press the login button?
    require 'dbh.inc.php';

    $mailuid = $_POST["mailuid"]; // get this from the header.php 
    $password = $_POST['pwd'];

    if (empty($mailuid) || empty($password)) { // something is left empty
        header("Location: ../index.php?error=emptyfields");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?;";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) { // These values do not work in the database
            header("Location: ../index.php?error=sqlerror");
            exit();
        } else {

            mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid); // two strings. One for username, one for password
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt); // result now equals all the results that we got from the database

            if ($row = mysqli_fetch_assoc($result)) {
                $pwdCheck = password_verify($password, $row['pwdUsers']); 

                if ($pwdCheck == false) { // user should not be logged into the website (pwdCheck should either be 0 or 1)
                    header("Location: ../index.php?error=wrongpwd");
                    exit();
                } else if ($pwdCheck == true) { 
                    
                    session_start(); // check if user is logged in already
                    $_SESSION['userId'] = $row['idUsers'];
                    $_SESSION['userUid'] = $row['uidUsers'];
                    header("Location: ../index.php?login=success");
                    exit();
                    

                } else { // unexpected variable for $pwdCheck
                    header("Location: ../index.php?error=wrongpwd");
                    exit();
                }

            } else {
                header("Location: ../index.php?error=nouser"); // No user in the db that matches the username or email
                exit();
            }

        }
    }

} else {
    header("Location: ../index.php");
    exit();
}