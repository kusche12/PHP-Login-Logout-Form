<?php // Database handler 

$servername = "localhost"; // When using Xampp
$dBUsername = "root";
$dBPassword = "";
$dBName = "loginsystem";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
    die("Connection failed: ".mysqli_connect_error());
}