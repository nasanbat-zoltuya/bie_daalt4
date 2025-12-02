<?php
$host = "localhost";
$user = "root";
$pass = "Zoltuya080608@";              // phpMyAdmin password чинь хоосон байвал хоосон үлдээнэ
$db   = "coffeeshopdb";  // бидний үүсгэсэн DB нэр

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Database holbogdsongui: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>