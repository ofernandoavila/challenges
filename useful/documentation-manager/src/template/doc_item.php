<?php foreach ($data['documentation_list']->item as $docItem) { ?>
    <li class="documentation-item">
        <a class="anchor" id="<?= $docItem->title; ?>"></a>
        <h2 class="item-title"><?= $docItem->title; ?></h2>
        <h5 class="item-signature"><?= $docItem->signature; ?></h5>
        <p class="item-description"><?= $docItem->description; ?></p>
        <ul class="item-param-list">
            <?php foreach ($docItem->params as $param) : ?>
                <?php $param = $param->param; ?>
                <li class="param-list-item">
                    <em class="param-type"><?= $param["type"]; ?></em> -
                    <b><?= $param["variable"]; ?></b> <?= $param["description"]; ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <p class="item-return"><?= $docItem->return; ?></p>
        <div class="item-function-body">
            <pre><?= $docItem->function; ?></pre>
        </div>
    </li>

<?php }
