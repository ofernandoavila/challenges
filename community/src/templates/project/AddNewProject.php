<?php ofernandoavila\Community\Core\Template::LoadTemplatePart('common/header') ?>

<div class="row justify-center align-items-start">
    <div class="column flex flex-1"><?php ofernandoavila\Community\Core\Template::LoadTemplatePart('common/aside_menu') ?></div>
    <div class="column flex flex-5">
        <fieldset>
            <div class="text-header flex justify-between">
                <h3>Create new project</h3>
            </div>

            <form class="w-50" action="<?= $data['config']['base_url'] ?>/project/AddNewProject" method="post">
                <div class="row">
                    <div class="input-group">
                        <input type="text" name="project_name" id="project_name" placeholder=" " required>
                        <label for="project_name">* Project Name</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-group">
                        <textarea type="text" name="project_description" id="project_description" placeholder=" " required></textarea>
                        <label for="project_description">Description</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-group">
                        <input type="file" name="project_file" id="project_file" required>
                    </div>
                </div>
                <div class="row flex-column">
                    <div class="input-group">
                        <input type="radio" name="project_public" id="project_public" value="public" checked>
                        <label for="project_public">Public</label>
                    </div>
                    <div class="input-group">
                        <input type="radio" name="project_public" id="project_private" value="private">
                        <label for="project_private">Private</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-group">
                        <input type="submit" class="btn btn-normal" value="Post project">
                    </div>
                </div>
            </form>

        </fieldset>
    </div>
</div>

<?php ofernandoavila\Community\Core\Template::LoadTemplatePart('common/footer') ?>