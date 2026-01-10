<?php
$host = "localhost";
$dbname = "ressiniq";
$user = "DB_USERNAME";   // cPanel DB user
$pass = "DB_PASSWORD";   // cPanel DB password

try {
  $pdo = new PDO(
    "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
    $user,
    $pass,
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
  );
} catch (PDOException $e) {
  die("Database connection failed.");
}
