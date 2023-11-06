<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

if (isset($_POST['emotion'])) {
    $emotions = $_POST['emotion'];

    require 'includes/db.php';

    $user_id = $_SESSION['user_id'];

    // Insert multiple emotions into the database
    foreach ($emotions as $emotion) {
        $stmt = $conn->prepare("INSERT INTO emotions (user_id, emotion_text) VALUES (?, ?)");
       $stmt->execute([$user_id, $emotion]);
       
    }
}

header('Location: dashboard.php');
?>