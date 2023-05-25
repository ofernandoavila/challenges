<?php ofernandoavila\Community\Core\Template::LoadTemplatePart('common/header') ?>

<div class="row justify-center align-items-start">
    <div class="column flex flex-1"><?php ofernandoavila\Community\Core\Template::LoadTemplatePart('common/aside_menu') ?></div>
    <div class="column flex flex-3">
        <fieldset>
            <div class="text-header">
                <h3>Projects</h3>
            </div>
            <ul class="projects-grid">
                <a href="<?= $data['config']['base_url']; ?>/project/view-project">
                    <li class="project-item">
                        <div class="project-thumbnail">
                            <img src="https://th.bing.com/th/id/OIP.TpKdQjArT8qZWPb3lnq3agHaHa?pid=ImgDet&rs=1" alt="">
                        </div>
                        <div class="project-info">
                            <span class="project-info-name">RPG</span>
                            <span class="project-info-rating">5</span>
                        </div>
                    </li>
                </a>
            </ul>
        </fieldset>
    </div>
    <div class="column flex flex-1">
        <fieldset>
            <div class="text-header">
                <h3>Top projects</h3>
            </div>
        </fieldset>
    </div>
</div>

<?php ofernandoavila\Community\Core\Template::LoadTemplatePart('common/footer') ?>