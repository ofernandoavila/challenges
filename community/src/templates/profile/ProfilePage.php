<?php global $data; ?>
<?php ofernandoavila\Community\Core\Template::LoadTemplatePart('common/header') ?>

<?php if($data['user'] != null): ?>
    <div class="row justify-center align-items-start">
        <div class="column flex flex-1">
            <fieldset>
                <div class="text-header">
                    <h3>Profile</h3>
                </div>
                <div class="post-meta">
                    <div class="post-meta-author">
                        <div class="post-meta-thumbnail">
                            <img src="http://ofernandoavila.avilamidia.com/wp-content/uploads/2022/04/cropped-138798512_3706164436112179_1414491971049075834_n.jpg" alt="">
                        </div>
                        <div class="post-meta-author-info">
                            <h3>@<?= $data['user']->username; ?></h3>
                            <span>Administrator</span>
                        </div>
                        <div class="row mg-top-20">
                            <?php if(isset($data['session']->user->username) && $data['session']->user->username == $data['user']->username): ?>
                                <a href="<?= $data['config']['base_url'] ?>/my-account/edit-account"><button class="btn btn-default" value="config">Manage profile</button></a>
                            <?php else: ?>
                                <button class="btn btn-normal" value="plus">Follow</button>
                            <?php endif; ?>
                        </div>
                    </div>
                    <hr>
                    <div class="post-meta-data">
                        <div class="row">
                            <div class="column">Projects</div>
                            <div class="column"><?= sizeof($data['user']->GetProjects()); ?></div>
                        </div>
                        <div class="row">
                            <div class="column">Projects Likes</div>
                            <div class="column"><?= $data['user']->TotalProjectsLikes(); ?></div>
                        </div>
                        <div class="row">
                            <div class="column">Faves</div>
                            <div class="column"><?= $data['user']->GetTotalFaves(); ?></div>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="column flex flex-5">
            <fieldset>
                <div class="row">
                    <ul class="row">
                        <li>Games</li>
                        <li>Posts</li>
                        <li>Projects</li>
                        <li>Art</li>
                    </ul>
                </div>
                <div class="row">
                    <ul class="projects-grid">
                        <?php foreach($data['projects'] as $project): ?>
                        <a href="<?= $data['config']['base_url']; ?>/project?id=<?= $project->projectHash; ?>">
                            <li class="project-item">
                                <div class="project-thumbnail">
                                    <img src="https://th.bing.com/th/id/OIP.TpKdQjArT8qZWPb3lnq3agHaHa?pid=ImgDet&rs=1" alt="">
                                </div>
                                <div class="project-info">
                                    <span class="project-info-name"><?= $project->name; ?></span>
                                    <span class="project-info-rating">5</span>
                                </div>
                            </li>
                        </a>
                        <?php endforeach; ?>
                    </ul>
                </div>
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