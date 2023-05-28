<?php ofernandoavila\Community\Core\Template::LoadTemplatePart('common/header') ?>

<div class="row justify-center align-items-start">
    <div class="column flex flex-1">
        <fieldset><?php ofernandoavila\Community\Core\Template::LoadTemplatePart('common/account_side_menu') ?></fieldset>
    </div>
    <div class="column flex flex-5">
        <fieldset>
            <div class="text-header flex justify-between">
                <h3>Dashboard</h3>
                <a class="w-20 btn btn-normal" href="<?= $data['config']['base_url'] ?>/project/add-new-project">Create new project</a>
            </div>
            <?php if ($data['user']->GetProjects()->count() == 0) : ?>
                <p>No projects found.</p>
            <?php else : ?>
                <div class="table" id="projects">
                    <div class="item head item-size-1">
                        <div>ID</div>
                        <div>Name</div>
                        <div>Pub date</div>
                        <div>Is Public?</div>
                        <div>Actions</div>
                    </div>
                    <?php foreach ($data['user']->GetProjects() as $project) : ?>
                        <div class="item item-size-1">
                            <div>
                                <?= $project->id; ?>
                            </div>
                            <div>
                                <?= $project->name; ?>
                            </div>
                            <div><?= $project->GetUploadDate(); ?></div>
                            <div>
                                <?= $project->isPublic ? 'Public' : 'Private'; ?>
                            </div>
                            <div>
                                <ul>
                                    <li>
                                        <a href="<?= $data['config']['base_url'] ?>/project?id=<?= $project->projectHash ?>">View</a>
                                        <a href="<?= $data['config']['base_url'] ?>/project/edit?id=<?= $project->projectHash ?>">Edit</a>
                                        <a href="<?= $data['config']['base_url'] ?>/project/delete?id=<?= $project->projectHash ?>">Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </fieldset>
    </div>
</div>

<?php ofernandoavila\Community\Core\Template::LoadTemplatePart('common/footer') ?>