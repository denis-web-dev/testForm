<?php
declare(strict_types=1);

session_start();

require_once __DIR__ . '/../../includes/functions.php';
$pdo = require __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/User.php';

$userModel = new User($pdo);

requireAuth();

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // CSRF проверка
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
        $errors['general'] = 'Ошибка безопасности. Обновите страницу.';
    }

    $name     = trim($_POST['name'] ?? '');
    $phone    = trim($_POST['phone'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // Валидация
    if (empty($name)) {
        $errors['name'] = 'Имя обязательно';
    }
    if (empty($phone)) {
        $errors['phone'] = 'Телефон обязателен';
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Введите корректный email';
    }

    // Проверка уникальности
    if (empty($errors['phone']) && $phone !== ($user['phone'] ?? '')) {
        if ($userModel->phoneExists($phone)) {
            $errors['phone'] = 'Этот телефон уже используется';
        }
    }

    if (empty($errors['email']) && $email !== ($user['email'] ?? '')) {
        if ($userModel->emailExists($email)) {
            $errors['email'] = 'Этот email уже используется';
        }
    }

    if (empty($errors)) {
        // Обновляем основные данные
        $stmt = $pdo->prepare("
            UPDATE users
            SET name = ?, phone = ?, email = ?
            WHERE id = ?
        ");
        $stmt->execute([$name, $phone, $email, $_SESSION['user_id']]);

        // Если введён новый пароль — обновляем его
        if (!empty($password)) {
            if (strlen($password) < 6) {
                $errors['password'] = 'Пароль должен быть не менее 6 символов';
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
                $stmt->execute([$hashedPassword, $_SESSION['user_id']]);
            }
        }

        if (empty($errors)) {
            $success = 'Профиль успешно обновлён!';
            set_flash('success', $success);
            redirect('/profile.php');
            exit;
        }
    }
}

require_once __DIR__ . '/../../public/profile.php';
