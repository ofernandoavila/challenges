<?php

function Redirect($url) {
    $config = require __DIR__ . '/../config/config.php';
    return header('Location: ' . $config['base_url'] . $url);
}