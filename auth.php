<?php
session_start();

if (isset($_SESSION['user'])) {
    header('Location: cabinet.php');
}

$email_or_phone = $password = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require_once 'functions/dbconnect.php';
    require_once 'functions/clear_data.php';

    $email_or_phone = clear_data('email_or_phone');
    $password = clear_data('password');

    $secret = '6LfE3FkjAAAAAFFYRaZgFclAQNJNZ2kfZ9XdypYN';

    if (!empty($_POST['g-recaptcha-response'])) {

        $out = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
        $out = json_decode($out);

        if ($out->success == true) {

            $user = $dbconnect->query("SELECT login, phone, email, password FROM users WHERE email = '$email_or_phone' OR phone = '$email_or_phone' LIMIT 1");
            $user = mysqli_fetch_array($user, MYSQLI_ASSOC);

                if ($user) {

                    if (password_verify(clear_data('password'), $user['password'])) {

                        $_SESSION['user'] = [
                            "login" => $user['login'],
                            "phone" => $user['phone'],
                            "email" => $user['email'],
                            "password" => $password
                        ];
                        header('Location: cabinet.php');
                        exit;

                    } else {

                        $err['password_error'] = '<p class="text-warning">Пароль не подходит</p>';
                        require 'auth.html';
                        exit;

                    }

                }

                    $err['email_error'] = '<p class="text-warning">Вы не зарегистрированы, введите другую почту или телефон</p>';
                    require 'auth.html';
                    exit;

        }

    }

    else {

        $err['capcha_error'] = '<p class="text-warning">Вы не ввели капчу</p>';

    }

    $dbconnect->close();

}

require 'auth.html';

exit;








