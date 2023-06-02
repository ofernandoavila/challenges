<?php global $data; ?>
<?php if (sizeof($data['games']) != 0) : ?>
    <ul class="projects-grid">
        <?php foreach($data['games'] as $project): ?>
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
                    <?php else: ?>
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                    <?php endif; ?>
                </div>
                <div class="project-thumbnail">
                    <img src="<?= $data['config']['storage_url'] . '/users/' . $project->owner->userHash . '/games/' . $project->projectHash; ?>/icon.png" alt="">
                </div>
                <div class="project-info">
                    <span class="project-info-name"><?= $project->name; ?></span>
                    <p>by <?= $project->owner->username; ?></p>
                </div>
            </li>
        </a>
        <?php endforeach; ?>
    </ul>
<?php else : ?>
    <p>No games found.</p>
<?php endif; ?>