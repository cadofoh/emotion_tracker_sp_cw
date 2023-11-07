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

    // Insecure: Directly inserting user input into SQL query without validation
    foreach ($emotions as $emotion) {
        $query = "INSERT INTO emotions (user_id, emotion_text) VALUES ($user_id, '$emotion')";
        $conn->query($query);
    }
}

header('Location: dashboard.php');
?>