<?php

ob_start();
session_start();

$timeZone = date_default_timezone_set("Africa/Dakar");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Slotify";

$con = mysqli_connect($servername, $username, $password, $dbname);
if (mysqli_connect_errno()) {
    echo "Failed to connect to mysql:" .
        mysqli_connect_error();
    exit();
}
