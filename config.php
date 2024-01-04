<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "e_mading_jwp";

$conn = mysqli_connect($host, $username, $password, $database);

if ($conn) {
    echo "Connected";
} else {
    echo "Connection Failed";
}

?>