<?php global $data; ?>

<nav>
    <ul class="row">
        <?php if (isset($_SESSION['user_session'])) : ?>
            <li><a href="<?= $data['config']['base_url'] ?>/profile?username=<?= $data['session']->user->username; ?>">My Profile</a></li>
            <li><a href="<?= $data['config']['base_url'] ?>/my-account">My Account</a></li>
            <li><a href="<?= $data['config']['base_url'] ?>/logoff">Logoff</a></li>
        <?php else : ?>
            <li><a href="<?= $data['config']['base_url'] ?>/login">Log In</a></li>
        <?php endif; ?>
        <li><button style="position: relative !important;" class="toggle-theme"></button></li>
    </ul>
</nav>