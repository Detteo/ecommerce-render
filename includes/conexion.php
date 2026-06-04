<?php
$host = 'localhost';
$dbname = 'bookstore';
$user = 'root';
$pass = '';

$conn = mysqli_connect($host, $user, $pass, $dbname);
mysqli_set_charset($conn, 'utf8mb4');

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}
