<?php

namespace ofernandoavila\Community\Core;

use Exception;

class BasicViewController {
    
    protected Array $config = [];

    public function __construct() {
        $this->config = require __DIR__ . '/../config/config.php';
    }

    public function Render($path, $dataTransfer = []) {
        global $data;

        $data = $dataTransfer;

        
        if(isset($data['config'])) throw new Exception('This key is reserved to system use only');

        $filePath = $this->config['template_dir'] . $path . '.php';

        $data['config'] = $this->config;

        if(file_exists($filePath)) {
            require_once $filePath;
        } else {
            require_once $this->config['template_dir'] . '404.php';
        }
    }
}