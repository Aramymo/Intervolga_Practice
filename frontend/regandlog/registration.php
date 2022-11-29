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
        <?php include "../css/reviews.css"?>
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<body>
<div class="sticky-header" id="sticky_header">
    <a href="../reviews.php" class="home_button">Go Home</a>
</div>
    <form method="post" action="/registration" class="form-design" id="registration-form">
        <div class="centered_text form-header">REGISTER</div>
        <div class="form-container">
            <div id="error-div">
            </div>
            <input type="text" name="username" placeholder="Username" id="username">
            <input type="email" name="user_email" placeholder="email" id="user_email">
            <input type="password" name="password1" placeholder="password" id="password1">
            <input type="password" name="password2" placeholder="confirm password" id="password2">
            <button type="submit" name="reg_user" class="btn-login" value="<?php unset($_SESSION['registration_errors']) ?>">Создать аккаунт</button>
            Уже зарегистрированы? <a href="login.php">Войдите в аккаунт</a>!
        </div>
    </form>
<script src="../scripts/stickyHeader.js"></script>
<script src="../scripts/jquery-3.6.1.js"></script>
<script src="../scripts/registration_page.js"></script>
</body>
</html>