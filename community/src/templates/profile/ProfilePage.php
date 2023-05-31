<?php global $data; ?>
<?php ofernandoavila\Community\Core\Template::LoadTemplatePart('common/header') ?>

<?php if($data['profile_user'] != null): ?>
    <script>
        
        async function Follow(currentUserId, targetId) {
            if(currentUserId == null) return Login.openLoginPopup();
            
            await fetch('<?= $data['config']['base_url'] ?>/follow', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    'userId': currentUserId,
                    'targetUserId': targetId
                })
            }).then(res => res.json())
            .then(data => {
                let btn = document.querySelector('#follow-button');
                btn.setAttribute("data-following", data.following.toString());

                let currentValue = parseInt(document.querySelector('#followers-total').innerHTML);

                if(data.following) {
                    document.querySelector('#followers-total').innerHTML = currentValue + 1;
                } else {
                    document.querySelector('#followers-total').innerHTML = currentValue - 1;
                }

            });
        }
    </script>
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
                            <h3>@<?= $data['profile_user']->username; ?></h3>
                            <span>Administrator</span>
                        </div>
                        <div class="row mg-top-20">
                            <?php if(isset($data['session']->user->username) && $data['session']->user->username == $data['profile_user']->username): ?>
                                <a class="w-100" href="<?= $data['config']['base_url'] ?>/my-account/edit-account"><button class="btn btn-default w-100" value="config">Manage profile</button></a>
                            <?php else: ?>
                                <button
                                    id="follow-button"
                                    data-following="<?= $data['isFollowing'] ? 'true' : 'false' ?>"
                                    class="btn btn-normal w-100"
                                    onclick="Follow(<?= $data['user']->id ?? 'null'; ?>, <?= $data['profile_user']->id; ?>)"
                                ></button>
                            <?php endif; ?>
                        </div>
                        <div class="row">
                            <div class="columm">
                                <div class="row"><h5>Followers</h5></div>
                                <div class="row" id="followers-total"><?= $data['profile_user']->GetFollowersCount() ?></div>
                            </div>
                            <div class="columm">
                                <div class="row"><h5>Following</h5></div>
                                <div class="row" id="followings-total"><?= $data['profile_user']->GetFollowingsCount() ?></div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="post-meta-data">
                        <div class="row">
                            <div class="column">Projects</div>
                            <div class="column"><?= sizeof($data['profile_user']->GetProjects()); ?></div>
                        </div>
                        <div class="row">
                            <div class="column">Projects Likes</div>
                            <div class="column"><?= $data['profile_user']->TotalProjectsLikes(); ?></div>
                        </div>
                        <div class="row">
                            <div class="column">Faves</div>
                            <div class="column"><?= $data['profile_user']->GetTotalFaves(); ?></div>
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
                                    <img src="<?= $data['config']['storage_url'] . '/games/' . $project->projectHash; ?>/icon.png" alt="">
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