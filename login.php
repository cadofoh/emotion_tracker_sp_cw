<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    require 'includes/db.php';

    // Secure version: Prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT user_id, username, password FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Secure: Passwords are hashed and verified
        // Login successful; create a session to indicate the user is logged in
        session_start();
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];

        // Redirect to the dashboard or any other page
        header('Location: dashboard.php');
        exit();
    } else {
        // Login failed; set the error message in a query parameter
        header('Location: index.php?error=1'); // Redirect to the login page with an error flag
        exit();
    }
}
