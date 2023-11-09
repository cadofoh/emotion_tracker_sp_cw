<?php
$host = "localhost";
$dbname = "emotion_tracker";
$dblogin = "myemotionlogin";
$dbpassword = "9L?XeLzY5PH!DstC";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $dblogin, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
