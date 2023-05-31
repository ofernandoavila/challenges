<?php ofernandoavila\Community\Core\Template::LoadTemplatePart('common/basic_header') ?>

<div class="flex h-vh-100">
    <div class="flex flex-3" style="background-color: #000;">
        <a href="<?= $data['config']['base_url'] ?>/"><button style="position: absolute; top: 30px; left: 30px" class="btn btn-transparent" value="return">Back to site</button></a>
    </div>
    <div class="flex flex-5 align-items-center justify-center">
        <button style="position: absolute; top: 30px; right: 30px" class="toggle-theme"></button>
        <fieldset>
            <div class="text-header">
                <h3>Create Account</h3>
            </div>
            <form action="<?= $data['config']['base_url']; ?>/create-account" method="post">
                <div class="row">
                    <div class="input-group">
                        <input type="text" name="name" id="name" placeholder="Name">
                    </div>
                </div>
                <div class="row">
                    <div class="input-group">
                        <input type="text" name="username" id="username" placeholder="Username">
                    </div>
                </div>
                <div class="row">
                    <div class="input-group">
                        <input type="password" name="password" id="password" placeholder="Password">
                    </div>
                </div>
                <div class="row flex-column">
                    <input type="submit" value="Create account" class="w-100 btn btn-normal">
                    <a href="<?= $data['config']['base_url'] ?>/login">Already have an account?</a>
                </div>
            </form>
        </fieldset>
    </div>
</div>

<?php ofernandoavila\Community\Core\Template::LoadTemplatePart('common/basic_footer') ?>