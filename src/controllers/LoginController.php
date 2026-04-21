<?php
declare(strict_types=1);

session_start();

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../includes/functions.php';
require_once __DIR__ . '/../models/User.php';

$pdo = require __DIR__ . '/../../config/database.php';
$userModel = new User($pdo);

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
        $errors['general'] = 'Ошибка безопасности. Обновите страницу.';
    }

    $login     = trim($_POST['login'] ?? '');
    $password  = $_POST['password'] ?? '';

    if (empty($login)) $errors['login'] = 'Введите email или телефон';
    if (empty($password)) $errors['password'] = 'Введите пароль';

    if (empty($errors)) {
        $user = $userModel->findByLogin($login);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['user_name'] = $user['name'];

            unset($_SESSION['csrf_token']);
            set_flash('success', 'Вы успешно вошли в аккаунт!');

            redirect('/profile.php');
            exit;
        } else {
            $errors['general'] = 'Неверный email/телефон или пароль';
        }
    }
}

// Показ формы при ошибке или GET-запросе
require_once __DIR__ . '/../../public/login.php';
