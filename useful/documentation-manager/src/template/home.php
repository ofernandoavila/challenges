<?php

use function ofernandoavila\challenges\helpers\GetFooter;
use function ofernandoavila\challenges\helpers\GetHeader;

?>

<?php GetHeader($data); ?>
<header>
    <div class="container">
        <a href="../index.html">Go back - Challenges</a>
        <button class="toggle-theme"><i class="fa-solid fa-moon"></i></button>
    </div>
</header>
<div class="viewport">
    <div class="container">
        <div class="row align-items-center row-flex-column pd-top-10">
            <h1>Documentation Page</h1>
            <div class="row justify-center w-40">
                <div class="column">
                    <h3 class="align-text-center">Recently Added</h3>
                    <div class="row row-flex-column  pd-top-10">
                        <?php foreach ($data['modules'] as $module): ?>
                            <a href="<?= DEFAULT_MENU_ITEM_URL . $module['path']; ?>/documentation/index.html"><?= $module['name']; ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php GetFooter($data); ?>