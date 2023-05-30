<?php global $data; ?>
<?php ofernandoavila\Community\Core\Template::LoadTemplatePart('common/header') ?>

<?php if($data['user'] != null): ?>
    <div class="row justify-center align-items-start">
        <div class="column flex flex-1">
            <fieldset>
                <div class="text-header">
                    <h3>@<?= $data['user']->username; ?></h3>
                </div>
            </fieldset>
        </div>
        <div class="column flex flex-5">
            <fieldset>
            </fieldset>
        </div>
    </div>
<?php else: ?>
    <div class="row justify-center align-items-start">
        <div class="text-header">
            <h3>User not found...</h3>
        </div>
    </div>
<?php endif; ?>



<?php ofernandoavila\Community\Core\Template::LoadTemplatePart('common/footer') ?>