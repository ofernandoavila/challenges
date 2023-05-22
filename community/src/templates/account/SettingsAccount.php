<?php ofernandoavila\Community\Core\Template::LoadTemplatePart('common/header') ?>
<div class="row justify-center align-items-center">
    <div class="row">
        <div class="column flex flex-1">
            <fieldset>
                <?php ofernandoavila\Community\Core\Template::LoadTemplatePart('common/account_side_menu') ?>
            </fieldset>
        </div>
        <div class="column flex flex-3">
            <fieldset>
                <div class="text-header">
                    <h2>Settings</h2>
                </div>
                <div class="row">
                    <a href="<?= $data['config']['base_url'] ?>/my-account/delete-account">Delete account</a>
                </div>
            </fieldset>
        </div>
    </div>
</div>

<?php ofernandoavila\Community\Core\Template::LoadTemplatePart('common/footer') ?>