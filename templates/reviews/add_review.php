<!DOCTYPE html>
<html lang="ru-en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Feedback</title>
    <style>
        <?php include_once __DIR__ . "/../css/reviews.css" ?>
        <?php include_once __DIR__ . "/../css/stars.css" ?>
    </style>
</head>
<body>
    <?php include_once __DIR__ . "/../header.php"?>
<div>
    <form method="post" class="form-design" id="send-review" action="/add/">
        <div class="centered_text form-header">ОТЗЫВ</div>
        <div class="form-container">
            <p>
                <label for="username">Ваше имя</label>
                <input type="text" name="username" id="username">
            </p>
            <div class="rating" id="rating"></div>
            <p>
                <label for="email">Почта для связи</label>
                <input type="email" name="email" id="email">
            </p>
            <p>
                <label for="pepyaka">Пепяка?</label>
                <select name="pepyaka" id="pepyaka">
                    <option value="pe">Пепяка</option>
                    <option value="pya">Пепя</option>
                    <option value="ka">Пяка</option>
                </select>
            </p>
            <p>
                <label for="agree">Сосал?</label>
                <input type="checkbox" name="agree" id="agree">
            </p>
            <p>
                <input type="text" name="comment" placeholder="Оставьте комментарий!" id="comment">
            </p>
            <button type="submit" name="Send review" class="btn-login">Оставить отзыв</button>
            <div id="review_message"></div>
        </div>
    </form>
</div>
<script> <?php include_once __DIR__ . '/../scripts/jquery-3.6.1.js'?></script>
<script> <?php include_once __DIR__ . '/../scripts/send_review.js'?></script>
    <script> <?php include_once __DIR__ . '/../scripts/stars.js'?></script>
</body>
</html>