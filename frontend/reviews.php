<?php

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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <title>Feedback</title>
        <style>
            <?php include "css/reviews.css" ?>
        </style>
    </head>
    <body>
        <?php  if (isset($_SESSION['username'])) : ?>
            <div class="div-box popup">
                <div class="child">
                    <h2>Welcome to the feedback page, <?php echo $_SESSION['username']?>!</h2>
                    <h4>Please be free to leave your review!</h4>
                    <a href="/api/add_review/"><button class="button2"><span>Leave a review</span></button></a>
                </div>
                <div>
                    <p> <a href="/?logout=1"><button class="button1"><span>Logout :c</span></button></a> </p>
                    <p> <a href="/api/feedbacks/page=1"><button class="button2"><span>Check out reviews</span></button></a> </p>
                </div>
            </div>
        <?php endif ?>
        <?php  if (!isset($_SESSION['username'])) : ?>
            <div class="div-box popup">
                <div class="child">
                    <h2>Welcome to the feedback page!</h2>
                    <h4>Seems like you have not log in yet!</h4>
                    <h6>You have to be logged in to leave a review but you can see reviews of others.</h6>
                </div>
                <div>
                    <p> <a href="regandlog/login.php"><button class="button1"><span>Login</span></button></a> </p>
                    <p> <a href="/review_pages.php"><button class="button2"><span>Check out reviews</span></button></a> </p>
                </div>
            </div>
        <?php endif ?>
    </body>
</html>