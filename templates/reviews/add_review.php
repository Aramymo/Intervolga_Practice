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
        <?php include "templates/css/reviews.css" ?>
        <?php include "templates/css/stars.css" ?>
    </style>
</head>
<body>
<div class="sticky-header" id="sticky_header">
    <a href="/" class="home_button">Go Home</a>
</div>
<div>
    <form method="post" action="/api/add_review/" class="form-design">
        <div class="centered_text form-header">REVIEW</div>
        <div class="form-container">
            <input type="text" name="username" value="<?php echo $_SESSION['username']?>">
            <?php include "stars.html"?>
            <input type="text" name="comment" placeholder="Leave your comment!"">
            <button type="submit" name="Send review" class="btn-login">Оставить отзыв</button>
        </div>
    </form>
</div>
<script> <?php include"../scripts/stickyHeader.js"?></script>
</body>
</html>