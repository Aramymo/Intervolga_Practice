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
    <form method="post" class="form-design" id="update-review" action="/update/">
        <div class="centered_text form-header">ОТЗЫВ</div>
        <div class="form-container">
            <p>
                <input type="text" name="username" id="username" value="<?=$data['username']?>">
            </p>
            <p>
                Оценка: <?=$data['rating']?>/10
            </p>
            <div class="rating" id="rating" user-rating="<?=$data['rating']?>"></div>
            <p>
                <label for="email">Почта для связи</label>
                <input type="email" name="email" id="email" value="<?=$data['email']?>">
            </p>
            <p>
                <label for="reviewed_product">Тип продукта для обзора</label>
                <select name="reviewed_product" id="reviewed_product">
                    <?php foreach ($data['select_fields'] as $key => $type) {?>
                        <option value="<?=$key?>" <?=$key!=$data['reviewed_product'] ?: 'selected'?>><?=$type?></option>
                    <?php }?>
<!--                    <option value="Мебель">Мебель</option>-->
<!--                    <option value="Еда">Еда</option>-->
<!--                    <option value="Техника">Техника</option>-->
                </select>
            </p>
            <p>
                <label for="satisfaction">Сосал?</label>
                <input type="checkbox" name="satisfaction" id="satisfaction" <?=$data['satisfaction'] ? 'checked' : ''?>>
            </p>
            <p>
                <input type="text" name="comment" placeholder="Комментарий" id="comment" value="<?=$data['comment']?>">
            </p>
            <input type="hidden" name="review_id" id="review_id" value="<?=$data['review_id']?>">
            <button type="submit" name="Update review" class="btn-login">Изменить отзыв</button>
            <div id="review_message"></div>
        </div>
    </form>
</div>
<script> <?php include_once __DIR__ . '/../scripts/jquery-3.6.1.js'?></script>
    <script> <?php include_once __DIR__ . '/../scripts/update_review.js'?></script>
    <script> <?php include_once __DIR__ . '/../scripts/stars.js'?></script>
</body>
</html>