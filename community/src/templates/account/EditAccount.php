<?php ofernandoavila\Community\Core\Template::LoadTemplatePart('common/header') ?>
<div class="row justify-center align-items-center">
    <div class="row">
        <div class="column flex flex-1">
            <fieldset>
                <?php ofernandoavila\Community\Core\Template::LoadTemplatePart('common/account_side_menu') ?>
            </fieldset>
        </div>
        <div class="column flex flex-3">
            <fieldset>
                <div class="text-header">
                    <h2>Edit Account</h2>
                </div>
                <form class="w-50" action="<?= $data['config']['base_url'] ?>/my-account/edit-account" method="post">
                    <div class="row">
                        
                        <div class="input-group">
                            <input type="file" name="profileImage" id="profileImage">
                            <label for="profileImage">
                                <div class="profile-image">
                                    <img src="<?= $data['config']['storage_url']; ?><?= $data['user']->profileImage ?? ''; ?>" alt="">
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group">
                            <input type="text" name="name" id="name" placeholder=" " value="<?= $data['user']->name ?? ''; ?>">
                            <label for="name">Name</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group">
                            <input type="text" name="username" id="username" placeholder=" " value="<?= $data['user']->username ?? ''; ?>">
                            <label for="username">Username</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group">
                            <input type="submit" value="Edit account" class="btn btn-normal">
                        </div>
                    </div>
                </form>
            </fieldset>
        </div>
    </div>
</div>

<?php ofernandoavila\Community\Core\Template::LoadTemplatePart('common/footer') ?>