<?php

function Debug($data) {
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    die;
}