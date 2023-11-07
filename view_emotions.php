<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

require 'includes/db.php';

$user_id = $_SESSION['user_id'];
// Insecure: No prepared statement or validation
$query = "SELECT emotion_text, timestamp FROM emotions WHERE user_id = $user_id";
$result = $conn->query($query);
$emotions = $result->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Emotion Tracker - Past Entries</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="past-entries">
        <h2>Past Entries</h2>
        <?php foreach ($emotions as $emotion) : ?>
            <p><?php echo $emotion['timestamp'] . ": " . $emotion['emotion_text']; ?></p>
        <?php endforeach; ?>
        <a href="dashboard.php">Go Back</a>
    </div>
</body>
</html>