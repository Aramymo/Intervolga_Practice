<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Регистрация</title>
<!--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">-->
<!--    <link rel="stylesheet" type="text/css" href="../CSS/style.css">-->
</head>
<body>

    <form method="post" action="/registration">
        <div>
            <label>Имя пользователя</label>
            <input type="text" name="username">
        </div>
        <div>
            <label>Электронная почта</label>
            <input type="email" name="email">
        </div>
        <div>
            <label>Пароль</label>
            <input type="password" name="password_1">
        </div>
        <div>
            <label>Повторите пароль</label>
            <input type="password" name="password_2">
        </div>
        <div>
            <button type="submit" name="reg_user">Создать аккаунт</button>
        </div>
        <p>
            Уже зарегистрированы? <a href="login.php">Войдите в аккаунт</a>
        </p>
    </form>
</body>
</html>