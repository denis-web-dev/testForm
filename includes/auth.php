<?php
declare(strict_types=1);

function requireAuth(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['user_id'])) {
        set_flash('error', 'Для доступа к этой странице необходимо войти в аккаунт.');
        redirect('/login.php');
        exit;
    }
}

/**
 * Получить данные текущего пользователя
 */
function getCurrentUser(PDO $pdo): ?array
{
    if (!isset($_SESSION['user_id'])) {
        return null;
    }

    // Самый простой запрос — только базовые поля
    $stmt = $pdo->prepare("SELECT id, name, phone, email, region, experience, rate, sphere,
           website, telegram, vk, about, skills, tools  FROM users WHERE id = ? LIMIT 1");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();

    return $user ?: null;
}
