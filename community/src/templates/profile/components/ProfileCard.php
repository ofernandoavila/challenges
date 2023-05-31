<?php global $data; ?>

<fieldset>
    <div class="text-header">
        <h3>Profile</h3>
    </div>
    <div class="post-meta">
        <div class="post-meta-author">
            <a href="<?= $data['config']['base_url'] ?>/profile?username=<?= $data['profile_user']->username; ?>">
                <div class="post-meta-thumbnail">
                    <img src="http://ofernandoavila.avilamidia.com/wp-content/uploads/2022/04/cropped-138798512_3706164436112179_1414491971049075834_n.jpg" alt="">
                </div>
            </a>
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
            <div class="row justify-center">
                <a href="<?= $data['config']['base_url'] ?>/profile/followers?username=<?= $data['profile_user']->username; ?>">
                    <div class="column ">
                        <div class="row justify-center text-align-center"><h5>Followers</h5></div>
                        <div class="row justify-center text-align-center" id="followers-total"><span><?= $data['profile_user']->GetFollowersCount() ?></span></div>
                    </div>
                </a>
                <a href="<?= $data['config']['base_url'] ?>/profile/followings?username=<?= $data['profile_user']->username; ?>">
                    <div class="column">
                        <div class="row justify-center text-align-center"><h5>Following</h5></div>
                        <div class="row justify-center text-align-center" id="followings-total"><span><?= $data['profile_user']->GetFollowingsCount() ?></span></div>
                    </div>
                </a>
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