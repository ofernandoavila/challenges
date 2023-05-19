<?php

namespace ofernandoavila\Community\Core;

class BasicController {
    
    protected Array $config = [];

    public function __construct() {
        $this->config = require __DIR__ . '/../config/config.php'; 
    }

    public function Render($path, $data = []) {
        $filePath = $this->config['template_dir'] . $path . '.php';

        if(file_exists($filePath)) {
            require_once $filePath;
        } else {
            require_once $this->config['template_dir'] . '404.php';
        }
    }
}