<?php global $data; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $data['config']['scripts_dir'] ?>/lib/style/style.css">
    <link rel="stylesheet" href="<?= $data['config']['base_url'] ?>/public/styles/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title><?= $data['page_title'] ?? 'ofernandoavila | Community' ?></title>
</head>

<body>

    <header class="menu fixed align-self-center menu-mobile-spry">
        <div class="menu-container">
            <div class="column flex flex-1">
                <a href="<?= $data['config']['base_url'] ?>">
                    <h1>Community</h1>
                </a>
            </div>
            <div class="column flex flex-2">
                <div class="input-group">
                    <input type="search" name="search_top" id="search_top" placeholder="Find games, videos, arts...">
                </div>
            </div>
            <div class="column flex flex-1 align-items-end">
                <?php ofernandoavila\Community\Core\Template::LoadTemplatePart('common/main_menu') ?>
            </div>
            <button onclick="toggleMobileMenu()" class="menu-button" value="menu"></button>
        </div>
    </header>

    <div class="viewport">
        <div class="container">
            <?= isset($_SESSION['msg']) ? '<div id="notifications" class="' .  $_SESSION['msg']['type'] . '"><p>' . $_SESSION['msg']['text'] . '</p></div>' : '' ?>
            <?php unset($_SESSION['msg']); ?>