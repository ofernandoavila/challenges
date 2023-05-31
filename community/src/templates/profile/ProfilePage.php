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
            <?php ofernandoavila\Community\Core\Template::LoadTemplatePart('profile/components/ProfileCard') ?>
        </div>
        <div class="column flex flex-4">
            <fieldset>
                <div class="row">
                    <?php ofernandoavila\Community\Core\Template::LoadTemplatePart('profile/components/ProfileMenu') ?>
                </div>
                <div class="row">
                    <ul class="projects-grid">
                        <?php foreach($data['projects'] as $project): ?>
                        <a href="<?= $data['config']['base_url']; ?>/project?id=<?= $project->projectHash; ?>">
                            <li class="project-item">
                                <div class="project-info-rating">
                                    <?php if ($project->rating != null) : ?>
                                        <?php for ($i = 0; $i < 5; $i++) : ?>
                                            <?php if ($i < $project->rating) : ?>
                                                <i class="fa-solid fa-star"></i>
                                            <?php else : ?>
                                                <i class="fa-regular fa-star"></i>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="project-thumbnail">
                                    <img src="<?= $data['config']['storage_url'] . '/games/' . $project->projectHash; ?>/icon.png" alt="">
                                </div>
                                <div class="project-info">
                                    <span class="project-info-name"><?= $project->name; ?></span>
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