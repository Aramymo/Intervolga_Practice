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
        <?php  if (isset($_SESSION['username'])) : ?>
            <h1>Welcome to the feedback page <?php echo $_SESSION['username']; ?></h1>
            <p> <a href="/?logout=1" style="color: red;">logout</a> </p>
        <?php endif ?>
        <?php  if (!isset($_SESSION['username'])) : ?>
            <h1>Welcome to the feedback page</h1>
            <p> <a href="/login" style="color: red;">login</a> </p>
        <?php endif ?>
        <p>This is going to be a feedback page where you can see reviews for a product</p>
        <div>
            Random div to test.
        </div>
    </body>
</html>