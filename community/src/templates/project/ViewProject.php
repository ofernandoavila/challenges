<?php ofernandoavila\Community\Core\Template::LoadTemplatePart('common/header') ?>

<script>
    async function LikeProject(userId, projectHash) {
        if (userId == null) {
            return Login.openLoginPopup();
        }

        await fetch('<?= $data['config']['base_url'] ?>/likeProject', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    'userId': userId,
                    'projectHash': projectHash
                })
            }).then(res => res.json())
            .then(data => {
                let btn = document.querySelector('#like-button');
                btn.setAttribute("data-liked", data.like.toString());
            });
    }

</script>

<div class="row flex-column justify-center align-items-start">
    <div class="row">
        <fieldset class="w-100">
            <div class="text-header">
                <h3><?= $data['project']->name; ?></h3>
                <button 
                    data-liked="<?= $data['isProjectLikedByUser'] ? "true" : "false" ?>"
                    class="btn btn-normal"
                    id="like-button"
                    value="like"
                    onclick="LikeProject(<?= $data['session']->user->id ?? 'null' ?>, '<?= $data['project']->projectHash; ?>' )"
                ></button>
            </div>
            <div class="row justify-center">
                <iframe style="display: flex; justify-content: center; width: 100%; aspect-ratio: 16/9; cursor: default;" src="<?= $data['config']['storage_url'] . '/games/' . $data['project']->projectHash; ?>/index.html" frameborder="0"></iframe>
            </div>
        </fieldset>
    </div>
    <div class="row">
        <div class="column flex flex-1">
            <fieldset>
                <div class="text-header">
                    <h3>Author</h3>
                </div>
                <div class="post-meta">
                    <a href="<?= $data['config']['base_url'] ?>/profile?username=<?= $data['project']->owner->username; ?>">
                        <div class="post-meta-author">
                            <div class="post-meta-thumbnail">
                                <img src="http://ofernandoavila.avilamidia.com/wp-content/uploads/2022/04/cropped-138798512_3706164436112179_1414491971049075834_n.jpg" alt="">
                            </div>
                            <div class="post-meta-author-info">
                                <h3>@<?= $data['project']->owner->username; ?></h3>
                                <span>Administrator</span>
                            </div>
                        </div>
                    </a>
                    <hr>
                    <div class="post-meta-data">
                        <div class="row">
                            <div class="column">Views</div>
                            <div class="column">1,234</div>
                        </div>
                        <div class="row">
                            <div class="column">Faves</div>
                            <div class="column">34</div>
                        </div>
                        <div class="row">
                            <div class="column">Rating</div>
                            <div class="column">
                                <div class="flex">
                                    <?php if ($data['project']->rating != null) : ?>
                                        <?php for ($i = 0; $i < 5; $i++) : ?>
                                            <?php if ($i < $data['project']->rating) : ?>
                                                <i class="fa-solid fa-star"></i>
                                            <?php else : ?>
                                                <i class="fa-regular fa-star"></i>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="post-meta-data">
                        <div class="row">
                            <div class="column">Uploaded</div>
                            <div class="column"><?= $data['project']->GetUploadDate(); ?></div>
                        </div>
                        <div class="row">
                            <div class="column">Genre</div>
                            <div class="column">Action</div>
                        </div>
                        <div class="row">
                            <div class="column">Tags</div>
                            <div class="column">
                                <ul class="post-meta-tags">
                                    <li>2d</li>
                                    <li>action</li>
                                    <li>adventure</li>
                                    <li>game</li>
                                    <li>pixel-art</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="column flex flex-3">
            <fieldset>
                <div class="text-header">
                    <h3>Description</h3>
                </div>
                <div class="row">
                    <div class="description">
                        <p><?= $data['project']->description; ?></p>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</div>

<?php ofernandoavila\Community\Core\Template::LoadTemplatePart('common/footer') ?>