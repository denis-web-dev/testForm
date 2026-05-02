<?php
declare(strict_types=1);

session_start();

require_once __DIR__ . '/../../includes/recaptcha.php';
require_once __DIR__ . '/../../includes/functions.php';
require_once __DIR__ . '/../models/User.php';

$pdo = require __DIR__ . '/../../config/database.php';
$userModel = new User($pdo);

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $login    = trim($_POST['login'] ?? '');
    $password = $_POST['password'] ?? '';
    $token    = $_POST['recaptcha_token'] ?? '';

    // сохраняем старые данные
    $_SESSION['old'] = [
        'login' => $login
    ];

    // CSRF
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
        $errors['general'] = 'Ошибка безопасности';
    }

    // reCAPTCHA
    if (empty($errors) && !verifyRecaptcha($token)) {
        $errors['captcha'] = 'Ошибка reCAPTCHA';
    }

    // базовая валидация
    if (empty($login) || empty($password)) {
        $errors['general'] = 'Введите логин и пароль';
    }

    if (empty($errors)) {

        $user = $userModel->findByLogin($login);

        if ($user && password_verify($password, $user['password'])) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];

            unset($_SESSION['old']); // чистим только при успехе

            set_flash('success', 'Вы успешно вошли');
            redirect('/profile.php');
            exit;

        } else {
            $errors['general'] = 'Неверный логин или пароль';
        }
    }
}

// передаём ошибки в view
require_once __DIR__ . '/../../public/login.php';
