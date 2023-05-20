<?php ofernandoavila\Community\Core\Template::LoadTemplatePart('common/header') ?>
<div class="row flex-column justify-center align-items-center">
    <fieldset>
        <div class="text-header">
            <h3>Create Account</h3>
        </div>
        <form action="<?= $data['config']['base_url']; ?>/create-account" method="post">
            <div class="row">
                <div class="input-group">
                    <input type="text" name="name" id="name" placeholder=" ">
                    <label for="name">Name</label>
                </div>
            </div>
            <div class="row">
                <div class="input-group">
                    <input type="text" name="username" id="username" placeholder=" ">
                    <label for="username">Username</label>
                </div>
            </div>
            <div class="row">
                <div class="input-group">
                    <input type="password" name="password" id="password" placeholder=" ">
                    <label for="password">Password</label>
                </div>
            </div>
            <div class="row">
                <div class="input-group">
                    <input type="submit" value="Create account" class="btn btn-normal">
                    <a href="<?= $data['config']['base_url'] ?>/login">Already have an account?</a>
                </div>
            </div>
        </form>
    </fieldset>
</div>
<?php ofernandoavila\Community\Core\Template::LoadTemplatePart('common/footer') ?>