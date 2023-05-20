<?php

namespace ofernandoavila\Community\Core;

use Exception;

class Template {
    public static function LoadTemplatePart($path) {
        $config = require __DIR__ . '/../config/config.php';

        $filePath = $config['template_dir'] . $path . '.php';

        if (file_exists($filePath)) {
            require $filePath;
        } else {
            throw new Exception('Template part was not found');
        }
    }
}