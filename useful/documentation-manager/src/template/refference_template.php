<?php

use function ofernandoavila\challenges\helpers\GetFooter;
use function ofernandoavila\challenges\helpers\GetHeader;

?>


<?php GetHeader($data); ?>

<header>
    <div class="container">
        <a href="../../../index.html">Go back - Challenges</a>
        <button class="toggle-theme">
            <i class="fa-solid fa-moon"></i>
        </button>
    </div>
</header>
<div class="viewport">
    <div class="container">
        <div class="row pd-top-10">
            <div class="column flex-1">
                <fieldset class="w-100">
                    
                    <button onclick="toggleMobileMenu()" class="btn btn-normal align-self-end menu-button"><i class="fa fa-bars"></i></button>
                    <nav>
                        <ul id="documentation-menu">
                            <?php require DOCUMENTATION_MANAGER_TEMPLATE_PATH . '/doc_menu_item.php'; ?>
                        </ul>
                    </nav>
                </fieldset>
            </div>
            <div class="column flex-3">
                <div class="breadcrumb">
                    <ul>
                        <li>
                            <a href="../../../documentation/index.html">Home</a>
                        </li>
                        <li>
                            <a href="./index.html">Documentation Manager</a>
                        </li>
                        <li>
                            <a href="./refference.html">Refferences</a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <h1>Refferences</h1>
                </div>

                <div class="row align-self-center">
                    <ul id="documentation">
                        <?php require DOCUMENTATION_MANAGER_TEMPLATE_PATH . '/doc_item.php'; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php GetFooter($data); ?>