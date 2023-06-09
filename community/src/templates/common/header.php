<?php global $data; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php ofernandoavila\Community\Core\Template::LoadTemplatePart('common/top-scripts') ?>
    <title><?= $data['page_title'] ?? 'ofernandoavila | Community' ?></title>
</head>

<body>
    
    <?php ofernandoavila\Community\Core\Template::LoadTemplatePart('common/main_menu') ?>

    <div class="viewport">
        <div class="container">
            <?= isset($_SESSION['msg']) ? '<div id="notifications" class="' .  $_SESSION['msg']['type'] . '"><p>' . $_SESSION['msg']['text'] . '</p></div>' : '' ?>
            <?php unset($_SESSION['msg']); ?>