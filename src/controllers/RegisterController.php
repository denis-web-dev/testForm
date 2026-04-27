<?php
declare(strict_types=1);

// Сессия
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../includes/functions.php';
$pdo = require __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/User.php';

$userModel = new User($pdo);
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // проверяем CSRF токен
    if (empty($_POST['csrf_token']) ||
        empty($_SESSION['csrf_token']) ||
        !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die('CSRF token mismatch');
    }

    // Получаем и очищаем данные
    $name     = trim($_POST['name'] ?? '');
    $phone    = preg_replace('/[^0-9+]/', '', trim($_POST['phone'] ?? ''));
    $email    = trim(strtolower($_POST['email'] ?? ''));
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm-password'] ?? '';

    // Валидация имени
    if (empty($name) || !preg_match('/^[a-zA-Zа-яА-ЯёЁ\s\-]+$/u', $name)) {
        $errors['name'] = 'Имя может содержать только буквы';
    } elseif (mb_strlen($name) < 2 || mb_strlen($name) > 50) {
        $errors['name'] = 'Имя от 2 до 50 символов';
    }

    // Валидация телефона
    if (empty($phone) || !preg_match('/^(\+7|8)[0-9]{10}$/', $phone)) {
        $errors['phone'] = 'Введите корректный номер (+7 или 8 и 10 цифр)';
    }

    // Валидация email
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Введите корректный E-mail';
    }

    // Валидация пароля
    if (empty($password) || strlen($password) < 6) {
        $errors['password'] = 'Пароль минимум 6 символов';
    } elseif (!preg_match('/[A-Za-z]/', $password) || !preg_match('/[0-9]/', $password)) {
        $errors['password'] = 'Пароль должен содержать буквы и цифры';
    }

    // Проверка совпадения паролей
    if ($password !== $confirm) {
        $errors['confirm-password'] = 'Пароли не совпадают';
    }

    // Проверка уникальности
    if (empty($errors['email']) && $userModel->emailExists($email)) {
        $errors['email'] = 'Пользователь с таким E-mail уже существует';
    }
    if (empty($errors['phone']) && $userModel->phoneExists($phone)) {
        $errors['phone'] = 'Пользователь с таким телефоном уже существует';
    }

    // Регистрация
   if (empty($errors)) {
    if ($userModel->register($name, $phone, $email, $password)) {
        unset($_SESSION['csrf_token']);
        redirect('/login.php');  // Просто редирект, без сообщения
    } else {
        $errors['general'] = 'Ошибка при сохранении в базу';
    }
}

    if (!empty($errors)) {
    // Регенерируем токен для следующей попытки
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    $_SESSION['form_errors'] = $errors;
    $_SESSION['form_old'] = $_POST;
    redirect('/registration.php');
}
}
