<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    // Secure version: Password hashing, input validation, and prepared statements
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Input validation to prevent XSS
    if (empty($username) || empty($password) || empty($confirm_password)) {
        $error = 'All fields are required.';
    } elseif ($password !== $confirm_password) {
        $error = 'Passwords do not match. Please enter the same password in both fields.';
    } elseif (strlen($password) < 8) {
        $error = 'Password must be at least 8 characters long.';
    } elseif (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
        $error = 'Invalid characters in the username.';
    } elseif (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[A-Za-z\d]{8,}$/', $password)) {
        $error = 'Password must contain at least one letter, one number, and be at least 8 characters long.';
    } else {
        require 'includes/db.php';

        // Prepared statement to check if the username already exists
        $stmt = $conn->prepare("SELECT user_id FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user) {
            // Username already exists; handle this case
            $error = 'Username already exists. Please choose another username.';
        } else {
            // Secure: Hash the password before storing it in the database
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Prepared statement to insert the new user into the database
            $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->execute([$username, $hashed_password]);

            // Redirect to the login page
            header('Location: index.php');
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Emotion Tracker - Register</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style>
        .error-message {
            color: red;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Register for Emotion Tracker</h2>
        <!-- Display the error message here -->
        <?php if (!empty($error)) : ?>
            <p class="error-message"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="register.php" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <button type="submit" name="register">Register</button>
        </form>
        <p>Already have an account? <a href="index.php">Login here</a></p>
    </div>
</body>
</html>