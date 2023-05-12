<?php

use function ofernandoavila\challenges\helpers\GetFooter;
use function ofernandoavila\challenges\helpers\GetHeader;

?>

<?php GetHeader($data); ?>
<div class="viewport h-vh-60 w-80 align-items-center justify-center">
    <div class="row flex-column">
        <div class="text-header">
            <h1>Documentation Page</h1>
        </div>
        <div class="row justify-center w-40">
            <div class="column">
                <div class="text-header">
                    <h3 class="align-text-center">Recently Added</h3>
                </div>
                <div class="row row-flex-column  pd-top-10">
                    <?php foreach ($data['modules'] as $module) : ?>
                        <a href="../useful/<?= $module['path']; ?>/documentation/index.html"><?= $module['name']; ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php GetFooter($data); ?>