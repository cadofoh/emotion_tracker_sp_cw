<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    require 'includes/db.php';

    // Insecure: Directly inserting user input into SQL query without validation
    // This is susceptible to SQL injection and should not be used .
    $query = "SELECT user_id, username, password FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($query);
    $user = $result->fetch();

    if ($user) {
        // Insecure: Passwords are stored in plain text
        // Login successful; create a session to indicate the user is logged in
        session_start();
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];

        // Redirect to the dashboard or any other page
        header('Location: dashboard.php');
        exit();
    } else {
        // Login failed; display an error message
        $error = 'Invalid username or password. Please try again.';
    }
}
?>
