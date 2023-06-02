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
                <?php if($data['profile_user']->GetFollowers()->count() > 0): ?>
                        <ul class="users-grid">
                        <?php foreach($data['profile_user']->GetFollowers() as $follower):?>
                            <li class="users-list-item">
                                <a href="<?= $data['config']['base_url']; ?>/profile?username=<?= $follower->username; ?>">
                                    <div class="user-image">
                                        <img src="<?= $data['config']['storage_url'] . $data['profile_user']->GetProfilePicture(); ?>" alt="">
                                    </div>
                                    <div class="user-info">
                                        <div class="user-username">@<?= $follower->username; ?></div>
                                    </div>
                                </a>
                                <button
                                id="follow-button-<?= $follower->id; ?>"
                                    <?php if (isset($data['user']) && $data['user']->id != null) : ?>
                                        data-following="<?= $follower->currentUserFollow ? 'true' : 'false' ?>"
                                        <?php else: ?>
                                            data-following="false"
                                    <?php endif; ?>
                                    class="btn btn-normal w-100"
                                    onclick="Follow(<?= $data['user']->id ?? 'null'; ?>, <?= $follower->id; ?>, 'follow-button-<?= $follower->id; ?>')"
                                ></button>
                            </li>
                        <?php endforeach;?>
                    </ul>
                <?php else: ?>
                    <h5>There is no followers to show.</h5>
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