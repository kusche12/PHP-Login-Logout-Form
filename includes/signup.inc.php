<?php
// Handle Signup
if(isset($_POST['signup-submit'])) {

    require 'dbh.inc.php';

    $username = $_POST['uid'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];

    // Error handlers
    if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) { // did not fill everything out
        header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email);
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) { // both below
        header("Location: ../signup.php?error=invalidmailuid");
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // email is incorrect format
        header("Location: ../signup.php?error=invalidmail&uid=".$username);
        exit();
    } else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) { // username does not match
        header("Location: ../signup.php?error=invaliduid&mail=".$email);
        exit();
    } else if ($password !== $passwordRepeat) { // passwords do not match up
        header("Location: ../signup.php?error=passwordcheck&uid=".$username."&mail=".$email);
        exit();
    } else { // username already exists
        $sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
        $stmt = mysqli_stmt_init($conn); // prepared statement

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signup.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $username); // "s" represents passing in a string data type to the database
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows(); // num of rows in database (if it returns 1, then that username is already taken)
            
            if ($resultCheck > 0) {
                header("Location: ../signup.php?error=usertaken&mail=".$email);
                exit();
            } else { // username works
                $sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers) VALUES (?, ?, ?)"; // input all columns of DB the '?' represent placeholders in the url
                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../signup.php?error=sqlerror");
                    exit();
                } else {

                    //hash the password using B-Crypt
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPwd);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../signup.php?signup=success");
                    exit();
                }
            }
        }

    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else { // if the user gets to the sign up page without pressing the button (through the url tag)
    header("Location ../signup.php"); // send that back to main page
    exit();
}

