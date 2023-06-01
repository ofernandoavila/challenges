<?php global $data; ?>
<?php ofernandoavila\Community\Core\Template::LoadTemplatePart('common/header') ?>

<?php if($data['profile_user'] != null): ?>
    <script>
        
        async function Follow(currentUserId, targetId, button) {
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
                let btn = document.querySelector('#' + button);
                btn.setAttribute("data-following", data.following.toString());

            });
        }
    </script>
    <div class="row justify-center align-items-start">
        <div class="column flex flex-1">
            <?php ofernandoavila\Community\Core\Template::LoadTemplatePart('profile/components/ProfileCard') ?>
        </div>
        <div class="column flex flex-4">
            <fieldset>
                <div class="row">
                    <?php ofernandoavila\Community\Core\Template::LoadTemplatePart('profile/components/ProfileMenu') ?>
                </div>
                <div class="row">
                    <?php if($data['profile_user']->GetFollowings()->count() > 0): ?>
                        <ul class="users-grid">
                        <?php foreach($data['profile_user']->GetFollowings() as $following):?>
                            <li class="users-list-item">
                                <a href="<?= $data['config']['base_url']; ?>/profile?username=<?= $following->username; ?>">
                                    <div class="user-image">
                                        <img src="http://ofernandoavila.avilamidia.com/wp-content/uploads/2022/04/cropped-138798512_3706164436112179_1414491971049075834_n.jpg" alt="">
                                    </div>
                                    <div class="user-info">
                                        <div class="user-username">@<?= $following->username; ?></div>
                                    </div>
                                </a>
                                <?php if(isset($data['user'])): ?>
                                    <?php if($following->username != $data['user']->username): ?>
                                    <button
                                        id="follow-button-<?= $following->id; ?>"
                                        <?php if (isset($data['user']) && $data['user']->id != null) : ?>
                                            data-following="<?= $follower->currentUserFollow ? 'true' : 'false' ?>"
                                            <?php else: ?>
                                                data-following="false"
                                        <?php endif; ?>
                                        class="btn btn-normal w-100"
                                        onclick="Follow(<?= $data['user']->id ?? 'null'; ?>, <?= $following->id; ?>, 'follow-button-<?= $following->id; ?>')"
                                    ></button>
                                    <?php else: ?>
                                        <a href="<?= $data['config']['base_url']; ?>/profile?username=<?= $data['user']->username; ?>" class="w-100">
                                            <button class="btn btn-default w-100">My Profile</button>
                                        </a>
                                    <?php endif; ?>
                                    <?php else: ?>
                                    <button
                                        id="follow-button-<?= $following->id; ?>"
                                        data-following="false"
                                        class="btn btn-normal w-100"
                                        onclick="Follow(<?= $data['user']->id ?? 'null'; ?>, <?= $following->id; ?>, 'follow-button-<?= $following->id; ?>')"
                                        ></button>
                                    <?php endif; ?>
                            </li>
                        <?php endforeach;?>
                    </ul>
                    <?php else: ?>
                        <h5>There is no followings to show.</h5>
                    <?php endif; ?>
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