<?php
declare(strict_types=1);

require_once __DIR__ . '/../../includes/functions.php';
require_once __DIR__ . '/../models/User.php';

$pdo = require __DIR__ . '/../../config/database.php';
$userModel = new User($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name       = trim($_POST['name'] ?? '');
    $phone      = trim($_POST['phone'] ?? '');
    $email      = trim($_POST['email'] ?? '');
    $region     = trim($_POST['region'] ?? '');
    $experience = trim($_POST['experience'] ?? '');
    $rate       = trim($_POST['rate'] ?? '');
    $sphere     = trim($_POST['sphere'] ?? '');
    $website    = trim($_POST['website'] ?? '');
    $telegram   = trim($_POST['telegram'] ?? '');
    $vk         = trim($_POST['vk'] ?? '');
    $about      = trim($_POST['about'] ?? '');

$skills = (isset($_POST['skills']) && is_array($_POST['skills'])) ? json_encode($_POST['skills']) : null;
$tools = (isset($_POST['tools']) && is_array($_POST['tools'])) ? json_encode($_POST['tools']) : null;

    // CSRF
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
        $errors['general'] = 'Ошибка безопасности.';
    }

    if (empty($name)) {

    }

    // Обновление
    $updateFields = [];
    $params = [':id' => $_SESSION['user_id']];

    if ($name !== '') {
        $updateFields[] = "name = :name";
        $params[':name'] = $name;
    }
    if ($phone !== '') {
        $updateFields[] = "phone = :phone";
        $params[':phone'] = $phone;
    }
    if ($email !== '') {
        $updateFields[] = "email = :email";
        $params[':email'] = $email;
    }
    if ($region !== '') {
        $updateFields[] = "region = :region";
        $params[':region'] = $region;
    }
    if ($experience !== '') {
        $updateFields[] = "experience = :experience";
        $params[':experience'] = $experience;
    }
    if ($rate !== '') {
        $updateFields[] = "rate = :rate";
        $params[':rate'] = $rate;
    }
    if ($sphere !== '') {
        $updateFields[] = "sphere = :sphere";
        $params[':sphere'] = $sphere;
    }
    if ($website !== '') {
        $updateFields[] = "website = :website";
        $params[':website'] = $website;
    }
    if ($telegram !== '') {
        $updateFields[] = "telegram = :telegram";
        $params[':telegram'] = $telegram;
    }
    if ($vk !== '') {
        $updateFields[] = "vk = :vk";
        $params[':vk'] = $vk;
    }
    if ($about !== '') {
        $updateFields[] = "about = :about";
        $params[':about'] = $about;
    }

    if ($skills !== '') {
        $updateFields[] = "skills = :skills";
        $params[':skills'] = $skills;
    }
    if ($tools !== '') {
        $updateFields[] = "tools = :tools";
        $params[':tools'] = $tools;
    }

    if (!empty($updateFields)) {
        $sql = "UPDATE users SET " . implode(", ", $updateFields) . " WHERE id = :id";
        $pdo->prepare($sql)->execute($params);

    }

    redirect('/profile.php');
    exit;
}
