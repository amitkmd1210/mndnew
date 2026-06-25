<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "corephp";

$conn = mysqli_connect($host, $user, $pass, $db);

if(!$conn) {
    echo "Connection Error.".mysqli_connect_error();
}
?>