<?php

use ofernandoavila\Community\Core\Config;

function Redirect($url) {
    global $applicationMode;
    $config = Config::GetConfigs($applicationMode);
    return header('Location: ' . $config['base_url'] . $url);
}