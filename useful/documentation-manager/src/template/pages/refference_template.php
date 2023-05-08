<?php

use function ofernandoavila\challenges\helpers\GetFooter;
use function ofernandoavila\challenges\helpers\GetHeader;

?>


<?php GetHeader($data); ?>
<div class="viewport h-vh-60 w-80 align-items-center justify-center">
    <div class="row pd-top-10">
        <div class="flex flex-1">
            <fieldset class="w-100">
                <button onclick="toggleMobileMenu()" class="btn btn-normal menu-button" value="menu"></button>
                <nav class="menu menu-mobile-collapse">
                    <ul id="documentation-menu">
                        <?php require DOCUMENTATION_MANAGER_TEMPLATE_PATH . '/helper/doc_menu_item.php'; ?>
                    </ul>
                </nav>
            </fieldset>
        </div>
        <div class="flex row flex-column flex-3">
            <div class="breadcrumb">
                <ul>
                    <li><a href="../../../documentation/index.html"><button class="btn btn-link" value="home"></button></a></li>
                    <li><a href="./index.html"><?= $data['module']['name']; ?></a></li>
                    <li><a href="./refference.html">Refferences</a></li>
                </ul>
            </div>
            <div class="row">
                <h1>Refferences</h1>
            </div>
            <div class="row align-self-center">
                <ul id="documentation">
                    <?php require DOCUMENTATION_MANAGER_TEMPLATE_PATH . '/helper/doc_item.php'; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php GetFooter($data); ?>