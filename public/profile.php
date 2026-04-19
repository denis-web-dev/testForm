<?php
declare(strict_types=1);
session_start();

require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../config/database.php';

$pdo = require __DIR__ . '/../config/database.php';

requireAuth();                    // Защита страницы
$user = getCurrentUser($pdo);     // Получаем данные пользователя

$errors = $errors ?? [];
$success = $success ?? '';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ITFREELANCE — Профиль</title>
  <link rel="stylesheet" href="/assets/css/main.css">
</head>
<body class="page-profile">

<div class="container">
    <h1>Личный кабинет</h1>

    <?php get_flash(); ?>

    <?php if ($success): ?>
        <div style="color: green; font-weight: bold; margin: 15px 0;"><?= e($success) ?></div>
    <?php endif; ?>

    <form method="POST" action="/profile.php">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">

        <div class="form-group">
            <label>Имя</label>
            <input type="text" name="name" value="<?= old('name', $user['name'] ?? '') ?>" required>
            <?php if (isset($errors['name'])): ?>
                <span class="error-text"><?= e($errors['name']) ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label>Телефон</label>
            <input type="tel" name="phone" value="<?= old('phone', $user['phone'] ?? '') ?>" required>
            <?php if (isset($errors['phone'])): ?>
                <span class="error-text"><?= e($errors['phone']) ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="<?= old('email', $user['email'] ?? '') ?>" required>
            <?php if (isset($errors['email'])): ?>
                <span class="error-text"><?= e($errors['email']) ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label>Новый пароль (оставьте пустым, если не хотите менять)</label>
            <input type="password" name="password">
            <?php if (isset($errors['password'])): ?>
                <span class="error-text"><?= e($errors['password']) ?></span>
            <?php endif; ?>
        </div>

        <button type="submit" class="form__btn">Сохранить изменения</button>
    </form>

    <a href="/logout.php">Выйти из аккаунта</a>
</div>

</body>
</html>
