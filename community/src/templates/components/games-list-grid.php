<?php global $data; ?>
<?php if (sizeof($data['games']) != 0) : ?>
    <ul class="game-list">
        <?php
        /**
         * @var Project $game
         */
        foreach ($data['games'] as $game) : ?>
            <li>
                <a href="<?= $data['config']['base_url'] . '/project?id=' . $game->projectHash; ?>">
                    <div class="game-thumbnail"><img src="<?= $data['config']['storage_url'] . '/games/' . $game->projectHash; ?>/icon.png" alt=""></div>
                    <div class="game-info">
                        <div class="game-meta">
                            <div class="game-rating">
                                <?php if ($game->rating != null) : ?>
                                    <?php for ($i = 0; $i < 5; $i++) : ?>
                                        <?php if ($i < $game->rating) : ?>
                                            <i class="fa-solid fa-star"></i>
                                        <?php else : ?>
                                            <i class="fa-regular fa-star"></i>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                <?php endif; ?>
                            </div>
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
<?php else : ?>
    <p>No games found.</p>
<?php endif; ?>