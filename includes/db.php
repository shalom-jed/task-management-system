<?php
$host = 'localhost:3306';
$user = 'root';
$pass = '1234';
$dbname = 'intern_task_system';

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>