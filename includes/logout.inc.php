<?php
// Log out handler

session_start();
session_unset(); // delete all the session variables we made when logged in
header("Location: ../index.php");