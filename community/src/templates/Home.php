<?php ofernandoavila\Community\Core\Template::LoadTemplatePart('common/header') ?>

<div class="row justify-center align-items-start">
    <div class="column flex flex-5">
        <fieldset>
            <div class="text-header">
                <h3>Top games</h3>
            </div>
            <?php ofernandoavila\Community\Core\Template::LoadTemplatePart('components/games-list-grid') ?>
        </fieldset>
    </div>
    <div class="column flex flex-1">
        <fieldset>
            <div class="text-header">
                <h3>Trending</h3>
            </div>
        </fieldset>
    </div>
</div>

<?php ofernandoavila\Community\Core\Template::LoadTemplatePart('common/footer') ?>