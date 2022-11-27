<?php
session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
}
?>
<!DOCTYPE html>
<html lang="ru-en">
<head>
    <meta charset="UTF-8">
    <title>Feedback</title>
</head>
<body>
<h1>Welcome to the feedback page Session Name: <?php echo $_SESSION['username']; ?></h1>
<p>Please give your review in the form below:</p>
<div>
    <form method="POST" action="/api/add_review/">
        <div>
            <label>Username:</label>
            <input type="text" name="username">
        </div>
        <div>
            <label>Rating:</label>
            <input type="radio" name="rating" value="1">
            <input type="radio" name="rating" value="2">
            <input type="radio" name="rating" value="3">
            <input type="radio" name="rating" value="4">
            <input type="radio" name="rating" value="5">
            <input type="radio" name="rating" value="6">
            <input type="radio" name="rating" value="7">
            <input type="radio" name="rating" value="8">
            <input type="radio" name="rating" value="9">
            <input type="radio" name="rating" value="10">
        </div>
        <div>
            <label>Comment</label>
            <input type="text" name="comment">
        </div>
        <input type="submit" value="Send review">
    </form>
</div>
</body>
</html>