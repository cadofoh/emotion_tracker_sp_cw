<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    require 'includes/db.php';

    // Check if the username already exists
    $query = "SELECT user_id FROM users WHERE username = '$username'";
    $result = $conn->query($query);
    $user = $result->fetch();

    if ($user) {
        // Username already exists; handle this case
        $error = 'Username already exists. Please choose another username.';
    } else {
        // Insecure: Password is stored in plain text
        $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        $conn->query($query);

        // Redirect to the login page
        header('Location: index.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Emotion Tracker - Register</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="login-container">
        <h2>Register for Emotion Tracker</h2>
        <form action="register.php" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="register">Register</button>
        </form>
        <p>Already have an account? <a href="index.php">Login here</a></p>
    </div>
</body>
</html>