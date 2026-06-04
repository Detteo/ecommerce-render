<?php
$host   = getenv('DB_HOST');
$dbname = getenv('DB_NAME');
$user   = getenv('DB_USER');
$pass   = getenv('DB_PASS');
$port   = (int)(getenv('DB_PORT') ?: 3306);

$conn = mysqli_connect($host, $user, $pass, $dbname, $port);
mysqli_set_charset($conn, 'utf8mb4');

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}git 