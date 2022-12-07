<?php
session_start();

if (isset($_SESSION['user'])) {
    header('Location: cabinet.php');
}

$login = $phone = $email = $password = $passwordconfirm = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require_once 'functions/dbconnect.php';
    require_once 'functions/clear_data.php';

    $login = mb_strtolower(clear_data('login'));
    $phone = clear_data('phone');
    $email = mb_strtolower(clear_data('email'));
    $password = clear_data('password');
    $passwordconfirm = clear_data('passwordconfirm');

    $err = [];

    if (empty($login)) {
        $err['login_empty'] = '<p class="text-warning">Не стесняйтесь, введите ваш логин</p>';
    }
    if (mb_strlen($login) > 30) {
        $err['login_big'] = '<p class="text-warning">Логин слишком длинный, сократите до 30 символов</p>';
    }
    if (!preg_match("/^[A-Za-z]\S*$/", $login)) {
        $err['login_symbols'] = '<p class="text-warning">Введите логин на английском языке</p>';
    }

    if (!preg_match("/^(\+7|7|8)?[\s\-]?\(?[489][0-9]{2}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/", $phone)){
        $err['phone_symbols'] = '<p class="text-warning">Убедитесь, что телефон заполнени и без ошибок</p>';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err['email_symbols'] = '<p class="text-warning">Убедитесь, что почта заполнена и без ошибок</p>';
    }
    if (mb_strlen($email) > 100) {
        $err['email_big'] = '<p class="text-warning">Почта слишком длинная, укажите почту до 100 символов</p>';
    }

    if (mb_strlen($password) < 8) {
        $err['password_small'] = '<p class="text-warning">Пароль должен содержать не менее 8 символовв</p>';
    }
    if (mb_strlen($passwordconfirm) < 8) {
        $err['passwordconfirm_small'] = '<p class="text-warning">Пароль должен содержать не менее 8 символовв</p>';
    }
    if ($password != $passwordconfirm) {
        $err['passwordconfirm_symbols'] = '<p class="text-warning">Вы ввели разные пароли, попробуйте еще раз</p>';
    }

    if(empty($err)) {

        $double = $dbconnect->query("SELECT login, phone, email FROM users WHERE login = '$login' OR phone = '$phone' OR email = '$email' LIMIT 1");

        $double = mysqli_fetch_array($double, MYSQLI_ASSOC);

        if ($double) {

            if ($double["login"] == $login) {

                $err['login_double'] = '<p class="text-warning">Этот логин уже используется, введите другой</p>';

            }
            if ($double["phone"] == $phone) {

                $err['phone_double'] = '<p class="text-warning">Этот телефон уже используется, введите другой</p>';

            }
            if ($double["email"] == $email) {

                $err['email_double'] = '<p class="text-warning">Эта почта уже используется, введите другую</p>';

            }

        } else {

            $passwordhash = password_hash($password, PASSWORD_BCRYPT);
            $new = $dbconnect->query("INSERT INTO users (login, phone, email, password) VALUES ('$login', '$phone', '$email', '$passwordhash')");

        }

    }

    $dbconnect->close();

}

require 'registration.html';
exit;