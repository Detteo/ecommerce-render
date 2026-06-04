<?php
$host   = getenv('DB_HOST')   ?: 'mysql.railway.internal';
$dbname = getenv('DB_NAME')   ?: 'railway';
$user   = getenv('DB_USER')   ?: 'root';
$pass   = getenv('DB_PASS')   ?: 'QvkPJfdTIeXBUighGrDDqQzRqACpgKit';
$port   = getenv('DB_PORT')   ?: 3306;

$conn = mysqli_connect($host, $user, $pass, $dbname, (int)$port);
mysqli_set_charset($conn, 'utf8mb4');

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}