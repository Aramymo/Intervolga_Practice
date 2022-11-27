<?php
session_start();

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
    <!--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">-->
    <!--    <link rel="stylesheet" type="text/css" href="../CSS/style.css">-->
</head>
<body>
<a href="../">На главную</a>
<form method="post" action="/login">
    <div>
        <label>Электронная почта</label>
        <input type="text" name="username">
    </div>
    <div>
        <label>Пароль</label>
        <input type="password" name="password">
    </div>
        <button type="submit" name="login_user">Войти в аккаунт</button>
    </div>
    <p>
        Ещё нет аккаунта? <a href="../registration">Зарегестрируйтесь</a>
    </p>
</form>
</body>
</html>