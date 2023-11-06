<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Emotion Tracker - Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="jumbotron text-center">
            <h1 class="display-4">Welcome, <?php echo $_SESSION['username']; ?>!</h1>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form action="save_emotion.php" method="post">
                    <div class="form-group">
                        <textarea class="form-control" name="emotion[]" rows="4" placeholder="How are you feeling today?"></textarea> 

                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Save Emotion</button>
                </form>
                <a href="view_emotions.php" class="btn btn-info btn-block mt-3">View Past Entries</a>
                <a href="logout.php" class="btn btn-danger btn-block mt-3">Logout</a>
            </div>
        </div>
    </div>
</body>
</html>