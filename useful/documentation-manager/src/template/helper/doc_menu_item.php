<?php foreach ($data['documentation_list']->item as $docItem) { ?>
    <li class="documentation-item">
        <a href="refference.html#<?= $docItem->title; ?>"><?= $docItem->title; ?></a>
    </li>
<?php }
