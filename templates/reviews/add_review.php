<!DOCTYPE html>
<html lang="ru-en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Feedback</title>
    <style>
        <?php include __DIR__ . "/../css/reviews.css" ?>
        <?php include __DIR__ . "/../css/stars.css" ?>
    </style>
</head>
<body>
<div class="sticky-header" id="sticky_header">
    <a href="/" class="home_button">На главную</a>
</div>
<div>
    <form method="post" class="form-design" id="send-review" action="/add/">
        <div class="centered_text form-header">ОТЗЫВ</div>
        <div class="form-container">
            <input type="text" name="username" id="username">
<!--            <input type="text" name="rating" id="rating">-->
            <?php include "stars.html"?>
            <input type="text" name="comment" placeholder="Оставьте комментарий!" id="comment">
            <button type="submit" name="Send review" class="btn-login">Оставить отзыв</button>
            <div id="review_message"></div>
        </div>
    </form>
</div>
<script> <?php include __DIR__ . '/../scripts/stickyHeader.js'?></script>
<script> <?php include __DIR__ . '/../scripts/jquery-3.6.1.js'?></script>
<script> <?php include __DIR__ . '/../scripts/send_review.js'?></script>
</body>
</html>