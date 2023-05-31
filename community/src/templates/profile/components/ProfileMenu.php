<?php global $data; ?>

<ul class="menu row">
    <?php foreach ($data['profile_menu'] as $menuItem): ?>
        <?php if ($menuItem['selected']) : ?>
            <li class="selected"><a href="<?= $menuItem['url']; ?>"><?= $menuItem['label']; ?></a></li>
        <?php else: ?>
            <li><a href="<?= $menuItem['url']; ?>"><?= $menuItem['label']; ?></a></li>
        <?php endif;?>
    <?php endforeach; ?>
</ul>