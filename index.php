<!DOCTYPE html>
<html>
<head>
    <title>Emotion Tracker - Login</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <!-- Check for error query parameter and display the error message -->
        <?php if (isset($_GET['error']) && $_GET['error'] == 1) : ?>
            <p style="color: red;">Invalid username or password. Please try again.</p>
        <?php endif; ?>
        <form action="login.php" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>
</body>
</html>