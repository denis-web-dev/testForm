<?php
declare(strict_types=1);
session_start();

require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../config/database.php';

$pdo = require __DIR__ . '/../config/database.php';
requireAuth();

$user = getCurrentUser($pdo);
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
  <style>

  </style>
</head>
<body style="background: #f8f8f8;">

<div class="profile-container">

  <!-- Header -->
  <div class="profile-header">
    <div class="avatar" style="background-image: url('/assets/images/default-avatar.png')"></div>
    <h1><?= e($user['name'] ?? 'Пользователь') ?></h1>
    <p>Исполнитель</p>
  </div>

  <div class="section">
    <h2 style="margin-bottom: 30px;">Информация</h2>

    <?php if ($success): ?>
      <div style="color: green; background: #e8f5e8; padding: 15px; border-radius: 12px; margin-bottom: 20px;">
        <?= e($success) ?>
      </div>
    <?php endif; ?>

    <form method="POST" action="/profile.php">
      <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">

      <div class="form-group">
        <label>Имя Фамилия</label>
        <input type="text" name="name" value="<?= old('name', $user['name'] ?? '') ?>" required>
      </div>

      <div class="form-group">
        <label>Телефон</label>
        <input type="tel" name="phone" value="<?= old('phone', $user['phone'] ?? '') ?>" required>
      </div>

      <div class="form-group">
        <label>E-mail</label>
        <input type="email" name="email" value="<?= old('email', $user['email'] ?? '') ?>" required>
      </div>

      <div class="form-group">
        <label>Новый пароль (оставьте пустым, если не меняете)</label>
        <input type="password" name="password" placeholder="••••••••">
      </div>

      <button type="submit" class="btn-save">Сохранить изменения</button>
    </form>
  </div>

  <!-- Заглушки для следующих блоков -->
  <div class="section">
    <h2>Обo мне</h2>
    <p style="color:#777;">Здесь будет блок "Обo мне" с навыками и инструментами</p>
  </div>

  <div class="section">
    <h2>Портфолио</h2>
    <p style="color:#777;">Здесь будет сетка работ с возможностью добавления</p>
  </div>

</div>

</body>
</html>
