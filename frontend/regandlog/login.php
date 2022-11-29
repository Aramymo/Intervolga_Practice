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
        <?php include "../css/reviews.css"?>
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<body>
<div class="sticky-header" id="sticky_header">
    <a href="../reviews.php" class="home_button">Go Home</a>
</div>
<!--action="/login"-->
<form method="post" action="../reviews.php" class="form-design" id="login-form">
    <div class="centered_text form-header">LOG IN</div>
        <div class="form-container">
                <div id="error-div">
                </div>
            <input type="text" name="username" id="username" placeholder="Username">
            <input type="password" name="password" id="password" placeholder="Password">
            <button type="submit" name="login_user" class="btn-login" value="<?php unset($_SESSION['login_errors']) ?>">Войти в аккаунт</button>
            У вас ещё нет аккаунта? <a href="registration.php">Зарегестрируйтесь</a>!
        </div>
</form>
<script src="../scripts/stickyHeader.js"></script>
<script src="../scripts/jquery-3.6.1.js"></script>
<script src="../scripts/login_page.js"></script>
</body>
</html>