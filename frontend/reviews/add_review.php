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
        <?php include "../css/reviews.css" ?>
        <?php include "../css/stars.css" ?>
    </style>
</head>
<body>
<div class="sticky-header" id="sticky_header">
    <a href="../reviews.php" class="home_button">Go Home</a>
</div>
<div>
    <form method="post" class="form-design" id="send-review">
        <div class="centered_text form-header">REVIEW</div>
        <div class="form-container">
            <input type="text" name="username" id="username">
            <input type="text" name="rating" id="rating">
<!--<?php //include "stars.html"?>-->
            <input type="text" name="comment" placeholder="Leave your comment!" id="comment">
            <button type="submit" name="Send review" class="btn-login">Оставить отзыв</button>
        </div>
    </form>
</div>
<script src="../scripts/stickyHeader.js"></script>
<script src="../scripts/jquery-3.6.1.js"></script>
<script src="../scripts/send_review.js"></script>
</body>
</html>