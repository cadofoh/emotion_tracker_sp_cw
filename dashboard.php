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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.1/emojionearea.css">
</head>

<body>
<div class="container mt-5">
    <div class="jumbotron text-center">
        <h1 class="display-4">Welcome, <?php echo $_SESSION['username']; ?>!</h1>
    </div>
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <form id="emotion-form" action="save_emotion.php" method="post">
                <div class="form-group">
                    <textarea class="form-control" name="emotion[]" id="emoji-input" rows="4" placeholder="How are you feeling today?"></textarea>
                </div>
                <div class="text-center">
                    <button type="button" id="confirm-button" class="btn btn-warning">Confirm Save Emotion</button>
                    <button type="submit" class="btn btn-primary" id="save-button" style="display: none;">Save Emotion</button>
                </div>
            </form>
            <div class="text-center"> <!-- Center-align the buttons -->
                <a href="view_emotions.php" class="btn btn-info mt-3">View Past Entries</a>
                <a href="logout.php" class="btn btn-danger mt-3">Logout</a>
            </div>
        </div>
    </div>
</div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.1/emojionearea.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
    $(document).ready(function() {
        $("#emoji-input").emojioneArea();
        //CSRF Authenication
        $("#confirm-button").on("click", function() {
            var confirmation = confirm("Are you sure you want to save this emotion?");
            if (confirmation) {
                $("#save-button").click(); // If confirmed, trigger the emotion submission
            }
        });
    });
</script>
</body>
</html>