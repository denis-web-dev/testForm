<?php
declare(strict_types=1);


function redirect(string $url): void
{
    if (headers_sent()) {
        echo "<script>window.location.href = '$url';</script>";
        echo "<noscript><meta http-equiv='refresh' content='0;url=$url'></noscript>";
        exit;
    }
    header("Location: $url", true, 302);
    exit;
}


function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}


function old(string $key, string $default = ''): string
{
    return htmlspecialchars($_SESSION['old'][$key] ?? $default);
}


function set_flash(string $type, string $message): void
{
    $_SESSION['flash'] = [
        'type' => $type,
        'message' => $message
    ];
}

/**
 * Вывод flash-сообщения
 */
function get_flash(): void
{
    if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        $class = $flash['type'] === 'success' ? 'success' : 'error';

        echo "<div class='flash-message {$class}'>{$flash['message']}</div>";
        unset($_SESSION['flash']);
    }
}
