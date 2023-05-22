<?php global $data; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $data['config']['base_url'] ?>/style.css">
    <title><?= $data['page_title'] ?? 'ofernandoavila | Community' ?></title>
</head>

<body>

    <header class="menu fixed align-self-center menu-mobile-spry">
        <div class="menu-container">
            <a href="<?= $data['config']['base_url'] ?>">
                <h1>Community by ofernandoavila</h1>
            </a>
            <button onclick="toggleMobileMenu()" class="menu-button" value="menu"></button>
            <?php ofernandoavila\Community\Core\Template::LoadTemplatePart('common/main_menu') ?>
        </div>
    </header>
    <div class="viewport">
        <div class="container">
            <?= isset($_SESSION['msg']) ? '<div id="notifications" class="' .  $_SESSION['msg']['type'] . '"><p>' . $_SESSION['msg']['text'] . '</p></div>' : '' ?>
            <?php unset($_SESSION['msg']); ?>