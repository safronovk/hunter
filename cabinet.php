<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: auth.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require_once 'functions/dbconnect.php';
    require_once 'functions/clear_data.php';

    $login = $_SESSION['user']['login'];
    $phone = $_SESSION['user']['phone'];
    $email = $_SESSION['user']['email'];
    $password = $_SESSION['user']['password'];

    $new_login = mb_strtolower(clear_data('login'));
    $new_phone = clear_data('phone');
    $new_email = mb_strtolower(clear_data('email'));
    $new_password = clear_data('password');
    $new_passwordconfirm = clear_data('passwordconfirm');

    $err = [];

    if (empty($new_login)) {
        $err['login_empty'] = '<p class="text-warning">Не стесняйтесь, введите ваш новый логин</p>';
    }
    if (mb_strlen($new_login) > 30) {
        $err['login_big'] = '<p class="text-warning">Новый логин слишком длинный, сократите до 30 символов</p>';
    }
    if (!preg_match("/^[A-Za-z]\S*$/", $new_login)) {
        $err['login_symbols'] = '<p class="text-warning">Введите новый логин на английском языке</p>';
    }

    if (!preg_match("/^(\+7|7|8)?[\s\-]?\(?[489][0-9]{2}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/", $new_phone)){
        $err['phone_symbols'] = '<p class="text-warning">Убедитесь, что новый телефон заполнени и без ошибок</p>';
    }

    if (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
        $err['email_symbols'] = '<p class="text-warning">Убедитесь, что новая почта заполнена и без ошибок</p>';
    }
    if (mb_strlen($new_email) > 100) {
        $err['email_big'] = '<p class="text-warning">Новая почта слишком длинная, укажите почту до 100 символов</p>';
    }

    if (mb_strlen($new_password) < 8) {
        $err['password_small'] = '<p class="text-warning">Новый пароль должен содержать не менее 8 символовв</p>';
    }
    if (mb_strlen($new_passwordconfirm) < 8) {
        $err['passwordconfirm_small'] = '<p class="text-warning">Новый пароль должен содержать не менее 8 символовв</p>';
    }
    if ($new_password != $new_passwordconfirm) {
        $err['passwordconfirm_symbols'] = '<p class="text-warning">Вы ввели разные пароли, попробуйте еще раз</p>';
    }

    if(empty($err)) {

        $double = [];

        if ($new_login != $_SESSION['user']['login']) {

            $double = $dbconnect->query("SELECT login FROM users WHERE login = '$new_login' LIMIT 1");
            $double = mysqli_fetch_array($double, MYSQLI_ASSOC);

            if ($double["login"] == $new_login) {

                $err['login_double'] = '<p class="text-warning">Этот логин уже используется, введите другой</p>';

            } else {

                $new_login_success = $dbconnect->query("UPDATE users SET login = '$new_login' WHERE login = '$login'");
                $_SESSION['user']['login'] = $new_login;

            }

        }

        if ($new_phone != $_SESSION['user']['phone']) {

            $double = $dbconnect->query("SELECT phone FROM users WHERE phone = '$new_phone' LIMIT 1");
            $double = mysqli_fetch_array($double, MYSQLI_ASSOC);

            if ($double["phone"] == $new_phone) {

                $err['phone_double'] = '<p class="text-warning">Этот телефон уже используется, введите другой</p>';

            } else {

                $new_phone_success = $dbconnect->query("UPDATE users SET phone = '$new_phone' WHERE phone = '$phone'");
                $_SESSION['user']['phone'] = $new_phone;

            }

        }

        if ($new_email != $_SESSION['user']['email']) {

            $double = $dbconnect->query("SELECT email FROM users WHERE email = '$new_email' LIMIT 1");
            $double = mysqli_fetch_array($double, MYSQLI_ASSOC);

            if ($double["email"] == $new_email) {

                $err['email_double'] = '<p class="text-warning">Эта почта уже используется, введите другую</p>';

            } else {

                $new_email_success = $dbconnect->query("UPDATE users SET email = '$new_email' WHERE email = '$email'");
                $_SESSION['user']['email'] = $new_email;

            }

        }

        if ($new_password != $_SESSION['user']['password']) {

            $new_passwordhash = password_hash($new_password, PASSWORD_BCRYPT);
            $new_password_success = $dbconnect->query("UPDATE users SET password = '$new_passwordhash' WHERE login = '$login'");
            $_SESSION['user']['password'] = $new_password;

        }

    }

    $dbconnect->close();

}

require 'cabinet.html';
exit;