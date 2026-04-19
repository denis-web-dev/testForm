<?php
declare(strict_types=1);

/**
 * Проверка, что пользователь авторизован
 * Если нет — перенаправляет на login.php
 */
function requireAuth(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['user_id'])) {
        set_flash('error', 'Для доступа к этой странице необходимо войти в аккаунт.');
        redirect('/login.php');
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

    $stmt = $pdo->prepare("SELECT id, name, phone, email FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    return $stmt->fetch();
}
