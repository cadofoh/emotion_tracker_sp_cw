<?php
session_start();

//Session authentication
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

require 'includes/db.php';

//Prepared statement 
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT emotion_text, timestamp FROM emotions WHERE user_id = ?");
$stmt->execute([$user_id]);
$emotions = $stmt->fetchAll();
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
            <!-- Prevents XSS by escaping special characters -->
            <p><?php echo htmlspecialchars($emotion['timestamp']) . ": " . htmlspecialchars($emotion['emotion_text']); ?></p>
        <?php endforeach; ?>
        <a href="dashboard.php">Go Back</a>
    </div>
</body>

</html>