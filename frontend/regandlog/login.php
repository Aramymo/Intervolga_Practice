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
    <title>Вход</title>
    <style>
        <?php include "templates/css/reviews.css"?>
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<body>
<div class="sticky-header" id="sticky_header">
    <a href="/" class="home_button">Go Home</a>
</div>
<form method="post" action="/login" class="form-design">
    <div class="centered_text form-header">LOG IN</div>
        <div class="form-container">
            <?php
            if (isset($_SESSION['login_errors'])) : ?>
                <div>
                    <?php foreach ($_SESSION['login_errors'] as $error) : ?>
                        <p><?php echo $error ?></p>
                    <?php endforeach ?>
                </div>
            <?php  endif ?>
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="password" placeholder="Password">
            <button type="submit" name="login_user" class="btn-login" value="<?php unset($_SESSION['login_errors']) ?>">Войти в аккаунт</button>
            У вас ещё нет аккаунта? <a href="../registration">Зарегестрируйтесь</a>!
        </div>
</form>
<script> <?php include"../scripts/stickyHeader.js"?></script>
</body>
</html>