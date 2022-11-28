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
<html lang="ru">
<head>
    <title>Регистрация</title>
<!--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">-->
<!--    <link rel="stylesheet" type="text/css" href="../CSS/style.css">-->
</head>
<body>
<a href="../">На главную</a>
    <form method="post" action="/registration">
        <?php
        if (isset($_SESSION['registration_errors'])) : ?>
        <div>
            <?php foreach ($_SESSION['registration_errors'] as $error) : ?>
                <p><?php echo $error ?></p>
            <?php endforeach ?>
        </div>
        <?php  endif ?>
        <div>
            <label>Имя пользователя</label>
            <input type="text" name="username">
        </div>
        <div>
            <label>Электронная почта</label>
            <input type="email" name="user_email">
        </div>
        <div>
            <label>Пароль</label>
            <input type="password" name="password1">
        </div>
        <div>
            <label>Повторите пароль</label>
            <input type="password" name="password2">
        </div>
        <div>
            <button type="submit" name="reg_user" value="<?php unset($_SESSION['registration_errors']) ?>">Создать аккаунт</button>
        </div>
        <p>
            Уже зарегистрированы? <a href="../login">Войдите в аккаунт</a>
        </p>
    </form>
</body>
</html>