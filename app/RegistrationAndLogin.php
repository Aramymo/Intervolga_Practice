<?php

namespace App;
class RegistrationAndLogin
{
    private $pdo;
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    public function registerUser($username,$user_email,$password)
    {
        $hash_password = password_hash($password,PASSWORD_DEFAULT, array('cost' => 6));//encrypt the password before saving in the database
        //$_SESSION['success'] = "You are now logged in";
        $stmt = $this->pdo->prepare('INSERT INTO users (username,user_email,password)
                                     VALUES (:username, :user_email, :password);');
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':user_email', $user_email);
        $stmt->bindParam(':password', $hash_password);
        $result = $stmt->execute();
        return $result;
    }
    public function checkRegistrationData($username,$user_email,$password1,$password2)
    {
        $errors = array();
        if (empty($username)) { array_push($errors, "Введите имя пользователя"); }
        if (empty($user_email)) { array_push($errors, "Нужна электронная почта"); }
        if (empty($password1)) { array_push($errors, "Нужен пароль"); }
        if ($password1 != $password2) {
            array_push($errors, "Пароли не совпадают");
        }
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE user_email = :user_email OR username = :username LIMIT 1');
        $stmt->bindParam(':username',$username);
        $stmt->bindParam(':user_email',$user_email);
        $stmt->execute();
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($user) { // if user exists
            if ($user['user_email'] === $user_email) {
                array_push($errors, "Электронная почта уже существует");
            }
            if ($user['username'] === $username) {
                array_push($errors, "Имя пользователя уже занято");
            }
        }
        $uppercase = preg_match('@[A-Z]@', $password1);
        $lowercase = preg_match('@[a-z]@', $password1);
        $number    = preg_match('@[0-9]@', $password1);
        $specialChars = preg_match('@[^\w]@', $password1);

        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password1) < 6) {
            array_push($errors, "Пароль должен состоять из минимум 6 символов и должен включать в себя как минимум одну букву в верхнем и нижнем регистре, число и специальный символ");
        }
        return $errors;
//        echo count($errors);
//        if (count($errors) == 0) {
//            return true;
//        }
//        else return false;
    }
    public function loginUser($username,$password)
    {
        $errors = array();
        $hash_password = password_hash($password,PASSWORD_DEFAULT, array('cost' => 6));
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE username = :username');
        $stmt->bindParam(':username',$username);
        $stmt->execute();
        $results = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $results[] = [
                'user_id' => $row['user_id'],
                'username' => $row['username'],
                'user_email' => $row['user_email'],
                'password' => $row['password'],
            ];
        }
        if (password_verify($password, $results[0]['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
            header('location: ../home');
            return true;
        }else {
            array_push($errors, "Неправильные имя пользователя или пароль");
            return false;
        }
    }

    public function checkLoginData($username, $password)
    {
        $errors = array();
        if (empty($username)) {
            array_push($errors, "Нужна электронная почта");
        }
        if (empty($password)) {
            array_push($errors, "Нужен пароль");
        }
        return $errors;
//        if (count($errors) == 0) {
//            return true;
//        }
//        else return $errors;
    }
}