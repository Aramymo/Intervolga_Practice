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
    <?php
    $path = __DIR__ . '/../config/config.json';
    $config_handle = fopen($path, 'r');
    $text = fread($config_handle,filesize($path));
    $json = json_decode($text, true);
    fclose($config_handle);
    ?>
        <div class="div-box popup">
            <div class="child">
                <h2>Добро пожаловать на страницу отзывов!</h2>
                <h4>Здесь Вы можете оставить свой отзыв или посмотреть отзывы других пользователей!</h4>
            </div>
            <div>
<!--                    <p> <a href="regandlog/login.php"><button class="button1"><span>Login</span></button></a> </p>-->
                <p> <a href="/add/"><button class="button1" ><span>Написать отзыв</span></button></a>
                <p> <a href="/feedbacks/"><button class="button2"><span>Посмотреть отзывы</span></button></a> </p>
            </div>
        </div>
    </body>
</html>