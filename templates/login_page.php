<!DOCTYPE html>
<html lang="ru-en">
    <head>
        <meta charset="UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <title>Feedback</title>
        <style>
            <?php include_once (__DIR__ . "/css/reviews.css")?>
        </style>
    </head>
    <body>
        <?php include_once (__DIR__ . "/header.php")?>
        <div>
            <form method="post" class="form-design" id="login" action="/auth/">
                <div class="centered_text form-header">Войти</div>
                <div class="form-container">
                    <input type="text" name="username" id="username" placeholder="Имя пользователя">
                    <input type="password" name="password" id="password" placeholder="Пароль">
                    <button type="submit" name="Login" class="btn-login">Войти</button>
                    <div id="review_message"></div>
                </div>
            </form>
        </div>
        <script> <?php include_once (__DIR__ . '/scripts/jquery-3.6.1.js')?></script>
        <script> <?php include_once (__DIR__ . '/scripts/login.js')?></script>
    </body>
</html>