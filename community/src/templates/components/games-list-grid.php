<?php global $data; ?>
<ul class="game-list">
    <?php
    /**
     * @var Project $game
     */
    foreach ($data['games'] as $game) : ?>
        <li>
            <a href="<?= $data['config']['base_url'] . '/project?id=' . $game->projectHash; ?>">
                <div class="game-thumbnail"><img src="<?= $data['config']['cdn_url'] . '/games/' . $game->projectHash; ?>/icon.png" alt=""></div>
                <div class="game-info">
                    <div class="game-meta">
                        <div class="game-rating"><?= $game->rating ?? '';?></div>
                    </div>
                    <div class="game-title">
                        <span><?= $game->name; ?></span>
                        <span>by <?= $game->owner->username; ?></span>
                    </div>
                </div>
            </a>
        </li>
    <?php endforeach; ?>
</ul>