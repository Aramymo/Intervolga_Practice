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
    <style>
        <?php include "templates/css/reviews.css"?>
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<body>
<div class="sticky-header" id="sticky_header">
    <a href="/" class="home_button">Go Home</a>
</div>
    <form method="post" action="/registration" class="form-design">
        <div class="centered_text form-header">REGISTER</div>
        <div class="form-container">
            <?php
            if (isset($_SESSION['registration_errors'])) : ?>
            <div>
                <?php foreach ($_SESSION['registration_errors'] as $error) : ?>
                    <p><?php echo $error ?></p>
                <?php endforeach ?>
            </div>
            <?php  endif ?>
            <input type="text" name="username" placeholder="Username">
            <input type="email" name="user_email" placeholder="email">
            <input type="password" name="password1" placeholder="password">
            <input type="password" name="password2" placeholder="confirm password">
            <button type="submit" name="reg_user" class="btn-login" value="<?php unset($_SESSION['registration_errors']) ?>">Создать аккаунт</button>
            Уже зарегистрированы? <a href="../login">Войдите в аккаунт</a>!
        </div>
    </form>
<script> <?php include"../scripts/stickyHeader.js"?></script>
</body>
</html>