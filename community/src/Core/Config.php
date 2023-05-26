<?php

namespace ofernandoavila\Community\Core;

use Exception;

class Config {
    public static function GetConfigs($mode = '') {
        if($mode == 'prod') {
            if(file_exists(__DIR__ . '/../config/config_prod.php')) {
                return require __DIR__ . '/../config/config_prod.php';
            } else throw new Exception('Production config was not found!');
        } else {
            if(file_exists(__DIR__ . '/../config/config.php')) {
                return require __DIR__ . '/../config/config.php';
            } else throw new Exception('Dev config was not found!');
        }
    }
}